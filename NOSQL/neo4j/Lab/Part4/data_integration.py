"""
Data Integration Module
Connects GitHub Archive data to Neo4j database
"""

from github_archive_loader import GitHubArchiveLoader
from github_neo4j_app import GitHubNeo4jApp


class DataIntegration:
    """Handles loading GitHub Archive data into Neo4j"""

    def __init__(self, neo4j_app, archive_loader):
        """
        Initialize data integration

        Args:
            neo4j_app (GitHubNeo4jApp): Neo4j application instance
            archive_loader (GitHubArchiveLoader): GitHub Archive loader instance
        """
        self.app = neo4j_app
        self.loader = archive_loader

    def load_events_to_neo4j(self, events, limit=None):
        """
        Load GitHub events into Neo4j database

        Args:
            events (list): List of GitHub event dictionaries
            limit (int, optional): Maximum number of events to load

        Returns:
            dict: Statistics about loaded data
        """
        stats = {
            'users_created': 0,
            'repos_created': 0,
            'events_created': 0,
            'contributions_created': 0,
            'errors': 0
        }

        events_to_process = events[:limit] if limit else events

        print(f"Loading {len(events_to_process)} events into Neo4j...")

        for i, event in enumerate(events_to_process):
            try:
                # Extract data
                user_data = self.loader.extract_user_data(event)
                repo_data = self.loader.extract_repo_data(event)
                event_data = self.loader.extract_event_data(event)

                # Skip if essential data is missing
                if not user_data['user_id'] or not repo_data['repo_id']:
                    continue

                # Create user
                self.app.create_user(
                    username=user_data['username'],
                    user_id=user_data['user_id']
                )
                stats['users_created'] += 1

                # Create repository (note: we don't have language info from events)
                # We'll need to get that from the GitHub API or payload
                language = self._extract_language_from_payload(event)

                # For repositories, we need an owner_id
                # In GitHub Archive, the actor might not be the owner
                # We'll use the actor as a contributor instead
                try:
                    self.app.create_repository(
                        repo_name=repo_data['repo_name'],
                        repo_id=repo_data['repo_id'],
                        owner_id=user_data['user_id'],  # Assuming actor is owner for simplicity
                        language=language
                    )
                    stats['repos_created'] += 1
                except:
                    # Repository might already exist with different owner
                    pass

                # Create contribution relationship
                self.app.create_contribution(
                    user_id=user_data['user_id'],
                    repo_id=repo_data['repo_id']
                )
                stats['contributions_created'] += 1

                # Create event
                self.app.create_event(
                    event_type=event_data['event_type'],
                    event_id=event_data['event_id'],
                    user_id=user_data['user_id'],
                    repo_id=repo_data['repo_id'],
                    created_at=event_data['created_at']
                )
                stats['events_created'] += 1

                # Progress indicator
                if (i + 1) % 10 == 0:
                    print(f"Processed {i + 1}/{len(events_to_process)} events...")

            except Exception as e:
                stats['errors'] += 1
                print(f"Error processing event {i}: {e}")
                continue

        print("\n" + "="*50)
        print("DATA LOADING COMPLETE")
        print("="*50)
        for key, value in stats.items():
            print(f"{key.replace('_', ' ').title()}: {value}")

        return stats

    def _extract_language_from_payload(self, event):
        """
        Try to extract programming language from event payload

        Args:
            event (dict): GitHub event

        Returns:
            str: Language name or None
        """
        payload = event.get('payload', {})
        event_type = event.get('type')

        # For CreateEvent, check repository details
        if event_type == 'CreateEvent':
            if payload.get('ref_type') == 'repository':
                return payload.get('master_branch')  # This might not have language

        # For PushEvent, check commits
        if event_type == 'PushEvent':
            commits = payload.get('commits', [])
            # We don't have language info in commits directly

        return None

    def download_and_load(self, year, month, day, hour=0, limit=100):
        """
        Download GitHub Archive data and load into Neo4j

        Args:
            year (int): Year
            month (int): Month
            day (int): Day
            hour (int): Hour (0-23)
            limit (int): Maximum number of events to load

        Returns:
            dict: Loading statistics
        """
        # Download the archive
        filepath = self.loader.download_archive(year, month, day, hour)

        if not filepath:
            print("Failed to download archive")
            return None

        # Parse events
        events = self.loader.parse_archive_file(filepath, limit=limit)

        if not events:
            print("No events parsed")
            return None

        # Load into Neo4j
        stats = self.load_events_to_neo4j(events, limit=limit)

        return stats


def main():
    """Test data integration"""
    # Connection details
    URI = "neo4j://localhost:7687"
    USER = "neo4j"
    PASSWORD = "password1"

    # Initialize components
    neo4j_app = GitHubNeo4jApp(URI, USER, PASSWORD)
    archive_loader = GitHubArchiveLoader()
    integration = DataIntegration(neo4j_app, archive_loader)

    try:
        print("="*50)
        print("GITHUB ARCHIVE TO NEO4J INTEGRATION")
        print("="*50)

        # Download and load sample data (first 50 events from Jan 1, 2024)
        stats = integration.download_and_load(
            year=2024,
            month=1,
            day=1,
            hour=0,
            limit=50
        )

        # Show database statistics
        print("\n" + "="*50)
        print("NEO4J DATABASE STATISTICS")
        print("="*50)
        db_stats = neo4j_app.get_database_stats()
        for key, value in db_stats.items():
            print(f"{key.capitalize()}: {value}")

    finally:
        neo4j_app.close()


if __name__ == "__main__":
    main()
