# Name: Amber Lawson
# Date: 2026-01-22
# Assignment: SQLite CRUD Assessment - EN_ReviewData
# Purpose: Create and manage an SQLite database using CRUD operations, import JSON data into related tables,
#          and provide a menu-driven interface to insert records, summarize product counts by category,
#          run SELECT queries, delete reviews by category, and delete all tables.

import os
import json
import sqlite3
from typing import Any, Dict, List, Optional

DB_FILE = "EN_ReviewData.db"


# -------------------- Utility Helpers --------------------
def connect_db() -> sqlite3.Connection:
    """Open a connection and enable foreign keys."""
    conn = sqlite3.connect(DB_FILE)
    conn.execute("PRAGMA foreign_keys = ON;")
    return conn


def safe_int(prompt: str, min_value: int = 0) -> int:
    """Prompt until user enters a valid integer >= min_value."""
    while True:
        raw = input(prompt).strip()
        try:
            val = int(raw)
            if val < min_value:
                print(f"Please enter a number >= {min_value}.")
                continue
            return val
        except ValueError:
            print("Please enter a valid integer.")


def press_enter() -> None:
    input("\nPress Enter to continue...")


def read_json_file(path: str) -> List[Dict[str, Any]]:
    """
    Read a JSON dataset from a file.
    Supports: a JSON list, a single JSON object, or JSON Lines (one object per line).
    """
    if not os.path.exists(path):
        raise FileNotFoundError(f"Could not find JSON file: {path}")

    with open(path, "r", encoding="utf-8") as f:
        content = f.read().strip()

    if not content:
        return []

    # Try standard JSON
    try:
        data = json.loads(content)
        if isinstance(data, dict):
            return [data]
        if isinstance(data, list):
            return data
    except json.JSONDecodeError:
        pass

    # Try JSON Lines
    rows: List[Dict[str, Any]] = []
    with open(path, "r", encoding="utf-8") as f:
        for line in f:
            line = line.strip()
            if not line:
                continue
            try:
                rows.append(json.loads(line))
            except json.JSONDecodeError:
                continue
    return rows


def pick_key(obj: Dict[str, Any], candidates: List[str]) -> Optional[str]:
    """Return the first candidate key that exists in obj and is not None."""
    for k in candidates:
        if k in obj and obj[k] is not None:
            return k
    return None


# -------------------- DB Setup --------------------
def create_database_and_tables() -> None:
    """
    *Create a new database named EN_ReviewData.
    *Create tables Reviewers, Categories, Products, Reviews with required keys.
    """
    conn = connect_db()
    cur = conn.cursor()

    # Reviewers
    cur.execute("""
        CREATE TABLE IF NOT EXISTS Reviewers (
            reviewer_id TEXT PRIMARY KEY
        );
    """)

    # Categories
    cur.execute("""
        CREATE TABLE IF NOT EXISTS Categories (
            product_category TEXT PRIMARY KEY
        );
    """)

    # Products
    cur.execute("""
        CREATE TABLE IF NOT EXISTS Products (
            product_id TEXT PRIMARY KEY,
            product_category TEXT NOT NULL,
            FOREIGN KEY (product_category) REFERENCES Categories(product_category)
        );
    """)

    # Reviews
    cur.execute("""
        CREATE TABLE IF NOT EXISTS Reviews (
            review_id TEXT PRIMARY KEY,
            product_id TEXT NOT NULL,
            reviewer_id TEXT NOT NULL,
            stars INTEGER,
            review_body TEXT,
            review_title TEXT,
            FOREIGN KEY (product_id) REFERENCES Products(product_id),
            FOREIGN KEY (reviewer_id) REFERENCES Reviewers(reviewer_id)
        );
    """)

    conn.commit()
    conn.close()


def import_json_into_tables(json_path: str) -> None:
    """
    *Insert data from the JSON file into the tables.
    This function maps common dataset key names into required columns.
    """
    data = read_json_file(json_path)
    if not data:
        print("No JSON data found to import.")
        return

    conn = connect_db()
    cur = conn.cursor()

    processed = 0

    for row in data:
        # Required IDs (try common key names)
        reviewer_key = pick_key(row, ["reviewer_id", "reviewerID", "reviewerId", "user_id", "userId"])
        category_key = pick_key(row, ["product_category", "category", "productCategory"])
        product_key = pick_key(row, ["product_id", "productID", "asin", "sku", "productId"])
        review_id_key = pick_key(row, ["review_id", "reviewID", "id", "reviewId"])

        if not (reviewer_key and category_key and product_key and review_id_key):
            continue

        reviewer_id = str(row[reviewer_key])
        product_category = str(row[category_key])
        product_id = str(row[product_key])
        review_id = str(row[review_id_key])

        # Optional fields
        stars_key = pick_key(row, ["stars", "rating", "overall", "score"])
        body_key = pick_key(row, ["review_body", "reviewText", "body", "text", "content"])
        title_key = pick_key(row, ["review_title", "summary", "title", "headline"])

        stars_val = row.get(stars_key) if stars_key else None
        try:
            stars = int(stars_val) if stars_val is not None else None
        except (ValueError, TypeError):
            stars = None

        review_body = str(row.get(body_key, "")) if body_key else ""
        review_title = str(row.get(title_key, "")) if title_key else ""

        # Insert into parent tables first
        cur.execute("INSERT OR IGNORE INTO Reviewers (reviewer_id) VALUES (?);", (reviewer_id,))
        cur.execute("INSERT OR IGNORE INTO Categories (product_category) VALUES (?);", (product_category,))
        cur.execute(
            "INSERT OR IGNORE INTO Products (product_id, product_category) VALUES (?, ?);",
            (product_id, product_category)
        )

        # Insert review row
        cur.execute("""
            INSERT OR IGNORE INTO Reviews
            (review_id, product_id, reviewer_id, stars, review_body, review_title)
            VALUES (?, ?, ?, ?, ?, ?);
        """, (review_id, product_id, reviewer_id, stars, review_body, review_title))

        processed += 1

    conn.commit()
    conn.close()
    print(f"Imported data. Processed {processed} review records (skipped rows missing required fields).")


# -------------------- Menu Operations --------------------
def insert_new_record() -> None:
    """
    *Allow the user to insert a row into any table.
    """
    table = input("Enter table name (Reviewers, Categories, Products, Reviews): ").strip()
    if table.lower() not in {"reviewers", "categories", "products", "reviews"}:
        print("Invalid table name.")
        return

    conn = connect_db()
    cur = conn.cursor()

    try:
        cur.execute(f"PRAGMA table_info({table});")
        cols_info = cur.fetchall()
        columns = [c[1] for c in cols_info]
    except sqlite3.Error as e:
        conn.close()
        print(f"SQLite error: {e}")
        return

    values: List[Any] = []
    print("\nEnter values (leave blank for NULL).")
    for col in columns:
        v = input(f"{col}: ").strip()
        values.append(None if v == "" else v)

    placeholders = ",".join(["?"] * len(columns))
    cols_join = ",".join(columns)

    try:
        cur.execute(f"INSERT INTO {table} ({cols_join}) VALUES ({placeholders});", tuple(values))
        conn.commit()
        print("Record inserted.")
    except sqlite3.IntegrityError as e:
        print(f"Integrity error: {e}")
    except sqlite3.Error as e:
        print(f"SQLite error: {e}")
    finally:
        conn.close()


def display_product_count_per_category() -> None:
    """
    *Display the categories that have at least a certain number of products determined by user input.
    Output format matches the sample: prints tuples like ('apparel', 401)
    """
    min_products = safe_int("What is the minimum product count?\n", 1)

    conn = connect_db()
    cur = conn.cursor()
    cur.execute("""
        SELECT product_category, COUNT(*) AS product_count
        FROM Products
        GROUP BY product_category
        HAVING COUNT(*) >= ?
        ORDER BY product_count DESC;
    """, (min_products,))
    rows = cur.fetchall()
    conn.close()

    print(f"\nDisplaying Categories with {min_products}+ products:")
    for r in rows:
        print(r)


def enter_select_query() -> None:
    """
    *Allow the user to type in and execute SQL SELECT statements.
    """
    sql = input("Enter a SQL SELECT statement:\n").strip()
    if not sql.lower().startswith("select"):
        print("Only SELECT statements are allowed.")
        return

    conn = connect_db()
    cur = conn.cursor()
    try:
        cur.execute(sql)
        rows = cur.fetchall()
        cols = [d[0] for d in cur.description] if cur.description else []
        conn.close()

        print("\nColumns:", cols)
        print("Rows:", len(rows))
        for r in rows[:50]:
            print(r)
        if len(rows) > 50:
            print("... (showing first 50 rows)")
    except sqlite3.Error as e:
        conn.close()
        print(f"SQLite error: {e}")


def delete_reviews_from_category() -> None:
    """
    *Delete all records in the Reviews table for a user-entered product_category.
    """
    category = input("Enter product_category to delete its reviews:\n").strip()
    if not category:
        print("No category entered.")
        return

    conn = connect_db()
    cur = conn.cursor()
    try:
        cur.execute("""
            DELETE FROM Reviews
            WHERE product_id IN (
                SELECT product_id FROM Products WHERE product_category = ?
            );
        """, (category,))
        deleted = cur.rowcount
        conn.commit()
        conn.close()
        print(f"Deleted {deleted} review(s) from category '{category}'.")
    except sqlite3.Error as e:
        conn.close()
        print(f"SQLite error: {e}")


def delete_all_tables() -> None:
    """
    *Allow the user to delete all tables in the database.
    """
    confirm = input("Type DELETE to delete all tables:\n").strip()
    if confirm != "DELETE":
        print("Cancelled.")
        return

    conn = connect_db()
    cur = conn.cursor()
    try:
        cur.execute("DROP TABLE IF EXISTS Reviews;")
        cur.execute("DROP TABLE IF EXISTS Products;")
        cur.execute("DROP TABLE IF EXISTS Categories;")
        cur.execute("DROP TABLE IF EXISTS Reviewers;")
        conn.commit()
        conn.close()
        print("All tables deleted.")
    except sqlite3.Error as e:
        conn.close()
        print(f"SQLite error: {e}")


# -------------------- Main Program --------------------
def main() -> None:
    # *Create database and tables on startup
    create_database_and_tables()

    # *Optional: import JSON when user wants (keeps menu close to sample output)
    json_path = input("Enter JSON file path to import (or press Enter to skip): ").strip()
    if json_path:
        try:
            import_json_into_tables(json_path)
        except Exception as e:
            print(f"Import error: {e}")
    else:
        # Check if database is empty and suggest importing data
        conn = connect_db()
        cur = conn.cursor()
        cur.execute("SELECT COUNT(*) FROM Products;")
        product_count = cur.fetchone()[0]
        conn.close()
        
        if product_count == 0:
            print("\nNote: No data found in database. Some menu options require data to be imported first.")
            print("You can import the EN_ReviewData.json file when you restart the program.")

    while True:
        print("\nType in a number and press enter to execute the menu option.")
        print("1. Insert a new record")
        print("2. Display product count per category")
        print("3. Enter a query")
        print("4. Delete reviews from a category")
        print("5. Delete all tables")
        print("6. Exit the program")

        choice = input().strip()

        if choice == "1":
            insert_new_record()
            press_enter()
        elif choice == "2":
            display_product_count_per_category()
            press_enter()
        elif choice == "3":
            enter_select_query()
            press_enter()
        elif choice == "4":
            delete_reviews_from_category()
            press_enter()
        elif choice == "5":
            delete_all_tables()
            press_enter()
        elif choice == "6":
            print("Goodbye.")
            break
        else:
            print("Invalid option.")


if __name__ == "__main__":
    main()