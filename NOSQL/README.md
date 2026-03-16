# NoSQL Database Portfolio

![MongoDB](https://img.shields.io/badge/MongoDB-47A248?style=for-the-badge&logo=mongodb&logoColor=white)
![Redis](https://img.shields.io/badge/Redis-DC382D?style=for-the-badge&logo=redis&logoColor=white)
![Neo4j](https://img.shields.io/badge/Neo4j-008CC1?style=for-the-badge&logo=neo4j&logoColor=white)
![Cassandra](https://img.shields.io/badge/Cassandra-1287B1?style=for-the-badge&logo=apache-cassandra&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)

A comprehensive exploration of four NoSQL database paradigms, each with production-ready Python applications integrating real-world GitHub data.

---

## Database Paradigms Covered

| Database | Type | Use Case | Project |
|----------|------|----------|---------|
| **MongoDB** | Document Store | Flexible schemas, JSON data | GitHub Activity Logger |
| **Redis** | Key-Value Store | Caching, session management | CRUD Operations Lab |
| **Cassandra** | Wide-Column Store | Time-series, high availability | GitHub Archive Analyzer |
| **Neo4j** | Graph Database | Relationship modeling | GitHub Analytics Platform |

---

## Featured Projects

### Neo4j: GitHub Analytics Platform
**Full-featured Streamlit web application for GitHub data visualization**

A sophisticated analytics platform that:
- Imports GitHub Archive data into Neo4j graph database
- Provides interactive CRUD operations
- Visualizes user collaboration patterns
- Analyzes repository similarity
- Tracks event timelines with Plotly charts

**Key Features:**
- Real-time database statistics dashboard
- Programming language distribution analysis
- User collaboration pattern discovery
- Repository similarity by contributors or language

**Technologies:** Neo4j, Python, Streamlit, Plotly, Pandas

**Location:** `neo4j/Lab/Part4/`

```python
# Sample: Finding user collaborators through graph traversal
def find_user_collaborators(user_id, min_repos):
    query = """
    MATCH (u:User {id: $user_id})-[:CONTRIBUTED_TO]->(r:Repository)
          <-[:CONTRIBUTED_TO]-(collaborator:User)
    WHERE collaborator.id <> $user_id
    WITH collaborator, COUNT(DISTINCT r) as shared_repos
    WHERE shared_repos >= $min_repos
    RETURN collaborator.username, shared_repos
    ORDER BY shared_repos DESC
    """
```

---

### Cassandra: GitHub Archive Analyzer
**Modular application for analyzing GitHub events with Cassandra**

A well-architected application with:
- Modular code structure (config, database, GUI, API)
- GitHub API integration for real-time data
- Wide-column schema for time-series data
- GUI interface for data exploration

**Module Structure:**
```
CassandraLab/
├── config.py              # Configuration settings
├── database.py            # Cassandra operations
├── cassandra_github_analyzer.py  # Entry point
├── gui.py                 # GUI components
├── main.py                # Application controller
├── SETUP.md              # Installation guide
└── MODULE_GUIDE.md       # Architecture docs
```

**Location:** `Cassandra/CassandraLab/`

---

### MongoDB: GitHub Activity Logger
**Document database application with visualization**

Features:
- CRUD operations for GitHub events
- Data visualization with charts
- Docker containerization
- Flexible document schemas

**Location:** `mongodb/lab/`

---

### Redis: CRUD Operations Lab
**Key-value store fundamentals**

Covers:
- Connection testing and management
- Basic CRUD operations
- Cache patterns
- Docker deployment

**Location:** `redis/week1-redis/`

---

## Architecture Comparison

| Feature | MongoDB | Redis | Cassandra | Neo4j |
|---------|---------|-------|-----------|-------|
| Data Model | Documents | Key-Value | Wide-Column | Graph |
| Query Language | MQL | Commands | CQL | Cypher |
| Best For | Flexible data | Caching | Time-series | Relationships |
| Scaling | Horizontal | Memory | Distributed | Vertical |

---

## Docker Integration

All projects include Docker support for easy deployment:

```yaml
# Example docker-compose.yml
version: '3'
services:
  mongodb:
    image: mongo:latest
    ports:
      - "27017:27017"

  redis:
    image: redis:latest
    ports:
      - "6379:6379"

  cassandra:
    image: cassandra:latest
    ports:
      - "9042:9042"

  neo4j:
    image: neo4j:latest
    ports:
      - "7474:7474"
      - "7687:7687"
```

---

## Running the Projects

### Prerequisites
- Python 3.9+
- Docker & Docker Compose
- pip packages: `pymongo`, `redis`, `cassandra-driver`, `neo4j`, `streamlit`

### Quick Start

**Neo4j Analytics Platform:**
```bash
cd neo4j/Lab/Part4
docker-compose up -d  # Start Neo4j
pip install -r requirements.txt
streamlit run streamlit_app.py
```

**Cassandra GitHub Analyzer:**
```bash
cd Cassandra/CassandraLab
docker-compose up -d  # Start Cassandra
python cassandra_github_analyzer.py
```

**MongoDB Lab:**
```bash
cd mongodb/lab
docker-compose up -d  # Start MongoDB
python main.py
```

**Redis CRUD:**
```bash
cd redis/week1-redis
docker-compose up -d  # Start Redis
python redis_crud_enhanced.py
```

---

## Skills Demonstrated

### Database Design
- Document schema design (MongoDB)
- Key-value data modeling (Redis)
- Wide-column schema design (Cassandra)
- Graph modeling and traversal (Neo4j)

### Application Development
- Python database drivers
- Docker containerization
- GUI development with Streamlit
- Data visualization with Plotly
- Modular code architecture

### Data Integration
- GitHub API integration
- GitHub Archive data processing
- Real-time data pipelines
- CRUD operation implementation

---

## Course Topics

| Week | Topic | Database |
|------|-------|----------|
| 1 | Key-Value Operations | Redis |
| 2 | Document Databases | MongoDB |
| 3 | Wide-Column Stores | Cassandra |
| 4 | Graph Databases | Neo4j |

---

## Author

**Amber Lawson**
NoSQL Databases Coursework
