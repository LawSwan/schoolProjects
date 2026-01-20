"""
Name: Amber Lawson
Assignment: Cassandra CRUD (Amazon keyspace)
Date: 2026-01-12
Purpose: Create a Python menu app that performs CRUD and reporting queries on a Cassandra database.
"""

import json
import os
import sys
import time
from cassandra.cluster import Cluster
from cassandra import InvalidRequest


KEYSPACE = "amazon"
HOSTS = ["127.0.0.1"]
PORT = 9042
JSON_FILE = "Amazon_reviews .json"  # Hardcoded path to data file


def connect_with_retry(max_tries: int = 20, sleep_seconds: int = 3):
    for attempt in range(1, max_tries + 1):
        try:
            cluster = Cluster(HOSTS, port=PORT)
            session = cluster.connect()
            return cluster, session
        except Exception as e:
            print(f"Waiting for Cassandra... attempt {attempt}/{max_tries}. {e}")
            time.sleep(sleep_seconds)
    raise RuntimeError("Could not connect to Cassandra on localhost:9042")


def ensure_keyspace_and_tables(session):
    # Create keyspace Amazon
    session.execute(f"""
        CREATE KEYSPACE IF NOT EXISTS {KEYSPACE}
        WITH replication = {{'class': 'SimpleStrategy', 'replication_factor': 1}}
    """)

    session.set_keyspace(KEYSPACE)

    # Create Reviews table with required fields
    session.execute("""
        CREATE TABLE IF NOT EXISTS Reviews (
            product_id text,
            review_id text,
            reviewer_id text,
            stars int,
            review_body text,
            review_title text,
            product_category text,
            PRIMARY KEY ((product_id), review_id)
        )
    """)

    # Create ProductCategories table with required fields
    # Partition by product_category so DISTINCT categories works cleanly
    session.execute("""
        CREATE TABLE IF NOT EXISTS ProductCategories (
            product_category text,
            stars int,
            product_id text,
            language text,
            PRIMARY KEY ((product_category), stars, product_id)
        ) WITH CLUSTERING ORDER BY (stars DESC, product_id ASC)
    """)


def load_json_file(path: str):
    # Try to find the file with various path variations
    possible_paths = [
        path,
        path + ".json",
        path.replace(".json", "") + ".json",
    ]

    # Also check for common variations in the current directory
    if not os.path.isabs(path):
        base_name = os.path.basename(path).replace(".json", "")
        script_dir = os.path.dirname(os.path.abspath(__file__))
        possible_paths.extend([
            os.path.join(script_dir, base_name + ".json"),
            os.path.join(script_dir, base_name + " .json"),  # Handle space before extension
            os.path.join(script_dir, "Amazon_reviews .json"),  # Direct match for the actual file
        ])

    found_path = None
    for p in possible_paths:
        if os.path.exists(p):
            found_path = p
            break

    if not found_path:
        raise FileNotFoundError(f"JSON file not found. Tried: {path}\nMake sure the file exists and check for spaces in the filename.")

    print(f"Loading data from: {found_path}")

    rows = []
    with open(found_path, "r", encoding="utf-8") as f:
        for line in f:
            line = line.strip()
            if line:
                try:
                    rows.append(json.loads(line))
                except json.JSONDecodeError as e:
                    print(f"Warning: Skipping invalid JSON line: {e}")
                    continue

    if not rows:
        raise ValueError("No valid JSON data found in file.")

    return rows


def safe_get(item: dict, *keys, default=None):
    for k in keys:
        if k in item and item[k] is not None:
            return item[k]
    return default


def to_int(value, default=0):
    try:
        return int(value)
    except Exception:
        return default


def auto_load_data(session):
    """Automatically load data from JSON file on startup if tables are empty."""
    # Check if data already exists
    try:
        result = session.execute("SELECT COUNT(*) AS c FROM Reviews").one()
        if result.c > 0:
            print(f"Data already loaded ({result.c} reviews found).")
            return
    except Exception:
        pass  # Table might not exist yet

    # Load data from hardcoded path
    script_dir = os.path.dirname(os.path.abspath(__file__))
    path = os.path.join(script_dir, JSON_FILE)

    print(f"Loading data from: {path}")
    rows = load_json_file(path)

    insert_reviews = session.prepare("""
        INSERT INTO Reviews (product_id, review_id, reviewer_id, stars, review_body, review_title, product_category)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    """)

    insert_categories = session.prepare("""
        INSERT INTO ProductCategories (product_category, stars, product_id, language)
        VALUES (?, ?, ?, ?)
    """)

    inserted = 0
    for r in rows:
        product_id = str(safe_get(r, "product_id", "asin", default="")).strip()
        review_id = str(safe_get(r, "review_id", "id", default="")).strip()
        reviewer_id = str(safe_get(r, "reviewer_id", "reviewerID", default="")).strip()
        stars = to_int(safe_get(r, "stars", "rating", "overall", default=0), default=0)
        review_body = str(safe_get(r, "review_body", "reviewText", "text", default="")).strip()
        review_title = str(safe_get(r, "review_title", "summary", "title", default="")).strip()
        product_category = str(safe_get(r, "product_category", "category", default="")).strip()
        language = str(safe_get(r, "language", "lang", default="")).strip()

        if not product_id or not review_id or not product_category:
            continue

        session.execute(insert_reviews, (product_id, review_id, reviewer_id, stars, review_body, review_title, product_category))
        session.execute(insert_categories, (product_category, stars, product_id, language))
        inserted += 1

    print(f"Inserted {inserted} rows into Reviews and ProductCategories.")


def show_distinct_categories(session):
    # Display all distinct product categories from ProductCategories
    rows = session.execute("SELECT DISTINCT product_category FROM ProductCategories")
    cats = [r.product_category for r in rows]
    if not cats:
        print("No categories found.")
        return
    print("Distinct product categories:")
    for c in cats:
        print(f"  {c}")


def count_4plus_by_category(session):
    # Display count of 4 star and higher reviews for each product category
    rows = session.execute("SELECT DISTINCT product_category FROM ProductCategories")
    cats = [r.product_category for r in rows]
    if not cats:
        print("No categories found.")
        return

    print("Count of 4 star and higher reviews per category:")
    for cat in cats:
        result = session.execute(
            "SELECT COUNT(*) AS c FROM ProductCategories WHERE product_category = %s AND stars >= 4 ALLOW FILTERING",
            (cat,)
        ).one()
        print(f"  {cat}: {result.c}")


def count_1star_for_category(session):
    # Display the count of 1 star reviews for a user entered product category
    cat = input("Enter product category: ").strip()
    result = session.execute(
        "SELECT COUNT(*) AS c FROM ProductCategories WHERE product_category = %s AND stars = 1",
        (cat,)
    ).one()
    print(f"1 star review count for '{cat}': {result.c}")


def run_select_statement(session):
    # Allow user to type in and execute CQL SELECT statements
    q = input("Enter a CQL SELECT statement: ").strip()
    if not q.lower().startswith("select"):
        print("Only SELECT statements are allowed.")
        return
    try:
        rows = session.execute(q)
        shown = 0
        for r in rows:
            print(r)
            shown += 1
            if shown >= 50:
                print("Output limited to 50 rows.")
                break
        if shown == 0:
            print("No rows returned.")
    except Exception as e:
        print(f"Query failed: {e}")


def add_remove_columns(session):
    """Allow user to add or remove columns from tables."""
    print("\nColumn Operations:")
    print("  A) Add a column")
    print("  R) Remove a column")
    choice = input("Choose operation (A/R): ").strip().upper()

    if choice == "A":
        table = input("Table to alter (Reviews or ProductCategories): ").strip()
        col = input("New column name: ").strip()
        ctype = input("Cassandra type (text, int, boolean, etc): ").strip()
        try:
            session.execute(f"ALTER TABLE {table} ADD {col} {ctype}")
            print(f"Added column {col} to {table}.")
        except Exception as e:
            print(f"Alter failed: {e}")
    elif choice == "R":
        table = input("Table to alter (Reviews or ProductCategories): ").strip()
        col = input("Column name to drop: ").strip()
        try:
            session.execute(f"ALTER TABLE {table} DROP {col}")
            print(f"Dropped column {col} from {table}.")
        except Exception as e:
            print(f"Alter failed: {e}")
    else:
        print("Invalid choice.")


def delete_tables(session):
    # Allow user to delete the Reviews and ProductCategories tables
    confirm = input("Type YES to drop both tables: ").strip()
    if confirm != "YES":
        print("Canceled.")
        return
    session.execute("DROP TABLE IF EXISTS Reviews")
    session.execute("DROP TABLE IF EXISTS ProductCategories")
    print("Dropped Reviews and ProductCategories tables.")


def delete_keyspace(session):
    # Allow user to delete the Amazon keyspace
    confirm = input("Type DELETE to drop keyspace amazon: ").strip()
    if confirm != "DELETE":
        print("Canceled.")
        return
    session.execute("DROP KEYSPACE IF EXISTS amazon")
    print("Dropped keyspace amazon.")


def menu():
    print("\nType in a number and press enter to execute the menu option.")
    print("1. Display product category list")
    print("2. Display high (4+) star review count")
    print("3. Display low (1) star review count")
    print("4. Enter a query")
    print("5. Add/Remove table columns")
    print("6. Delete tables")
    print("7. Delete keyspace")
    print("8. Exit the program")
    print()


def main():
    cluster, session = connect_with_retry()
    try:
        # Automatically setup keyspace, tables, and load data on startup
        print("Setting up Amazon keyspace and tables...")
        ensure_keyspace_and_tables(session)
        auto_load_data(session)
        print("Ready!\n")

        while True:
            menu()
            choice = input("Choose an option: ").strip()

            if choice == "1":
                show_distinct_categories(session)
            elif choice == "2":
                count_4plus_by_category(session)
            elif choice == "3":
                count_1star_for_category(session)
            elif choice == "4":
                run_select_statement(session)
            elif choice == "5":
                add_remove_columns(session)
            elif choice == "6":
                delete_tables(session)
            elif choice == "7":
                delete_keyspace(session)
            elif choice == "8":
                print("Goodbye.")
                break
            else:
                print("Invalid option.")
    finally:
        session.shutdown()
        cluster.shutdown()


if __name__ == "__main__":
    try:
        main()
    except KeyboardInterrupt:
        print("\nStopped.")
        sys.exit(0)