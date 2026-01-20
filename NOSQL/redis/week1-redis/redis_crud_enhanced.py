#!/usr/bin/env python3
"""
Week 1: GitHubArchive + Redis CRUD with Analysis Features

Enhanced CRUD application with:
1. Search by repository name
2. Top repositories by watch count
3. Most active developers by commit count
"""

import json
import os
import uuid
from typing import Any, Dict, Iterable, Optional, List
from collections import defaultdict

import redis


# -----------------------------
# Read JSON files
# -----------------------------
def read_records(path: str, limit: Optional[int] = None) -> Iterable[Dict[str, Any]]:
    """Read records from JSON file (array or lines format)"""
    if not path:
        raise FileNotFoundError("No path provided.")

    path = path.strip().strip('"').strip("'")

    if not os.path.exists(path):
        raise FileNotFoundError(f"File not found: {path}")

    with open(path, "rt", encoding="utf-8", errors="replace") as f:
        first = ""
        while True:
            ch = f.read(1)
            if ch == "":
                return
            if not ch.isspace():
                first = ch
                break
        f.seek(0)

        # JSON array file
        if first == "[":
            data = json.load(f)
            if not isinstance(data, list):
                return
            count = 0
            for rec in data:
                if isinstance(rec, dict):
                    yield rec
                    count += 1
                    if limit is not None and count >= limit:
                        break
            return

        # JSON Lines file
        count = 0
        for line in f:
            line = line.strip()
            if not line:
                continue
            try:
                rec = json.loads(line)
            except json.JSONDecodeError:
                continue
            if isinstance(rec, dict):
                yield rec
                count += 1
                if limit is not None and count >= limit:
                    break


# -----------------------------
# Redis CRUD with Analysis
# -----------------------------
class RedisCRUD:
    def __init__(self, host="localhost", port=6379, db=0, collection="gh"):
        self.r = redis.Redis(host=host, port=port, db=db, decode_responses=True)
        self.r.ping()
        self.collection = collection
        self.ids_key = f"{collection}:ids"
        self.record_prefix = f"{collection}:record:"

    def _key(self, record_id: str) -> str:
        return f"{self.record_prefix}{record_id}"

    # ===== BASIC CRUD =====

    def create(self, record: Dict[str, Any]) -> str:
        """Create a new record"""
        record_id = str(uuid.uuid4())
        self.r.set(self._key(record_id), json.dumps(record))
        self.r.sadd(self.ids_key, record_id)
        return record_id

    def read(self, record_id: str) -> Optional[Dict[str, Any]]:
        """Read a record by ID"""
        raw = self.r.get(self._key(record_id))
        if not raw:
            return None
        doc = json.loads(raw)
        doc["_id"] = record_id
        return doc

    def update(self, record_id: str, updates: Dict[str, Any]) -> bool:
        """Update a record"""
        doc = self.read(record_id)
        if not doc:
            return False
        doc.pop("_id", None)
        doc.update(updates)
        self.r.set(self._key(record_id), json.dumps(doc))
        return True

    def delete(self, record_id: str) -> bool:
        """Delete a record"""
        deleted = self.r.delete(self._key(record_id)) > 0
        self.r.srem(self.ids_key, record_id)
        return deleted

    def count(self) -> int:
        """Count total records"""
        return int(self.r.scard(self.ids_key))

    def list_ids(self, limit: int = 10) -> List[str]:
        """List record IDs"""
        ids = list(self.r.smembers(self.ids_key))
        return ids[:limit]

    # ===== ANALYSIS FEATURES =====

    def search_by_repo(self, repo_name: str, limit: int = 10) -> List[Dict[str, Any]]:
        """
        Feature 1: Search records by repository name
        Searches through all records to find matching repositories
        """
        results = []
        repo_name_lower = repo_name.lower()

        # Get all IDs and search through them
        all_ids = list(self.r.smembers(self.ids_key))

        for record_id in all_ids:
            if len(results) >= limit:
                break

            doc = self.read(record_id)
            if doc and "repo_name" in doc:
                if repo_name_lower in doc["repo_name"].lower():
                    results.append(doc)

        return results

    def top_repos_by_watches(self, limit: int = 10) -> List[Dict[str, Any]]:
        """
        Feature 2: Get top repositories by watch count
        Analyzes repository popularity using Redis sorted sets
        """
        # Collect all repos with watch counts
        repos = []
        all_ids = list(self.r.smembers(self.ids_key))

        for record_id in all_ids:
            doc = self.read(record_id)
            if doc and "repo_name" in doc and "watch_count" in doc:
                try:
                    watch_count = int(doc["watch_count"])
                    repos.append({
                        "repo_name": doc["repo_name"],
                        "watch_count": watch_count
                    })
                except (ValueError, TypeError):
                    continue

        # Sort by watch count descending
        repos.sort(key=lambda x: x["watch_count"], reverse=True)
        return repos[:limit]

    def most_active_developers(self, limit: int = 10) -> List[Dict[str, Any]]:
        """
        Feature 3: Find most active developers by commit count
        Counts commits per developer across all records
        """
        developer_commits = defaultdict(int)
        developer_info = {}

        all_ids = list(self.r.smembers(self.ids_key))

        for record_id in all_ids:
            doc = self.read(record_id)
            if doc and "author" in doc:
                author = doc.get("author", {})
                if isinstance(author, dict):
                    name = author.get("name")
                    email = author.get("email")

                    if name:
                        developer_commits[name] += 1
                        if name not in developer_info:
                            developer_info[name] = {
                                "name": name,
                                "email": email,
                                "repos": set()
                            }
                        if "repo_name" in doc:
                            developer_info[name]["repos"].add(doc["repo_name"])

        # Convert to list and sort
        results = []
        for dev_name, commit_count in developer_commits.items():
            results.append({
                "developer": dev_name,
                "email": developer_info[dev_name]["email"],
                "commit_count": commit_count,
                "repo_count": len(developer_info[dev_name]["repos"])
            })

        results.sort(key=lambda x: x["commit_count"], reverse=True)
        return results[:limit]

    def get_all_records(self, limit: int = 10) -> List[Dict[str, Any]]:
        """Get all records (limited)"""
        results = []
        all_ids = list(self.r.smembers(self.ids_key))[:limit]

        for record_id in all_ids:
            doc = self.read(record_id)
            if doc:
                results.append(doc)

        return results


# -----------------------------
# CLI
# -----------------------------
def prompt_json_object() -> Dict[str, Any]:
    """Prompt user for JSON input"""
    print("Paste a JSON object (one line), example: {\"name\":\"test\"}")
    raw = input("> ").strip()
    doc = json.loads(raw)
    if not isinstance(doc, dict):
        raise ValueError("Must be a JSON object.")
    return doc


def print_records(records: List[Dict[str, Any]], title: str = "Results"):
    """Pretty print records"""
    print(f"\n{'='*60}")
    print(f"{title}")
    print(f"{'='*60}")

    if not records:
        print("No records found.")
        return

    for i, rec in enumerate(records, 1):
        print(f"\n--- Record {i} ---")
        print(json.dumps(rec, indent=2))

    print(f"\n{'='*60}")
    print(f"Total: {len(records)} record(s)")
    print(f"{'='*60}\n")


def main():
    print("\n" + "="*60)
    print("Week 1: Redis CRUD with GitHub Archive Analysis")
    print("="*60 + "\n")

    # Connect to Redis
    try:
        app = RedisCRUD(collection="gharchive")
        print("✅ Connected to Redis successfully!")
        print(f"📊 Current records in database: {app.count()}\n")
    except Exception as e:
        print("❌ Could not connect to Redis")
        print("Make sure Redis is running (docker-compose up -d)")
        print(f"Error: {e}")
        return

    while True:
        print("\n" + "="*60)
        print("MENU")
        print("="*60)
        print("\n📥 DATA MANAGEMENT")
        print("  1) Import JSON file into Redis")
        print("  2) Create record (paste JSON)")
        print("  3) Read record by ID")
        print("  4) Update record by ID")
        print("  5) Delete record by ID")
        print("  6) List all record IDs (first 10)")
        print("  7) View all records (first 10)")
        print("  8) Count total records")

        print("\n🔍 ANALYSIS FEATURES")
        print("  9) Search by repository name")
        print(" 10) Top repositories by watch count")
        print(" 11) Most active developers by commits")

        print("\n  0) Exit")
        print("="*60)

        choice = input("\n👉 Choose an option: ").strip()

        try:
            if choice == "1":
                # Import JSON file
                print("\n📂 Available files in GitHubArchive-Dataset/:")
                print("  - Sample_Repos.json (recommended for testing)")
                print("  - Sample_Commits.json")
                print("  - Languages.json")
                print("  - Files.json")

                path = input("\nPath to file: ").strip()
                lim = input("Limit (blank for all, recommend 100 for testing): ").strip()
                limit = int(lim) if lim else None

                print("\n⏳ Importing...")
                imported = 0
                for rec in read_records(path, limit=limit):
                    app.create(rec)
                    imported += 1
                    if imported % 100 == 0:
                        print(f"  Imported {imported} records...")

                print(f"\n✅ Imported {imported} records into Redis!")

            elif choice == "2":
                # Create record
                doc = prompt_json_object()
                rid = app.create(doc)
                print(f"✅ Created record with ID: {rid}")

            elif choice == "3":
                # Read record
                rid = input("Record ID: ").strip()
                doc = app.read(rid)
                if doc:
                    print("\n📄 Record found:")
                    print(json.dumps(doc, indent=2))
                else:
                    print("❌ Record not found.")

            elif choice == "4":
                # Update record
                rid = input("Record ID: ").strip()
                print("Enter updates as JSON:")
                updates = prompt_json_object()
                ok = app.update(rid, updates)
                print("✅ Updated successfully!" if ok else "❌ Record not found.")

            elif choice == "5":
                # Delete record
                rid = input("Record ID: ").strip()
                confirm = input(f"⚠️  Delete record {rid}? (yes/no): ").strip().lower()
                if confirm == "yes":
                    ok = app.delete(rid)
                    print("✅ Deleted successfully!" if ok else "❌ Record not found.")
                else:
                    print("Cancelled.")

            elif choice == "6":
                # List IDs
                ids = app.list_ids(limit=10)
                print(f"\n📋 First 10 record IDs:")
                for i, rid in enumerate(ids, 1):
                    print(f"  {i}. {rid}")
                print(f"\nTotal records: {app.count()}")

            elif choice == "7":
                # View all records
                records = app.get_all_records(limit=10)
                print_records(records, "First 10 Records")

            elif choice == "8":
                # Count records
                total = app.count()
                print(f"\n📊 Total records in database: {total}")

            elif choice == "9":
                # Search by repo name
                repo_name = input("\n🔍 Enter repository name to search: ").strip()
                print(f"\n⏳ Searching for '{repo_name}'...")
                results = app.search_by_repo(repo_name, limit=10)
                print_records(results, f"Search Results for '{repo_name}'")

            elif choice == "10":
                # Top repos by watches
                print("\n⏳ Analyzing repository popularity...")
                top_repos = app.top_repos_by_watches(limit=10)
                print_records(top_repos, "Top 10 Repositories by Watch Count")

            elif choice == "11":
                # Most active developers
                print("\n⏳ Analyzing developer activity...")
                developers = app.most_active_developers(limit=10)
                print_records(developers, "Top 10 Most Active Developers")

            elif choice == "0":
                print("\n👋 Goodbye!")
                break

            else:
                print("❌ Invalid option. Please try again.")

        except FileNotFoundError as e:
            print(f"❌ File error: {e}")
        except json.JSONDecodeError as e:
            print(f"❌ Invalid JSON: {e}")
        except Exception as e:
            print(f"❌ Error: {e}")


if __name__ == "__main__":
    main()
