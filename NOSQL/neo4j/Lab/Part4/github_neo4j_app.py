import os
import json
from neo4j import GraphDatabase
from datetime import datetime

class GitHubNeo4jApp:
    """
    A Python application that integrates with Neo4j to store and analyze GitHub Archive data.
    Provides CRUD operations and analytical features for GitHub events and repositories.
    """

    def __init__(self, uri, user, password):
        """Initialize connection to Neo4j database"""
        self.driver = GraphDatabase.driver(uri, auth=(user, password))
        print(f"Connected to Neo4j at {uri}")

    def close(self):
        """Close the database connection"""
        self.driver.close()
        print("Connection to Neo4j closed.")

    # ==================== CRUD OPERATIONS ====================

    def create_user(self, username, user_id, email=None):
        """
        CREATE: Add a new GitHub user to the database

        Args:
            username (str): GitHub username
            user_id (int): GitHub user ID
            email (str, optional): User email
        """
        with self.driver.session() as session:
            result = session.run(
                """
                MERGE (u:User {id: $user_id})
                SET u.username = $username,
                    u.email = $email,
                    u.updated_at = datetime()
                RETURN u
                """,
                user_id=user_id,
                username=username,
                email=email
            )
            user = result.single()
            print(f"Created/Updated user: {username} (ID: {user_id})")
            return user

    def create_repository(self, repo_name, repo_id, owner_id, language=None, description=None):
        """
        CREATE: Add a new repository to the database

        Args:
            repo_name (str): Repository name
            repo_id (int): Repository ID
            owner_id (int): Owner's user ID
            language (str, optional): Primary programming language
            description (str, optional): Repository description
        """
        with self.driver.session() as session:
            result = session.run(
                """
                MERGE (r:Repository {id: $repo_id})
                SET r.name = $repo_name,
                    r.language = $language,
                    r.description = $description,
                    r.updated_at = datetime()
                WITH r
                MATCH (u:User {id: $owner_id})
                MERGE (u)-[:OWNS]->(r)
                RETURN r
                """,
                repo_id=repo_id,
                repo_name=repo_name,
                owner_id=owner_id,
                language=language,
                description=description
            )
            repo = result.single()
            print(f"Created/Updated repository: {repo_name} (ID: {repo_id})")
            return repo

    def create_event(self, event_type, event_id, user_id, repo_id, created_at=None):
        """
        CREATE: Add a GitHub event (commit, pull request, issue, etc.)

        Args:
            event_type (str): Type of event (PushEvent, PullRequestEvent, etc.)
            event_id (str): Event ID
            user_id (int): User who performed the event
            repo_id (int): Repository where event occurred
            created_at (str, optional): Timestamp of event
        """
        with self.driver.session() as session:
            result = session.run(
                """
                MATCH (u:User {id: $user_id})
                MATCH (r:Repository {id: $repo_id})
                CREATE (e:Event {
                    id: $event_id,
                    type: $event_type,
                    created_at: $created_at
                })
                CREATE (u)-[:PERFORMED]->(e)
                CREATE (e)-[:ON_REPO]->(r)
                RETURN e
                """,
                event_id=event_id,
                event_type=event_type,
                user_id=user_id,
                repo_id=repo_id,
                created_at=created_at or datetime.now().isoformat()
            )
            event = result.single()
            print(f"Created event: {event_type} (ID: {event_id})")
            return event

    def create_contribution(self, user_id, repo_id, contribution_type="CONTRIBUTED_TO"):
        """
        CREATE: Create a contribution relationship between user and repository

        Args:
            user_id (int): User ID
            repo_id (int): Repository ID
            contribution_type (str): Type of contribution relationship
        """
        with self.driver.session() as session:
            session.run(
                f"""
                MATCH (u:User {{id: $user_id}})
                MATCH (r:Repository {{id: $repo_id}})
                MERGE (u)-[:{contribution_type}]->(r)
                """,
                user_id=user_id,
                repo_id=repo_id
            )
            print(f"Created contribution: User {user_id} -> Repository {repo_id}")

    def read_user(self, username=None, user_id=None):
        """
        READ: Retrieve user information from database

        Args:
            username (str, optional): GitHub username
            user_id (int, optional): GitHub user ID

        Returns:
            dict: User data
        """
        with self.driver.session() as session:
            if user_id:
                result = session.run(
                    "MATCH (u:User {id: $user_id}) RETURN u",
                    user_id=user_id
                )
            elif username:
                result = session.run(
                    "MATCH (u:User {username: $username}) RETURN u",
                    username=username
                )
            else:
                return None

            record = result.single()
            if record:
                return dict(record["u"])
            return None

    def read_repository(self, repo_name=None, repo_id=None):
        """
        READ: Retrieve repository information from database

        Args:
            repo_name (str, optional): Repository name
            repo_id (int, optional): Repository ID

        Returns:
            dict: Repository data
        """
        with self.driver.session() as session:
            if repo_id:
                result = session.run(
                    "MATCH (r:Repository {id: $repo_id}) RETURN r",
                    repo_id=repo_id
                )
            elif repo_name:
                result = session.run(
                    "MATCH (r:Repository {name: $repo_name}) RETURN r",
                    repo_name=repo_name
                )
            else:
                return None

            record = result.single()
            if record:
                return dict(record["r"])
            return None

    def read_all_users(self, limit=100):
        """
        READ: Get all users from database

        Args:
            limit (int): Maximum number of users to return

        Returns:
            list: List of user dictionaries
        """
        with self.driver.session() as session:
            result = session.run(
                "MATCH (u:User) RETURN u LIMIT $limit",
                limit=limit
            )
            return [dict(record["u"]) for record in result]

    def read_all_repositories(self, limit=100):
        """
        READ: Get all repositories from database

        Args:
            limit (int): Maximum number of repositories to return

        Returns:
            list: List of repository dictionaries
        """
        with self.driver.session() as session:
            result = session.run(
                "MATCH (r:Repository) RETURN r LIMIT $limit",
                limit=limit
            )
            return [dict(record["r"]) for record in result]

    def update_user(self, user_id, **kwargs):
        """
        UPDATE: Update user information

        Args:
            user_id (int): User ID to update
            **kwargs: Fields to update (username, email, etc.)
        """
        with self.driver.session() as session:
            set_clause = ", ".join([f"u.{key} = ${key}" for key in kwargs.keys()])
            query = f"""
                MATCH (u:User {{id: $user_id}})
                SET {set_clause}, u.updated_at = datetime()
                RETURN u
            """
            result = session.run(query, user_id=user_id, **kwargs)
            user = result.single()
            print(f"Updated user ID {user_id}")
            return user

    def update_repository(self, repo_id, **kwargs):
        """
        UPDATE: Update repository information

        Args:
            repo_id (int): Repository ID to update
            **kwargs: Fields to update (name, language, description, etc.)
        """
        with self.driver.session() as session:
            set_clause = ", ".join([f"r.{key} = ${key}" for key in kwargs.keys()])
            query = f"""
                MATCH (r:Repository {{id: $repo_id}})
                SET {set_clause}, r.updated_at = datetime()
                RETURN r
            """
            result = session.run(query, repo_id=repo_id, **kwargs)
            repo = result.single()
            print(f"Updated repository ID {repo_id}")
            return repo

    def delete_user(self, user_id):
        """
        DELETE: Remove a user and all their relationships

        Args:
            user_id (int): User ID to delete
        """
        with self.driver.session() as session:
            session.run(
                "MATCH (u:User {id: $user_id}) DETACH DELETE u",
                user_id=user_id
            )
            print(f"Deleted user ID {user_id}")

    def delete_repository(self, repo_id):
        """
        DELETE: Remove a repository and all its relationships

        Args:
            repo_id (int): Repository ID to delete
        """
        with self.driver.session() as session:
            session.run(
                "MATCH (r:Repository {id: $repo_id}) DETACH DELETE r",
                repo_id=repo_id
            )
            print(f"Deleted repository ID {repo_id}")

    def delete_event(self, event_id):
        """
        DELETE: Remove an event

        Args:
            event_id (str): Event ID to delete
        """
        with self.driver.session() as session:
            session.run(
                "MATCH (e:Event {id: $event_id}) DETACH DELETE e",
                event_id=event_id
            )
            print(f"Deleted event ID {event_id}")

    # ==================== ANALYTICAL FEATURES ====================

    def find_user_collaborators(self, user_id, min_shared_repos=1):
        """
        FEATURE 1: Discover collaboration patterns - Find users who contributed to the same repositories

        Args:
            user_id (int): User ID to analyze
            min_shared_repos (int): Minimum number of shared repositories

        Returns:
            list: List of collaborators with shared repository count
        """
        with self.driver.session() as session:
            result = session.run(
                """
                MATCH (u1:User {id: $user_id})-[:CONTRIBUTED_TO]->(r:Repository)<-[:CONTRIBUTED_TO]-(u2:User)
                WHERE u1 <> u2
                WITH u2, COUNT(DISTINCT r) AS shared_repos
                WHERE shared_repos >= $min_shared_repos
                RETURN u2.username AS collaborator,
                       u2.id AS user_id,
                       shared_repos
                ORDER BY shared_repos DESC
                """,
                user_id=user_id,
                min_shared_repos=min_shared_repos
            )
            return [dict(record) for record in result]

    def find_similar_repositories(self, repo_id, similarity_metric="contributors"):
        """
        FEATURE 2: Find similar repositories based on common contributors or language

        Args:
            repo_id (int): Repository ID to compare
            similarity_metric (str): "contributors" or "language"

        Returns:
            list: List of similar repositories
        """
        with self.driver.session() as session:
            if similarity_metric == "contributors":
                result = session.run(
                    """
                    MATCH (r1:Repository {id: $repo_id})<-[:CONTRIBUTED_TO]-(u:User)-[:CONTRIBUTED_TO]->(r2:Repository)
                    WHERE r1 <> r2
                    WITH r2, COUNT(DISTINCT u) AS shared_contributors
                    RETURN r2.name AS repository,
                           r2.id AS repo_id,
                           r2.language AS language,
                           shared_contributors
                    ORDER BY shared_contributors DESC
                    LIMIT 10
                    """,
                    repo_id=repo_id
                )
            else:  # language
                result = session.run(
                    """
                    MATCH (r1:Repository {id: $repo_id})
                    MATCH (r2:Repository)
                    WHERE r1 <> r2 AND r1.language = r2.language AND r1.language IS NOT NULL
                    RETURN r2.name AS repository,
                           r2.id AS repo_id,
                           r2.language AS language
                    LIMIT 10
                    """,
                    repo_id=repo_id
                )
            return [dict(record) for record in result]

    def get_language_statistics(self):
        """
        FEATURE 3: Get programming language usage statistics

        Returns:
            list: Language statistics with repository counts
        """
        with self.driver.session() as session:
            result = session.run(
                """
                MATCH (r:Repository)
                WHERE r.language IS NOT NULL
                WITH r.language AS language, COUNT(r) AS repo_count
                RETURN language, repo_count
                ORDER BY repo_count DESC
                """
            )
            return [dict(record) for record in result]

    def get_event_timeline(self, user_id=None, repo_id=None, event_type=None, limit=50):
        """
        FEATURE 4: Analyze GitHub events over time

        Args:
            user_id (int, optional): Filter by user
            repo_id (int, optional): Filter by repository
            event_type (str, optional): Filter by event type
            limit (int): Maximum number of events to return

        Returns:
            list: Timeline of events
        """
        with self.driver.session() as session:
            conditions = []
            params = {"limit": limit}

            if user_id:
                conditions.append("u.id = $user_id")
                params["user_id"] = user_id
            if repo_id:
                conditions.append("r.id = $repo_id")
                params["repo_id"] = repo_id
            if event_type:
                conditions.append("e.type = $event_type")
                params["event_type"] = event_type

            where_clause = "WHERE " + " AND ".join(conditions) if conditions else ""

            query = f"""
                MATCH (u:User)-[:PERFORMED]->(e:Event)-[:ON_REPO]->(r:Repository)
                {where_clause}
                RETURN e.type AS event_type,
                       e.created_at AS timestamp,
                       u.username AS user,
                       r.name AS repository
                ORDER BY e.created_at DESC
                LIMIT $limit
            """

            result = session.run(query, **params)
            return [dict(record) for record in result]

    # ==================== UTILITY FUNCTIONS ====================

    def clear_database(self):
        """Clear all nodes and relationships from the database (use with caution!)"""
        with self.driver.session() as session:
            session.run("MATCH (n) DETACH DELETE n")
            print("Database cleared!")

    def get_database_stats(self):
        """Get statistics about the current database"""
        with self.driver.session() as session:
            result = session.run(
                """
                OPTIONAL MATCH (u:User)
                WITH COUNT(u) AS user_count
                OPTIONAL MATCH (r:Repository)
                WITH user_count, COUNT(r) AS repo_count
                OPTIONAL MATCH (e:Event)
                WITH user_count, repo_count, COUNT(e) AS event_count
                OPTIONAL MATCH ()-[rel]->()
                RETURN user_count, repo_count, event_count, COUNT(rel) AS rel_count
                """
            )
            stats = result.single()
            if stats:
                return {
                    "users": stats["user_count"],
                    "repositories": stats["repo_count"],
                    "events": stats["event_count"],
                    "relationships": stats["rel_count"]
                }
            return {
                "users": 0,
                "repositories": 0,
                "events": 0,
                "relationships": 0
            }


def main():
    """Main function to demonstrate the application"""
    # Connection details for the Neo4j container
    URI = "neo4j://localhost:7687"
    USER = "neo4j"
    PASSWORD = "password1"

    # Initialize the application
    app = GitHubNeo4jApp(URI, USER, PASSWORD)

    try:
        # Display current database statistics
        print("\n" + "="*50)
        print("DATABASE STATISTICS")
        print("="*50)
        stats = app.get_database_stats()
        for key, value in stats.items():
            print(f"{key.capitalize()}: {value}")

        # Example usage of CRUD operations
        print("\n" + "="*50)
        print("TESTING CRUD OPERATIONS")
        print("="*50)

        # CREATE examples
        print("\n--- CREATE Operations ---")
        app.create_user("octocat", 1, "octocat@github.com")
        app.create_user("torvalds", 2, "torvalds@linux.org")
        app.create_repository("Hello-World", 101, 1, "JavaScript", "My first repository")
        app.create_repository("linux", 102, 2, "C", "Linux kernel")
        app.create_contribution(1, 101)
        app.create_contribution(2, 102)
        app.create_event("PushEvent", "evt_001", 1, 101)

        # READ examples
        print("\n--- READ Operations ---")
        user = app.read_user(username="octocat")
        print(f"Found user: {user}")

        # UPDATE examples
        print("\n--- UPDATE Operations ---")
        app.update_user(1, email="newemail@github.com")

        # Analytical features
        print("\n" + "="*50)
        print("ANALYTICAL FEATURES")
        print("="*50)

        print("\nLanguage Statistics:")
        lang_stats = app.get_language_statistics()
        for stat in lang_stats:
            print(f"  {stat['language']}: {stat['repo_count']} repositories")

        print("\n" + "="*50)
        print("Final Database Statistics:")
        stats = app.get_database_stats()
        for key, value in stats.items():
            print(f"{key.capitalize()}: {value}")

    finally:
        # Close the connection
        app.close()


if __name__ == "__main__":
    main()
