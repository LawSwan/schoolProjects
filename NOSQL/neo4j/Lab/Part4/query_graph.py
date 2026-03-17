"""
Query and visualize graph data from Neo4j
"""

from github_neo4j_app import GitHubNeo4jApp
import json


def run_graph_queries():
    """Run various queries to explore the graph data"""

    # Connection details
    URI = "neo4j://localhost:7687"
    USER = "neo4j"
    PASSWORD = "password1"

    app = GitHubNeo4jApp(URI, USER, PASSWORD)

    try:
        print("="*70)
        print("NEO4J GRAPH DATA EXPLORATION")
        print("="*70)

        # Query 1: Get all node types and counts
        print("\n1. NODE TYPES IN GRAPH:")
        print("-" * 70)
        with app.driver.session() as session:
            result = session.run("""
                MATCH (n)
                RETURN labels(n) as labels, COUNT(n) as count
                ORDER BY count DESC
            """)
            for record in result:
                labels = record['labels']
                count = record['count']
                print(f"  {labels[0] if labels else 'No Label'}: {count} nodes")

        # Query 2: Get all relationship types and counts
        print("\n2. RELATIONSHIP TYPES IN GRAPH:")
        print("-" * 70)
        with app.driver.session() as session:
            result = session.run("""
                MATCH ()-[r]->()
                RETURN type(r) as relationship_type, COUNT(r) as count
                ORDER BY count DESC
            """)
            for record in result:
                rel_type = record['relationship_type']
                count = record['count']
                print(f"  {rel_type}: {count} relationships")

        # Query 3: Sample graph structure
        print("\n3. SAMPLE GRAPH STRUCTURE (First 10 relationships):")
        print("-" * 70)
        with app.driver.session() as session:
            result = session.run("""
                MATCH (n)-[r]->(m)
                RETURN
                    labels(n)[0] as from_type,
                    n.username as from_name,
                    type(r) as relationship,
                    labels(m)[0] as to_type,
                    m.name as to_name
                LIMIT 10
            """)
            for record in result:
                from_type = record['from_type']
                from_name = record['from_name'] or 'N/A'
                relationship = record['relationship']
                to_type = record['to_type']
                to_name = record['to_name'] or 'N/A'
                print(f"  ({from_type}: {from_name}) -[{relationship}]-> ({to_type}: {to_name})")

        # Query 4: Most active users (most events)
        print("\n4. MOST ACTIVE USERS (by events):")
        print("-" * 70)
        with app.driver.session() as session:
            result = session.run("""
                MATCH (u:User)-[:PERFORMED]->(e:Event)
                WITH u, COUNT(e) as event_count
                ORDER BY event_count DESC
                LIMIT 5
                RETURN u.username as username, u.id as user_id, event_count
            """)
            for record in result:
                username = record['username']
                user_id = record['user_id']
                count = record['event_count']
                print(f"  {username} (ID: {user_id}): {count} events")

        # Query 5: Most popular repositories (most contributors)
        print("\n5. MOST POPULAR REPOSITORIES (by contributors):")
        print("-" * 70)
        with app.driver.session() as session:
            result = session.run("""
                MATCH (u:User)-[:CONTRIBUTED_TO]->(r:Repository)
                WITH r, COUNT(DISTINCT u) as contributor_count
                ORDER BY contributor_count DESC
                LIMIT 5
                RETURN r.name as repo_name, r.id as repo_id, contributor_count
            """)
            for record in result:
                repo_name = record['repo_name']
                repo_id = record['repo_id']
                count = record['contributor_count']
                print(f"  {repo_name} (ID: {repo_id}): {count} contributors")

        # Query 6: Event type distribution
        print("\n6. EVENT TYPE DISTRIBUTION:")
        print("-" * 70)
        with app.driver.session() as session:
            result = session.run("""
                MATCH (e:Event)
                RETURN e.type as event_type, COUNT(e) as count
                ORDER BY count DESC
            """)
            for record in result:
                event_type = record['event_type']
                count = record['count']
                print(f"  {event_type}: {count}")

        # Query 7: Find collaboration networks
        print("\n7. COLLABORATION NETWORKS (Users working on same repos):")
        print("-" * 70)
        with app.driver.session() as session:
            result = session.run("""
                MATCH (u1:User)-[:CONTRIBUTED_TO]->(r:Repository)<-[:CONTRIBUTED_TO]-(u2:User)
                WHERE u1.id < u2.id
                WITH u1, u2, COUNT(DISTINCT r) as shared_repos
                WHERE shared_repos > 1
                ORDER BY shared_repos DESC
                LIMIT 5
                RETURN u1.username as user1, u2.username as user2, shared_repos
            """)
            collaborations = list(result)
            if collaborations:
                for record in collaborations:
                    user1 = record['user1']
                    user2 = record['user2']
                    shared = record['shared_repos']
                    print(f"  {user1} <--> {user2}: {shared} shared repositories")
            else:
                print("  No collaboration networks found (need more data)")

        # Query 8: Repository language distribution
        print("\n8. PROGRAMMING LANGUAGES:")
        print("-" * 70)
        with app.driver.session() as session:
            result = session.run("""
                MATCH (r:Repository)
                WHERE r.language IS NOT NULL
                RETURN r.language as language, COUNT(r) as count
                ORDER BY count DESC
            """)
            languages = list(result)
            if languages:
                for record in languages:
                    language = record['language']
                    count = record['count']
                    print(f"  {language}: {count} repositories")
            else:
                print("  No language data available")

        # Query 9: Full graph visualization query
        print("\n9. FULL GRAPH VISUALIZATION QUERY:")
        print("-" * 70)
        print("""
  To visualize the full graph in Neo4j Browser, visit:
  http://localhost:7474

  And run this query:

  MATCH (n)-[r]->(m)
  RETURN n, r, m
  LIMIT 100

  Or for a specific user's network:

  MATCH path = (u:User {username: 'github-actions[bot]'})-[*1..2]-(related)
  RETURN path
  LIMIT 50
        """)

        print("\n" + "="*70)
        print("EXPLORATION COMPLETE")
        print("="*70)

    finally:
        app.close()


if __name__ == "__main__":
    run_graph_queries()
