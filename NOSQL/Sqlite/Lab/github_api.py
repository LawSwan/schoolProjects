"""
GitHub API Integration Module
Handles fetching live data from GitHub's REST API
"""

import requests
import time
from datetime import datetime
from typing import List, Dict, Tuple, Optional


class GitHubAPI:
    """
    GitHub API client for fetching live repository data

    Uses GitHub's REST API v3 (no authentication required for basic usage)
    Rate limit: 60 requests/hour for unauthenticated requests
    """

    BASE_URL = "https://api.github.com"

    def __init__(self, access_token: Optional[str] = None):
        """
        Initialize GitHub API client

        Args:
            access_token: Optional GitHub personal access token for higher rate limits
        """
        self.access_token = access_token
        self.session = requests.Session()

        if access_token:
            self.session.headers.update({
                'Authorization': f'token {access_token}',
                'Accept': 'application/vnd.github.v3+json'
            })
        else:
            self.session.headers.update({
                'Accept': 'application/vnd.github.v3+json'
            })

    def get_rate_limit(self) -> Dict:
        """
        Get current API rate limit status

        Returns:
            dict: Rate limit information
        """
        try:
            response = self.session.get(f"{self.BASE_URL}/rate_limit")
            if response.status_code == 200:
                data = response.json()
                core = data['resources']['core']
                return {
                    'limit': core['limit'],
                    'remaining': core['remaining'],
                    'reset_time': datetime.fromtimestamp(core['reset']).strftime('%Y-%m-%d %H:%M:%S'),
                    'used': core['limit'] - core['remaining']
                }
            return None
        except Exception as e:
            return None

    def search_repositories(self, query: str, sort: str = "stars", max_results: int = 30) -> Tuple[List[Dict], Optional[str]]:
        """
        Search GitHub repositories

        Args:
            query: Search query (e.g., "language:python", "react", "machine learning")
            sort: Sort by 'stars', 'forks', or 'updated'
            max_results: Maximum number of results (max 100)

        Returns:
            tuple: (list of repositories, error message)
        """
        try:
            params = {
                'q': query,
                'sort': sort,
                'order': 'desc',
                'per_page': min(max_results, 100)
            }

            response = self.session.get(f"{self.BASE_URL}/search/repositories", params=params)

            if response.status_code == 200:
                data = response.json()
                repos = []

                for item in data['items']:
                    repos.append({
                        'repo_name': item['full_name'],
                        'watch_count': item['watchers_count'],
                        'stars': item['stargazers_count'],
                        'forks': item['forks_count'],
                        'language': item.get('language', 'Unknown'),
                        'description': item.get('description', ''),
                        'url': item['html_url'],
                        'created_at': item['created_at'],
                        'updated_at': item['updated_at']
                    })

                return repos, None
            elif response.status_code == 403:
                return [], "Rate limit exceeded. Please wait before making more requests."
            else:
                return [], f"API error: {response.status_code}"

        except Exception as e:
            return [], f"Error: {str(e)}"

    def get_repository_details(self, owner: str, repo: str) -> Tuple[Optional[Dict], Optional[str]]:
        """
        Get detailed information about a specific repository

        Args:
            owner: Repository owner (e.g., 'facebook')
            repo: Repository name (e.g., 'react')

        Returns:
            tuple: (repository data dict, error message)
        """
        try:
            response = self.session.get(f"{self.BASE_URL}/repos/{owner}/{repo}")

            if response.status_code == 200:
                item = response.json()
                repo_data = {
                    'repo_name': item['full_name'],
                    'watch_count': item['watchers_count'],
                    'stars': item['stargazers_count'],
                    'forks': item['forks_count'],
                    'language': item.get('language', 'Unknown'),
                    'description': item.get('description', ''),
                    'url': item['html_url'],
                    'open_issues': item['open_issues_count'],
                    'created_at': item['created_at'],
                    'updated_at': item['updated_at'],
                    'size': item['size'],
                    'default_branch': item['default_branch']
                }
                return repo_data, None
            elif response.status_code == 404:
                return None, "Repository not found"
            elif response.status_code == 403:
                return None, "Rate limit exceeded"
            else:
                return None, f"API error: {response.status_code}"

        except Exception as e:
            return None, f"Error: {str(e)}"

    def get_trending_repositories(self, language: str = "", since: str = "daily") -> Tuple[List[Dict], Optional[str]]:
        """
        Get trending repositories (uses search API with date filters)

        Args:
            language: Programming language filter (e.g., 'python', 'javascript')
            since: Time period - 'daily', 'weekly', 'monthly'

        Returns:
            tuple: (list of repositories, error message)
        """
        try:
            # Calculate date based on 'since' parameter
            from datetime import datetime, timedelta

            if since == "daily":
                date = (datetime.now() - timedelta(days=1)).strftime('%Y-%m-%d')
            elif since == "weekly":
                date = (datetime.now() - timedelta(days=7)).strftime('%Y-%m-%d')
            else:  # monthly
                date = (datetime.now() - timedelta(days=30)).strftime('%Y-%m-%d')

            # Build query
            query = f"created:>{date}"
            if language:
                query += f" language:{language}"

            return self.search_repositories(query, sort="stars", max_results=30)

        except Exception as e:
            return [], f"Error: {str(e)}"

    def get_popular_by_language(self, language: str, max_results: int = 30) -> Tuple[List[Dict], Optional[str]]:
        """
        Get most popular repositories for a specific programming language

        Args:
            language: Programming language (e.g., 'python', 'javascript', 'go')
            max_results: Maximum number of results

        Returns:
            tuple: (list of repositories, error message)
        """
        query = f"language:{language}"
        return self.search_repositories(query, sort="stars", max_results=max_results)

    def batch_get_repositories(self, repo_names: List[str]) -> Tuple[List[Dict], List[str]]:
        """
        Get details for multiple repositories

        Args:
            repo_names: List of full repo names (e.g., ['facebook/react', 'microsoft/vscode'])

        Returns:
            tuple: (list of successful fetches, list of errors)
        """
        results = []
        errors = []

        for repo_name in repo_names:
            try:
                parts = repo_name.split('/')
                if len(parts) != 2:
                    errors.append(f"Invalid format: {repo_name}")
                    continue

                owner, repo = parts
                data, error = self.get_repository_details(owner, repo)

                if data:
                    results.append(data)
                else:
                    errors.append(f"{repo_name}: {error}")

                # Rate limiting: wait 1 second between requests
                time.sleep(1)

            except Exception as e:
                errors.append(f"{repo_name}: {str(e)}")

        return results, errors


def import_github_data_to_db(conn, repos_data: List[Dict]) -> Tuple[bool, str]:
    """
    Import GitHub API repository data into SQLite database

    Args:
        conn: SQLite connection object
        repos_data: List of repository dictionaries from GitHub API

    Returns:
        tuple: (success boolean, message string)
    """
    try:
        from crud_operations import create_repository

        success_count = 0
        error_count = 0

        for repo in repos_data:
            success, msg = create_repository(
                conn,
                repo['repo_name'],
                repo['watch_count']
            )

            if success:
                success_count += 1
            else:
                error_count += 1

        if success_count > 0:
            return True, f"✅ Imported {success_count} repositories (Errors: {error_count})"
        else:
            return False, f"❌ Failed to import repositories (Errors: {error_count})"

    except Exception as e:
        return False, f"❌ Import error: {str(e)}"


def update_repo_from_github(conn, repo_id: int, github_api: GitHubAPI) -> Tuple[bool, str]:
    """
    Update a repository's data from live GitHub API

    Args:
        conn: SQLite connection object
        repo_id: Repository ID in database
        github_api: GitHubAPI instance

    Returns:
        tuple: (success boolean, message string)
    """
    try:
        from crud_operations import read_repository_by_id, update_repository

        # Get current repo data
        repo = read_repository_by_id(conn, repo_id)
        if not repo:
            return False, "Repository not found in database"

        # Parse repo name
        repo_name = repo['repo_name']
        parts = repo_name.split('/')

        if len(parts) != 2:
            return False, "Invalid repository name format"

        owner, name = parts

        # Fetch live data
        live_data, error = github_api.get_repository_details(owner, name)

        if error:
            return False, f"GitHub API error: {error}"

        if live_data:
            # Update database
            success, msg = update_repository(
                conn,
                repo_id,
                new_watch_count=live_data['watch_count']
            )

            if success:
                old_count = repo['watch_count']
                new_count = live_data['watch_count']
                diff = new_count - old_count
                return True, f"✅ Updated {repo_name}: {old_count} → {new_count} (Change: {diff:+d})"
            else:
                return False, msg
        else:
            return False, "No data returned from GitHub"

    except Exception as e:
        return False, f"Error: {str(e)}"
