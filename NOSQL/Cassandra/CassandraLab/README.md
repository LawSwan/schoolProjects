# Cassandra GitHub Archive Analyzer

**Author:** Amber Lawson
**Date:** 2026-01-13
**Project:** 3.3 Group Project - Cassandra Integration

## Overview

A Python GUI application that integrates with Apache Cassandra to analyze **live GitHub data via API**. This project utilizes the GitHub Archive API (instead of large zip files) to keep the application lightweight and efficient. Designed to be user-friendly for students and academics, the application provides quick insights into:

- **Trending Topics** - What's hot in the developer community
- **Top Programming Languages** - Language distribution across popular repositories
- **Most Active Contributors** - Top developers by commit count

The application fetches real-time repository statistics, contributor information, and trending topics directly from GitHub's REST API, demonstrating full CRUD operations, data analysis, and visualization with Cassandra as the backend database.

## Features

### 1. 👥 Most Active Contributors
- Tracks contributors by commit count
- Displays contributor statistics and repository associations
- Shows last activity timestamps
- Sorted by commit frequency

### 2. 💻 Repository Language Statistics
- Analyzes programming language distribution across repositories
- Calculates popularity metrics (star counts, percentages)
- Visualizes language distribution with text-based bars
- Identifies top repositories for each language

### 3. 🔥 Trending Topics
- Tracks trending topics and tags across repositories
- Aggregates total stars per topic
- Shows repository count for each topic
- Displays last update timestamps

## Technology Stack

- **Database:** Apache Cassandra (NoSQL)
- **Language:** Python 3.x
- **GUI Framework:** Tkinter (built-in)
- **Cassandra Driver:** cassandra-driver
- **Authentication:** SASL (PlainTextAuthProvider)

## Dependencies

```bash
pip install cassandra-driver requests
```

**Required Libraries:**
- **cassandra-driver** - Cassandra Python driver
- **requests** - HTTP library for API calls

**Built-in Libraries:**
- tkinter
- json
- uuid
- datetime
- collections
- time

## Database Schema

### Keyspace: `github_archive`

#### 1. Contributors Table
```cql
CREATE TABLE contributors (
    username text PRIMARY KEY,
    commit_count int,
    repositories set<text>,
    last_active timestamp
)
```

#### 2. Repositories Table
```cql
CREATE TABLE repositories (
    repo_id uuid PRIMARY KEY,
    repo_name text,
    language text,
    stars int,
    description text,
    created_date timestamp
)
```

#### 3. Topics Table
```cql
CREATE TABLE topics (
    topic text PRIMARY KEY,
    repo_count int,
    total_stars int,
    last_updated timestamp
)
```

## Installation & Setup

### Prerequisites

1. **Docker Desktop** - Required for running Cassandra container
   - Download from [docker.com](https://www.docker.com/products/docker-desktop)
   - Ensure Docker Desktop is running before proceeding

2. **Python 3.x** - For running the application

3. **Python Dependencies:**
   ```bash
   pip install cassandra-driver requests
   # Or use the requirements.txt file:
   pip install -r requirements.txt
   ```

### Quick Start with Docker Compose

This project includes a `docker-compose.yml` file for easy setup:

```bash
# Start Cassandra container
docker-compose up -d

# Cassandra will be available on port 9042
# You can customize the port in docker-compose.yml if needed
```

**Note:** The docker-compose file handles:
- Cassandra container setup
- Network configuration
- Volume persistence
- Port mapping (customizable to suit your environment)

### Configuration

Update the authentication credentials in `cassandra_github_analyzer.py`:

```python
auth = PlainTextAuthProvider(username="your_username", password="your_password")
```

Default credentials:
- Username: `amblaw9047`
- Password: `cassPass`
- Host: `localhost`
- Port: `9042`

## Running the Application

1. **Start Cassandra:**
   ```bash
   # If using Docker
   docker start cassandra

   # Wait for Cassandra to be ready (about 30 seconds)
   docker logs cassandra
   ```

2. **Run the application:**
   ```bash
   python3 cassandra_github_analyzer.py
   ```

3. **Fetch live GitHub data:**
   - Navigate to the "📥 Import Data" tab
   - Click "🌐 Fetch Live GitHub Data" button
   - Application will fetch real-time data from GitHub API
   - Wait for success confirmation (may take 20-30 seconds)
   - Note: Uses GitHub REST API (60 requests/hour limit without token)

4. **Explore features:**
   - **Contributors tab:** View most active contributors from real repos
   - **Languages tab:** Analyze language statistics from trending repos
   - **Trending tab:** See trending topics from GitHub

## CRUD Operations Demonstrated

### CREATE
- **Loading sample data:** Inserts new repositories, contributors, and topics
- **File location:** `load_sample_data()` method (lines 266-326)

### READ
- **Display Contributors:** Queries and displays all contributors sorted by commits
- **Display Languages:** Aggregates language statistics from repositories
- **Display Topics:** Retrieves and sorts topics by popularity
- **File locations:** `display_contributors()`, `display_languages()`, `display_topics()` methods

### UPDATE
- **Topic updates:** Increments repo_count and total_stars when loading data
- **File location:** `load_sample_data()` method (lines 299-307)

### DELETE
- **Clear All Data:** Truncates all tables
- **File location:** `clear_all_data()` method (lines 410-420)

## Data Source

The application fetches **live data from GitHub's REST API**, including:

### What Gets Fetched:
- **Repositories:** Top 20 trending repos by language (Python, JavaScript, TypeScript, Go, Rust, Java)
- **Contributors:** Real contributors from each repository (up to 5 per repo)
- **Topics:** Actual GitHub topics/tags from repositories
- **Statistics:** Real-time star counts, commit counts, language data

### API Details:
- **Endpoint:** `https://api.github.com/search/repositories`
- **Rate Limit:** 60 requests/hour (unauthenticated)
- **Fallback:** If API limit is reached, loads sample data automatically

### Fallback Sample Data:
If the API is unavailable, the app loads cached data including python/cpython, facebook/react, torvalds/linux, and other popular repositories.

## Usage Instructions

### Importing Data

1. Click on the "📥 Import Data" tab
2. Click "🌐 Fetch Live GitHub Data" to fetch real-time data from GitHub API
3. Wait 20-30 seconds while the app queries GitHub and loads data
4. Use "Clear All Data" to reset the database and fetch fresh data

### Viewing Statistics

1. Navigate to the desired tab:
   - **Contributors:** Shows developer activity
   - **Languages:** Displays language distribution
   - **Trending:** Highlights popular topics

2. Click the "🔄 Refresh Data" button to reload statistics
3. Review the formatted output with metrics and visualizations

### Interpreting Results

- **Contributors:** Ranked by commit count (higher = more active)
- **Languages:** Shows percentage distribution and star counts
- **Topics:** Sorted by total stars across all tagged repositories

## Project Structure

```
LAB/
├── cassandra_github_analyzer.py  # Main application
├── secureCassandra.py            # Initial Cassandra connection demo
└── README.md                     # This file
```

## Troubleshooting

### Connection Issues
- Ensure Cassandra is running: `docker ps`
- Check Cassandra logs: `docker logs cassandra`
- Verify port 9042 is not blocked
- Confirm authentication credentials

### Import Errors
- Install cassandra-driver: `pip install cassandra-driver`
- Ensure Python 3.x is installed
- Check tkinter is available (usually built-in)

### Data Not Displaying
- Click "Load Sample Data" first
- Use "🔄 Refresh Data" button to reload
- Check Cassandra connection in terminal output

## Future Enhancements

Potential features for next iteration:
- Real GitHub API integration
- Data visualization with charts (matplotlib)
- Export data to CSV/JSON
- Advanced filtering and search
- Time-series analysis of commits
- Repository comparison tools

## Technical Notes

### Authentication
Uses SASL PlainTextAuthProvider for secure Cassandra authentication. In production, consider using SSL/TLS encryption.

### Data Model
- **Partition Keys:** username, repo_id, topic
- **Collections:** Using `set<text>` for repository lists
- **Counter Pattern:** Topics use aggregated counts

### GUI Design
- Tabbed interface for feature separation
- ScrolledText widgets for large data display
- Status bar for operation feedback
- Color-coded buttons for actions

## License

Educational project for ECPI University coursework.

## Contact

Amber Lawson - ECPI University NOSQL Course

---

**Last Updated:** 2026-01-13
