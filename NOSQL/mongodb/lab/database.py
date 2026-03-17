"""
Database Connection Module
Handles MongoDB connection and basic database operations
"""

import streamlit as st
from pymongo import MongoClient
import json
from datetime import datetime


@st.cache_resource
def init_mongodb(connection_string="mongodb://localhost:27017/"):
    """
    Initialize MongoDB connection

    Args:
        connection_string: MongoDB connection URI

    Returns:
        tuple: (collection object, connection status)
    """
    try:
        client = MongoClient(connection_string, serverSelectionTimeoutMS=5000)
        client.server_info()  # Test connection
        db = client['github_archive']
        collection = db['repositories']
        return collection, True
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


def import_data_to_mongo(collection, data):
    """
    Import JSON data to MongoDB

    Args:
        collection: MongoDB collection object
        data: List of dictionaries to import

    Returns:
        tuple: (success boolean, result message/count)
    """
    try:
        # Clear existing data
        collection.delete_many({})

        # Add unique ID and convert watch_count to int
        for i, item in enumerate(data):
            item['_id'] = i + 1
            item['watch_count'] = int(item['watch_count'])
            item['created_at'] = datetime.now().isoformat()

        # Insert data
        collection.insert_many(data)
        return True, len(data)
    except Exception as e:
        return False, str(e)


def get_database_stats(collection):
    """
    Get overall database statistics

    Args:
        collection: MongoDB collection object

    Returns:
        dict: Database statistics
    """
    try:
        total_repos = collection.count_documents({})

        # Aggregation for statistics
        pipeline = [
            {'$group': {
                '_id': None,
                'avg_watches': {'$avg': '$watch_count'},
                'total_watches': {'$sum': '$watch_count'},
                'max_watches': {'$max': '$watch_count'},
                'min_watches': {'$min': '$watch_count'}
            }}
        ]
        stats = list(collection.aggregate(pipeline))

        # Top repositories
        top_repos = list(collection.find({}).sort('watch_count', -1).limit(10))

        return {
            'total_repos': total_repos,
            'stats': stats[0] if stats else {},
            'top_repos': top_repos
        }
    except Exception as e:
        return None
