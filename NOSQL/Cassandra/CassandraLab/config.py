"""
Configuration settings for Cassandra GitHub Analyzer
Author: Amber Lawson
Date: 2026-01-13
"""

# Cassandra Configuration
CASSANDRA_HOST = "localhost"
CASSANDRA_PORT = 9042
CASSANDRA_USERNAME = "amblaw9047"
CASSANDRA_PASSWORD = "cassPass"
CASSANDRA_KEYSPACE = "github_archive"

# GitHub API Configuration
GITHUB_API_BASE = "https://api.github.com"
GITHUB_API_HEADERS = {'Accept': 'application/vnd.github.v3+json'}

# Search queries for trending repositories
GITHUB_SEARCH_QUERIES = [
    'stars:>50000 language:Python',
    'stars:>50000 language:JavaScript',
    'stars:>50000 language:TypeScript',
    'stars:>50000 language:Go',
    'stars:>50000 language:Rust',
    'stars:>50000 language:Java'
]

# Application settings
MAX_REPOS_TO_FETCH = 20
MAX_CONTRIBUTORS_PER_REPO = 5
MAX_CONTRIBUTORS_TO_STORE = 30
API_RATE_LIMIT_DELAY = 0.5  # seconds between requests

# GUI Configuration
WINDOW_TITLE = "Cassandra GitHub Archive Analyzer"
WINDOW_SIZE = "900x700"
