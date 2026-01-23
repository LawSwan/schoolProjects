"""
CRUD Operations Module
Handles Create, Read, Update, Delete operations for SQLite
"""

import pandas as pd
from datetime import datetime


def create_repository(conn, repo_name, watch_count):
    """
    Create a new repository entry in SQLite

    Args:
        conn: SQLite connection object
        repo_name: Repository name
        watch_count: Watch count value

    Returns:
        tuple: (success boolean, message string)
    """
    try:
        cursor = conn.cursor()

        cursor.execute(
            'INSERT INTO repositories (repo_name, watch_count, created_at) VALUES (?, ?, ?)',
            (repo_name, int(watch_count), datetime.now().isoformat())
        )

        conn.commit()
        new_id = cursor.lastrowid

        return True, f"✅ Repository '{repo_name}' added successfully with ID {new_id}!"
    except Exception as e:
        conn.rollback()
        return False, f"❌ Error creating repository: {str(e)}"


def read_repositories(conn, limit=100, search_term=None, sort_by='watch_count', sort_order='DESC'):
    """
    Read repositories from SQLite with optional filtering and sorting

    Args:
        conn: SQLite connection object
        limit: Maximum number of records to return
        search_term: Optional search string for repo_name
        sort_by: Field to sort by
        sort_order: 'ASC' or 'DESC'

    Returns:
        pandas.DataFrame: Repository data
    """
    try:
        cursor = conn.cursor()

        # Build query
        if search_term:
            query = f'''
                SELECT id as _id, repo_name, watch_count, created_at, updated_at
                FROM repositories
                WHERE repo_name LIKE ?
                ORDER BY {sort_by} {sort_order}
                LIMIT ?
            '''
            cursor.execute(query, (f'%{search_term}%', limit))
        else:
            query = f'''
                SELECT id as _id, repo_name, watch_count, created_at, updated_at
                FROM repositories
                ORDER BY {sort_by} {sort_order}
                LIMIT ?
            '''
            cursor.execute(query, (limit,))

        # Fetch results
        columns = [description[0] for description in cursor.description]
        rows = cursor.fetchall()

        # Convert to DataFrame
        df = pd.DataFrame(rows, columns=columns)
        return df
    except Exception as e:
        return pd.DataFrame()


def read_repository_by_id(conn, repo_id):
    """
    Read a specific repository by ID

    Args:
        conn: SQLite connection object
        repo_id: Repository ID

    Returns:
        dict: Repository document or None
    """
    try:
        cursor = conn.cursor()
        cursor.execute(
            'SELECT id, repo_name, watch_count, created_at, updated_at FROM repositories WHERE id = ?',
            (repo_id,)
        )

        row = cursor.fetchone()
        if row:
            return {
                '_id': row[0],
                'repo_name': row[1],
                'watch_count': row[2],
                'created_at': row[3],
                'updated_at': row[4]
            }
        return None
    except Exception as e:
        return None


def update_repository(conn, repo_id, new_name=None, new_watch_count=None):
    """
    Update a repository's information

    Args:
        conn: SQLite connection object
        repo_id: Repository ID to update
        new_name: New repository name (optional)
        new_watch_count: New watch count (optional)

    Returns:
        tuple: (success boolean, message string)
    """
    try:
        cursor = conn.cursor()

        # Build update fields
        update_fields = []
        params = []

        if new_name:
            update_fields.append('repo_name = ?')
            params.append(new_name)

        if new_watch_count is not None:
            update_fields.append('watch_count = ?')
            params.append(int(new_watch_count))

        if not update_fields:
            return False, "❌ No fields to update"

        # Always update the updated_at timestamp
        update_fields.append('updated_at = ?')
        params.append(datetime.now().isoformat())

        # Add repo_id to params
        params.append(repo_id)

        # Execute update
        query = f"UPDATE repositories SET {', '.join(update_fields)} WHERE id = ?"
        cursor.execute(query, params)

        conn.commit()

        if cursor.rowcount > 0:
            return True, f"✅ Repository ID {repo_id} updated successfully!"
        else:
            return False, f"❌ Repository ID {repo_id} not found"
    except Exception as e:
        conn.rollback()
        return False, f"❌ Error updating repository: {str(e)}"


def delete_repository(conn, repo_id):
    """
    Delete a repository by ID

    Args:
        conn: SQLite connection object
        repo_id: Repository ID to delete

    Returns:
        tuple: (success boolean, message string)
    """
    try:
        cursor = conn.cursor()
        cursor.execute('DELETE FROM repositories WHERE id = ?', (repo_id,))

        conn.commit()

        if cursor.rowcount > 0:
            return True, f"✅ Repository ID {repo_id} deleted successfully!"
        else:
            return False, f"❌ Repository ID {repo_id} not found"
    except Exception as e:
        conn.rollback()
        return False, f"❌ Error deleting repository: {str(e)}"


def delete_multiple_repositories(conn, repo_ids):
    """
    Delete multiple repositories by IDs

    Args:
        conn: SQLite connection object
        repo_ids: List of repository IDs

    Returns:
        tuple: (success boolean, message string)
    """
    try:
        cursor = conn.cursor()

        # Create placeholders for SQL IN clause
        placeholders = ','.join('?' * len(repo_ids))
        query = f'DELETE FROM repositories WHERE id IN ({placeholders})'

        cursor.execute(query, repo_ids)
        conn.commit()

        count = cursor.rowcount

        if count > 0:
            return True, f"✅ Successfully deleted {count} repositories"
        else:
            return False, "❌ No repositories found with given IDs"
    except Exception as e:
        conn.rollback()
        return False, f"❌ Error deleting repositories: {str(e)}"


def bulk_update_watch_count(conn, increase_by=0, decrease_by=0, where_clause=None):
    """
    Bulk update watch counts for multiple repositories

    Args:
        conn: SQLite connection object
        increase_by: Amount to increase watch count
        decrease_by: Amount to decrease watch count
        where_clause: Optional WHERE clause SQL string

    Returns:
        tuple: (success boolean, message string)
    """
    try:
        cursor = conn.cursor()

        if increase_by > 0:
            query = f'UPDATE repositories SET watch_count = watch_count + ?'
            params = [increase_by]
        elif decrease_by > 0:
            query = f'UPDATE repositories SET watch_count = watch_count - ?'
            params = [decrease_by]
        else:
            return False, "❌ No update value specified"

        if where_clause:
            query += f' WHERE {where_clause}'

        cursor.execute(query, params)
        conn.commit()

        if cursor.rowcount > 0:
            return True, f"✅ Updated {cursor.rowcount} repositories"
        else:
            return False, "❌ No repositories matched the criteria"
    except Exception as e:
        conn.rollback()
        return False, f"❌ Error in bulk update: {str(e)}"


def get_repository_count(conn, where_clause=None):
    """
    Get count of repositories matching optional filter

    Args:
        conn: SQLite connection object
        where_clause: Optional WHERE clause SQL string

    Returns:
        int: Count of matching repositories
    """
    try:
        cursor = conn.cursor()

        if where_clause:
            query = f'SELECT COUNT(*) FROM repositories WHERE {where_clause}'
        else:
            query = 'SELECT COUNT(*) FROM repositories'

        cursor.execute(query)
        return cursor.fetchone()[0]
    except Exception as e:
        return 0
