"""
GitHub API interactions
Author: Amber Lawson
Date: 2026-01-13
"""

import requests
import time
import config


class GitHubAPIClient:
    """Handles GitHub API requests"""

    def __init__(self):
        self.base_url = config.GITHUB_API_BASE
        self.headers = config.GITHUB_API_HEADERS

    def fetch_trending_repositories(self):
        """Fetch trending repositories from GitHub API"""
        all_repos = []

        for query in config.GITHUB_SEARCH_QUERIES:
            url = f'{self.base_url}/search/repositories?q={query}&sort=stars&order=desc&per_page=5'
            response = requests.get(url, headers=self.headers)

            if response.status_code == 200:
                data = response.json()
                all_repos.extend(data.get('items', []))
                time.sleep(1)  # Rate limit courtesy
            elif response.status_code == 403:
                # API rate limit reached
                return None, "Rate limit reached"

        return all_repos[:config.MAX_REPOS_TO_FETCH], None

    def fetch_repository_contributors(self, contributors_url):
        """Fetch contributors for a specific repository"""
        url = f'{contributors_url}?per_page={config.MAX_CONTRIBUTORS_PER_REPO}'
        response = requests.get(url, headers=self.headers)

        if response.status_code == 200:
            return response.json()
        return []

    def process_repository_data(self, repo):
        """Extract relevant data from repository object"""
        return {
            'name': repo['full_name'],
            'language': repo.get('language') or 'Unknown',
            'stars': repo['stargazers_count'],
            'description': repo.get('description') or 'No description',
            'topics': repo.get('topics', [])[:3],
            'contributors_url': repo['contributors_url']
        }

    def get_fallback_data(self):
        """Return fallback sample data when API is unavailable"""
        sample_repos = [
            {
                'name': "python/cpython",
                'language': "Python",
                'stars': 45000,
                'description': "The Python programming language",
                'topics': ["python", "programming"]
            },
            {
                'name': "facebook/react",
                'language': "JavaScript",
                'stars': 180000,
                'description': "A JavaScript library for building user interfaces",
                'topics': ["react", "javascript"]
            },
            {
                'name': "microsoft/vscode",
                'language': "TypeScript",
                'stars': 135000,
                'description': "Visual Studio Code",
                'topics': ["vscode", "editor", "typescript"]
            },
            {
                'name': "torvalds/linux",
                'language': "C",
                'stars': 140000,
                'description': "Linux kernel source tree",
                'topics': ["linux", "kernel", "c"]
            },
            {
                'name': "rust-lang/rust",
                'language': "Rust",
                'stars': 70000,
                'description': "Empowering everyone to build reliable software",
                'topics': ["rust", "programming"]
            }
        ]

        sample_contributors = [
            {"username": "torvalds", "commits": 3500, "repos": ["torvalds/linux"]},
            {"username": "gvanrossum", "commits": 2500, "repos": ["python/cpython"]},
            {"username": "gaearon", "commits": 2300, "repos": ["facebook/react"]}
        ]

        return sample_repos, sample_contributors
