"""
Database operations for Cassandra
Author: Amber Lawson
Date: 2026-01-13
"""

from cassandra.cluster import Cluster
from cassandra.auth import PlainTextAuthProvider
from uuid import uuid4
from datetime import datetime
import config


class CassandraDatabase:
    """Handles all Cassandra database operations"""

    def __init__(self):
        self.cluster = None
        self.session = None

    def connect(self):
        """Establish connection to Cassandra with authentication"""
        auth = PlainTextAuthProvider(
            username=config.CASSANDRA_USERNAME,
            password=config.CASSANDRA_PASSWORD
        )
        self.cluster = Cluster(
            [config.CASSANDRA_HOST],
            port=config.CASSANDRA_PORT,
            auth_provider=auth
        )
        self.session = self.cluster.connect()
        self.setup_schema()

    def setup_schema(self):
        """Create keyspace and tables"""
        # Create keyspace
        self.session.execute(f"""
            CREATE KEYSPACE IF NOT EXISTS {config.CASSANDRA_KEYSPACE} WITH
            REPLICATION = {{'class': 'SimpleStrategy', 'replication_factor': 1}}
        """)

        self.session.set_keyspace(config.CASSANDRA_KEYSPACE)

        # Contributors table
        self.session.execute("""
            CREATE TABLE IF NOT EXISTS contributors (
                username text PRIMARY KEY,
                commit_count int,
                repositories set<text>,
                last_active timestamp
            )
        """)

        # Repositories table
        self.session.execute("""
            CREATE TABLE IF NOT EXISTS repositories (
                repo_id uuid PRIMARY KEY,
                repo_name text,
                language text,
                stars int,
                description text,
                created_date timestamp
            )
        """)

        # Topics table
        self.session.execute("""
            CREATE TABLE IF NOT EXISTS topics (
                topic text PRIMARY KEY,
                repo_count int,
                total_stars int,
                last_updated timestamp
            )
        """)

    def insert_repository(self, repo_name, language, stars, description):
        """Insert a repository (CREATE)"""
        repo_id = uuid4()
        self.session.execute("""
            INSERT INTO repositories (repo_id, repo_name, language, stars, description, created_date)
            VALUES (%s, %s, %s, %s, %s, %s)
        """, (repo_id, repo_name, language, stars, description[:200], datetime.now()))
        return repo_id

    def insert_or_update_topic(self, topic, stars):
        """Insert or update a topic (CREATE/UPDATE)"""
        result = self.session.execute("SELECT * FROM topics WHERE topic = %s", (topic,))
        existing = result.one()

        if existing:
            # Update existing topic
            new_repo_count = existing.repo_count + 1
            new_total_stars = existing.total_stars + stars
            self.session.execute("""
                UPDATE topics SET repo_count = %s,
                                total_stars = %s,
                                last_updated = %s
                WHERE topic = %s
            """, (new_repo_count, new_total_stars, datetime.now(), topic))
        else:
            # Create new topic
            self.session.execute("""
                INSERT INTO topics (topic, repo_count, total_stars, last_updated)
                VALUES (%s, 1, %s, %s)
            """, (topic, stars, datetime.now()))

    def insert_contributor(self, username, commit_count, repositories):
        """Insert a contributor (CREATE)"""
        self.session.execute("""
            INSERT INTO contributors (username, commit_count, repositories, last_active)
            VALUES (%s, %s, %s, %s)
        """, (username, commit_count, repositories, datetime.now()))

    def get_all_contributors(self):
        """Retrieve all contributors (READ)"""
        results = self.session.execute("SELECT * FROM contributors")
        return sorted(results, key=lambda x: x.commit_count, reverse=True)

    def get_all_repositories(self):
        """Retrieve all repositories (READ)"""
        return self.session.execute("SELECT language, repo_name, stars FROM repositories")

    def get_all_topics(self):
        """Retrieve all topics (READ)"""
        results = self.session.execute("SELECT * FROM topics")
        return sorted(results, key=lambda x: x.total_stars, reverse=True)

    def clear_all_data(self):
        """Clear all data from tables (DELETE)"""
        self.session.execute("TRUNCATE contributors")
        self.session.execute("TRUNCATE repositories")
        self.session.execute("TRUNCATE topics")

    def close(self):
        """Close database connections"""
        if self.session:
            self.session.shutdown()
        if self.cluster:
            self.cluster.shutdown()
