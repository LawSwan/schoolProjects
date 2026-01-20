"""
GitHub Archive Data Loader Module
Downloads and parses GitHub Archive data for Neo4j import
"""

import requests
import gzip
import json
from datetime import datetime, timedelta
import os


class GitHubArchiveLoader:
    """Handles downloading and parsing GitHub Archive data"""

    BASE_URL = "https://data.gharchive.org"

    def __init__(self, data_dir="data"):
        """
        Initialize the GitHub Archive loader

        Args:
            data_dir (str): Directory to store downloaded files
        """
        self.data_dir = data_dir
        if not os.path.exists(data_dir):
            os.makedirs(data_dir)
            print(f"Created data directory: {data_dir}")

    def download_archive(self, year, month, day, hour=0):
        """
        Download a specific hour of GitHub Archive data

        Args:
            year (int): Year (e.g., 2024)
            month (int): Month (1-12)
            day (int): Day (1-31)
            hour (int): Hour (0-23)

        Returns:
            str: Path to downloaded file, or None if failed
        """
        # Format the URL
        date_str = f"{year}-{month:02d}-{day:02d}-{hour}"
        filename = f"{date_str}.json.gz"
        url = f"{self.BASE_URL}/{filename}"
        filepath = os.path.join(self.data_dir, filename)

        # Check if already downloaded
        if os.path.exists(filepath):
            print(f"File already exists: {filepath}")
            return filepath

        # Download the file
        print(f"Downloading from {url}...")
        try:
            response = requests.get(url, stream=True, timeout=30)
            response.raise_for_status()

            # Save to file
            with open(filepath, 'wb') as f:
                for chunk in response.iter_content(chunk_size=8192):
                    f.write(chunk)

            print(f"Downloaded successfully: {filepath}")
            return filepath

        except requests.exceptions.RequestException as e:
            print(f"Error downloading {url}: {e}")
            return None

    def download_date_range(self, start_date, end_date, hours=[0]):
        """
        Download multiple hours/days of data

        Args:
            start_date (str): Start date in format 'YYYY-MM-DD'
            end_date (str): End date in format 'YYYY-MM-DD'
            hours (list): List of hours to download (0-23)

        Returns:
            list: List of downloaded file paths
        """
        start = datetime.strptime(start_date, '%Y-%m-%d')
        end = datetime.strptime(end_date, '%Y-%m-%d')

        downloaded_files = []
        current = start

        while current <= end:
            for hour in hours:
                filepath = self.download_archive(
                    current.year,
                    current.month,
                    current.day,
                    hour
                )
                if filepath:
                    downloaded_files.append(filepath)

            current += timedelta(days=1)

        print(f"\nDownloaded {len(downloaded_files)} files")
        return downloaded_files

    def parse_archive_file(self, filepath, limit=None):
        """
        Parse a GitHub Archive .json.gz file

        Args:
            filepath (str): Path to .json.gz file
            limit (int, optional): Maximum number of events to parse

        Returns:
            list: List of parsed event dictionaries
        """
        events = []

        print(f"Parsing {filepath}...")

        try:
            with gzip.open(filepath, 'rt', encoding='utf-8') as f:
                for i, line in enumerate(f):
                    if limit and i >= limit:
                        break

                    try:
                        event = json.loads(line)
                        events.append(event)
                    except json.JSONDecodeError as e:
                        print(f"Error parsing line {i}: {e}")
                        continue

            print(f"Parsed {len(events)} events from {filepath}")
            return events

        except Exception as e:
            print(f"Error reading file {filepath}: {e}")
            return []

    def extract_user_data(self, event):
        """
        Extract user information from a GitHub event

        Args:
            event (dict): GitHub event object

        Returns:
            dict: User data (id, username)
        """
        actor = event.get('actor', {})
        return {
            'user_id': actor.get('id'),
            'username': actor.get('login'),
            'display_name': actor.get('display_login')
        }

    def extract_repo_data(self, event):
        """
        Extract repository information from a GitHub event

        Args:
            event (dict): GitHub event object

        Returns:
            dict: Repository data (id, name)
        """
        repo = event.get('repo', {})
        return {
            'repo_id': repo.get('id'),
            'repo_name': repo.get('name')
        }

    def extract_event_data(self, event):
        """
        Extract event information from a GitHub event

        Args:
            event (dict): GitHub event object

        Returns:
            dict: Event data (id, type, created_at, payload)
        """
        return {
            'event_id': event.get('id'),
            'event_type': event.get('type'),
            'created_at': event.get('created_at'),
            'public': event.get('public'),
            'payload': event.get('payload', {})
        }

    def get_event_statistics(self, events):
        """
        Get statistics about a list of events

        Args:
            events (list): List of GitHub events

        Returns:
            dict: Statistics about the events
        """
        if not events:
            return {}

        event_types = {}
        languages = {}
        users = set()
        repos = set()

        for event in events:
            # Count event types
            event_type = event.get('type', 'Unknown')
            event_types[event_type] = event_types.get(event_type, 0) + 1

            # Track unique users
            actor = event.get('actor', {})
            if actor.get('id'):
                users.add(actor.get('id'))

            # Track unique repos
            repo = event.get('repo', {})
            if repo.get('id'):
                repos.add(repo.get('id'))

            # Extract language from payload (if available)
            payload = event.get('payload', {})
            if event_type == 'CreateEvent':
                if payload.get('ref_type') == 'repository':
                    # Language might be in the repository details
                    pass

        return {
            'total_events': len(events),
            'unique_users': len(users),
            'unique_repos': len(repos),
            'event_types': event_types
        }


def main():
    """Test the GitHub Archive loader"""
    loader = GitHubArchiveLoader()

    # Download a small sample (1 hour of data from January 1, 2024)
    print("="*50)
    print("Downloading GitHub Archive Sample Data")
    print("="*50)

    filepath = loader.download_archive(2024, 1, 1, 0)

    if filepath:
        # Parse the first 100 events as a test
        events = loader.parse_archive_file(filepath, limit=100)

        # Get statistics
        stats = loader.get_event_statistics(events)

        print("\n" + "="*50)
        print("EVENT STATISTICS")
        print("="*50)
        print(f"Total Events: {stats['total_events']}")
        print(f"Unique Users: {stats['unique_users']}")
        print(f"Unique Repos: {stats['unique_repos']}")
        print("\nEvent Types:")
        for event_type, count in sorted(stats['event_types'].items(), key=lambda x: x[1], reverse=True):
            print(f"  {event_type}: {count}")

        # Show sample event
        if events:
            print("\n" + "="*50)
            print("SAMPLE EVENT")
            print("="*50)
            sample = events[0]
            user = loader.extract_user_data(sample)
            repo = loader.extract_repo_data(sample)
            event = loader.extract_event_data(sample)

            print(f"Event Type: {event['event_type']}")
            print(f"User: {user['username']} (ID: {user['user_id']})")
            print(f"Repository: {repo['repo_name']} (ID: {repo['repo_id']})")
            print(f"Created At: {event['created_at']}")


if __name__ == "__main__":
    main()
