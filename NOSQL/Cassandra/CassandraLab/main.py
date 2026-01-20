"""
Cassandra GitHub Archive Analyzer - Main Application
Author: Amber Lawson
Date: 2026-01-13
Project: 3.3 Group Project - Cassandra Integration

Description:
This application integrates with Cassandra to analyze live GitHub data via API.
Features include:
1. Most Active Contributors - Track and display top contributors by commit count
2. Repository Language Statistics - Analyze programming language distribution
3. Trending Topics - Identify popular topics/repositories
"""

import tkinter as tk
from tkinter import messagebox
import time
from database import CassandraDatabase
from github_api import GitHubAPIClient
from gui import GitHubAnalyzerGUI
import config


class GitHubAnalyzerApp:
    """Main application controller"""

    def __init__(self, root):
        self.root = root
        self.db = CassandraDatabase()
        self.api_client = GitHubAPIClient()
        self.gui = None

        # Connect to database
        self.connect_database()

        # Initialize GUI
        self.gui = GitHubAnalyzerGUI(root, self)

    def connect_database(self):
        """Connect to Cassandra database"""
        try:
            self.db.connect()
            print("✅ Connected to Cassandra successfully!")
        except Exception as e:
            messagebox.showerror(
                "Database Connection Error",
                f"Failed to connect to Cassandra:\n{e}\n\nMake sure Cassandra is running."
            )

    def load_github_data(self):
        """Fetch and load GitHub data via API"""
        try:
            self.gui.update_status("Fetching live data from GitHub API...")

            # Fetch repositories from API
            repos, error = self.api_client.fetch_trending_repositories()

            if error or not repos:
                self.gui.show_warning("API Limit", "GitHub API rate limit reached. Loading fallback data instead.")
                self.load_fallback_data()
                return

            # Process and store data
            contributor_data = {}
            processed_count = 0

            for repo in repos:
                repo_data = self.api_client.process_repository_data(repo)

                # Insert repository
                self.db.insert_repository(
                    repo_data['name'],
                    repo_data['language'],
                    repo_data['stars'],
                    repo_data['description']
                )

                # Insert/Update topics
                for topic in repo_data['topics']:
                    self.db.insert_or_update_topic(topic, repo_data['stars'])

                # Fetch and process contributors
                contributors = self.api_client.fetch_repository_contributors(repo_data['contributors_url'])

                for contrib in contributors:
                    username = contrib['login']
                    contributions = contrib['contributions']

                    if username not in contributor_data:
                        contributor_data[username] = {'commits': 0, 'repos': set()}

                    contributor_data[username]['commits'] += contributions
                    contributor_data[username]['repos'].add(repo_data['name'])

                processed_count += 1
                self.gui.update_status(f"Loaded {processed_count}/{len(repos)} repositories...")
                time.sleep(config.API_RATE_LIMIT_DELAY)

            # Insert contributors
            for username, data in list(contributor_data.items())[:config.MAX_CONTRIBUTORS_TO_STORE]:
                self.db.insert_contributor(username, data['commits'], data['repos'])

            # Show success
            topics_count = len(set([t for r in repos for t in self.api_client.process_repository_data(r)['topics']]))
            self.gui.update_status(f"Loaded {len(repos)} repos, {len(contributor_data)} contributors from GitHub API!")
            self.gui.show_success(
                "Success",
                f"Live GitHub data loaded!\n\n"
                f"Repositories: {len(repos)}\n"
                f"Contributors: {min(config.MAX_CONTRIBUTORS_TO_STORE, len(contributor_data))}\n"
                f"Topics: {topics_count}"
            )

        except Exception as e:
            self.gui.show_error("Error", f"Failed to load data:\n{e}\n\nTrying fallback data...")
            self.load_fallback_data()

    def load_fallback_data(self):
        """Load fallback sample data if API fails"""
        try:
            sample_repos, sample_contributors = self.api_client.get_fallback_data()

            # Insert repositories and topics
            for repo in sample_repos:
                self.db.insert_repository(
                    repo['name'],
                    repo['language'],
                    repo['stars'],
                    repo['description']
                )

                for topic in repo['topics']:
                    self.db.insert_or_update_topic(topic, repo['stars'])

            # Insert contributors
            for contrib in sample_contributors:
                self.db.insert_contributor(
                    contrib['username'],
                    contrib['commits'],
                    set(contrib['repos'])
                )

            self.gui.update_status("Fallback data loaded")
            self.gui.show_success("Success", "Sample data loaded (API unavailable)")

        except Exception as e:
            self.gui.show_error("Error", f"Failed to load fallback data:\n{e}")

    def display_contributors(self):
        """Display most active contributors"""
        try:
            contributors = self.db.get_all_contributors()
            self.gui.display_contributors_data(contributors)
            self.gui.update_status(f"Displayed {len(contributors)} contributors")
        except Exception as e:
            self.gui.show_error("Error", f"Failed to display contributors:\n{e}")

    def display_languages(self):
        """Display repository language statistics"""
        try:
            results = self.db.get_all_repositories()

            # Aggregate statistics
            language_stats = {}
            for row in results:
                if row.language not in language_stats:
                    language_stats[row.language] = {'count': 0, 'total_stars': 0, 'repos': []}
                language_stats[row.language]['count'] += 1
                language_stats[row.language]['total_stars'] += row.stars
                language_stats[row.language]['repos'].append((row.repo_name, row.stars))

            # Sort by repository count
            sorted_languages = sorted(
                language_stats.items(),
                key=lambda x: x[1]['count'],
                reverse=True
            )

            self.gui.display_languages_data(sorted_languages)
            self.gui.update_status(f"Displayed statistics for {len(sorted_languages)} languages")

        except Exception as e:
            self.gui.show_error("Error", f"Failed to display languages:\n{e}")

    def display_topics(self):
        """Display trending topics"""
        try:
            topics = self.db.get_all_topics()
            self.gui.display_topics_data(topics)
            self.gui.update_status(f"Displayed {len(topics)} trending topics")
        except Exception as e:
            self.gui.show_error("Error", f"Failed to display topics:\n{e}")

    def clear_all_data(self):
        """Clear all data from database"""
        if messagebox.askyesno("Confirm", "Are you sure you want to delete all data?"):
            try:
                self.db.clear_all_data()
                self.gui.show_success("Success", "All data cleared!")
                self.gui.update_status("All data cleared from database")
            except Exception as e:
                self.gui.show_error("Error", f"Failed to clear data:\n{e}")

    def close(self):
        """Close application and database connections"""
        self.db.close()
        self.root.destroy()


def main():
    """Application entry point"""
    root = tk.Tk()
    app = GitHubAnalyzerApp(root)
    root.protocol("WM_DELETE_WINDOW", app.close)
    root.mainloop()


if __name__ == "__main__":
    main()
