"""
CRUD Operations Module
Handles Create, Read, Update, Delete operations for MongoDB
"""

import pandas as pd
from datetime import datetime


def create_repository(collection, repo_name, watch_count):
    """
    Create a new repository entry in MongoDB

    Args:
        collection: MongoDB collection object
        repo_name: Repository name
        watch_count: Watch count value

    Returns:
        tuple: (success boolean, message string)
    """
    try:
        # Get max ID to generate new unique ID
        max_doc = collection.find_one(sort=[('_id', -1)])
        new_id = (max_doc['_id'] + 1) if max_doc else 1

        doc = {
            '_id': new_id,
            'repo_name': repo_name,
            'watch_count': int(watch_count),
            'created_at': datetime.now().isoformat()
        }

        collection.insert_one(doc)
        return True, f"✅ Repository '{repo_name}' added successfully with ID {new_id}!"
    except Exception as e:
        return False, f"❌ Error creating repository: {str(e)}"


def read_repositories(collection, limit=100, search_term=None, sort_by='watch_count', sort_order=-1):
    """
    Read repositories from MongoDB with optional filtering and sorting

    Args:
        collection: MongoDB collection object
        limit: Maximum number of records to return
        search_term: Optional search string for repo_name
        sort_by: Field to sort by
        sort_order: 1 for ascending, -1 for descending

    Returns:
        pandas.DataFrame: Repository data
    """
    try:
        if search_term:
            query = {'repo_name': {'$regex': search_term, '$options': 'i'}}
            data = list(collection.find(query).sort(sort_by, sort_order).limit(limit))
        else:
            data = list(collection.find({}).sort(sort_by, sort_order).limit(limit))

        return pd.DataFrame(data)
    except Exception as e:
        return pd.DataFrame()


def read_repository_by_id(collection, repo_id):
    """
    Read a specific repository by ID

    Args:
        collection: MongoDB collection object
        repo_id: Repository ID

    Returns:
        dict: Repository document or None
    """
    try:
        return collection.find_one({'_id': repo_id})
    except Exception as e:
        return None


def update_repository(collection, repo_id, new_name=None, new_watch_count=None):
    """
    Update a repository's information

    Args:
        collection: MongoDB collection object
        repo_id: Repository ID to update
        new_name: New repository name (optional)
        new_watch_count: New watch count (optional)

    Returns:
        tuple: (success boolean, message string)
    """
    try:
        # Build update document
        update_fields = {}
        if new_name:
            update_fields['repo_name'] = new_name
        if new_watch_count is not None:
            update_fields['watch_count'] = int(new_watch_count)

        if not update_fields:
            return False, "❌ No fields to update"

        update_fields['updated_at'] = datetime.now().isoformat()

        result = collection.update_one(
            {'_id': repo_id},
            {'$set': update_fields}
        )

        if result.modified_count > 0:
            return True, f"✅ Repository ID {repo_id} updated successfully!"
        elif result.matched_count > 0:
            return True, "ℹ️ Repository found but no changes were needed"
        else:
            return False, f"❌ Repository ID {repo_id} not found"
    except Exception as e:
        return False, f"❌ Error updating repository: {str(e)}"


def delete_repository(collection, repo_id):
    """
    Delete a repository by ID

    Args:
        collection: MongoDB collection object
        repo_id: Repository ID to delete

    Returns:
        tuple: (success boolean, message string)
    """
    try:
        result = collection.delete_one({'_id': repo_id})

        if result.deleted_count > 0:
            return True, f"✅ Repository ID {repo_id} deleted successfully!"
        else:
            return False, f"❌ Repository ID {repo_id} not found"
    except Exception as e:
        return False, f"❌ Error deleting repository: {str(e)}"


def delete_multiple_repositories(collection, repo_ids):
    """
    Delete multiple repositories by IDs

    Args:
        collection: MongoDB collection object
        repo_ids: List of repository IDs

    Returns:
        tuple: (success boolean, message string)
    """
    try:
        result = collection.delete_many({'_id': {'$in': repo_ids}})
        count = result.deleted_count

        if count > 0:
            return True, f"✅ Successfully deleted {count} repositories"
        else:
            return False, "❌ No repositories found with given IDs"
    except Exception as e:
        return False, f"❌ Error deleting repositories: {str(e)}"


def bulk_update_watch_count(collection, increase_by=0, decrease_by=0, filter_query=None):
    """
    Bulk update watch counts for multiple repositories

    Args:
        collection: MongoDB collection object
        increase_by: Amount to increase watch count
        decrease_by: Amount to decrease watch count
        filter_query: Optional filter to apply (dict)

    Returns:
        tuple: (success boolean, message string)
    """
    try:
        query = filter_query if filter_query else {}

        if increase_by > 0:
            result = collection.update_many(
                query,
                {'$inc': {'watch_count': increase_by}}
            )
        elif decrease_by > 0:
            result = collection.update_many(
                query,
                {'$inc': {'watch_count': -decrease_by}}
            )
        else:
            return False, "❌ No update value specified"

        if result.modified_count > 0:
            return True, f"✅ Updated {result.modified_count} repositories"
        else:
            return False, "❌ No repositories matched the criteria"
    except Exception as e:
        return False, f"❌ Error in bulk update: {str(e)}"


def get_repository_count(collection, filter_query=None):
    """
    Get count of repositories matching optional filter

    Args:
        collection: MongoDB collection object
        filter_query: Optional filter to apply (dict)

    Returns:
        int: Count of matching repositories
    """
    try:
        query = filter_query if filter_query else {}
        return collection.count_documents(query)
    except Exception as e:
        return 0
