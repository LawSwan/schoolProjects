"""
Database Connection Module
Handles SQLite connection and basic database operations
"""

import streamlit as st
import sqlite3
import json
from datetime import datetime
import os


@st.cache_resource
def init_sqlite(db_path="github_archive.db"):
    """
    Initialize SQLite connection and create tables

    Args:
        db_path: Path to SQLite database file

    Returns:
        tuple: (connection object, connection status)
    """
    try:
        conn = sqlite3.connect(db_path, check_same_thread=False)
        conn.row_factory = sqlite3.Row  # Enable column access by name

        # Create repositories table if it doesn't exist
        cursor = conn.cursor()
        cursor.execute('''
            CREATE TABLE IF NOT EXISTS repositories (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                repo_name TEXT NOT NULL,
                watch_count INTEGER NOT NULL DEFAULT 0,
                created_at TEXT,
                updated_at TEXT
            )
        ''')

        # Create indexes for better performance
        cursor.execute('''
            CREATE INDEX IF NOT EXISTS idx_repo_name
            ON repositories(repo_name)
        ''')
        cursor.execute('''
            CREATE INDEX IF NOT EXISTS idx_watch_count
            ON repositories(watch_count)
        ''')

        conn.commit()
        return conn, True
    except Exception as e:
        return None, str(e)


def load_json_data(file_path):
    """
    Load JSONL data from file

    Args:
        file_path: Path to JSON file

    Returns:
        list: Parsed JSON data
    """
    try:
        data = []
        with open(file_path, 'r') as f:
            for line in f:
                data.append(json.loads(line.strip()))
        return data, None
    except Exception as e:
        return None, str(e)


def import_data_to_sqlite(conn, data):
    """
    Import JSON data to SQLite

    Args:
        conn: SQLite connection object
        data: List of dictionaries to import

    Returns:
        tuple: (success boolean, result message/count)
    """
    try:
        cursor = conn.cursor()

        # Clear existing data
        cursor.execute('DELETE FROM repositories')

        # Reset autoincrement counter
        cursor.execute('DELETE FROM sqlite_sequence WHERE name="repositories"')

        # Prepare data for insertion
        insert_data = []
        for item in data:
            insert_data.append((
                item.get('repo_name', 'Unknown'),
                int(item.get('watch_count', 0)),
                datetime.now().isoformat()
            ))

        # Bulk insert
        cursor.executemany(
            'INSERT INTO repositories (repo_name, watch_count, created_at) VALUES (?, ?, ?)',
            insert_data
        )

        conn.commit()
        return True, len(insert_data)
    except Exception as e:
        conn.rollback()
        return False, str(e)


def get_database_stats(conn):
    """
    Get overall database statistics

    Args:
        conn: SQLite connection object

    Returns:
        dict: Database statistics
    """
    try:
        cursor = conn.cursor()

        # Get total count
        cursor.execute('SELECT COUNT(*) as total FROM repositories')
        total_repos = cursor.fetchone()[0]

        # Get aggregate statistics
        cursor.execute('''
            SELECT
                AVG(watch_count) as avg_watches,
                SUM(watch_count) as total_watches,
                MAX(watch_count) as max_watches,
                MIN(watch_count) as min_watches
            FROM repositories
        ''')
        stats_row = cursor.fetchone()

        stats = {
            'avg_watches': stats_row[0] or 0,
            'total_watches': stats_row[1] or 0,
            'max_watches': stats_row[2] or 0,
            'min_watches': stats_row[3] or 0
        }

        # Get top repositories
        cursor.execute('''
            SELECT id, repo_name, watch_count, created_at
            FROM repositories
            ORDER BY watch_count DESC
            LIMIT 10
        ''')

        top_repos = []
        for row in cursor.fetchall():
            top_repos.append({
                '_id': row[0],
                'repo_name': row[1],
                'watch_count': row[2],
                'created_at': row[3]
            })

        return {
            'total_repos': total_repos,
            'stats': stats,
            'top_repos': top_repos
        }
    except Exception as e:
        return None


def close_connection(conn):
    """
    Safely close database connection

    Args:
        conn: SQLite connection object
    """
    if conn:
        conn.close()
