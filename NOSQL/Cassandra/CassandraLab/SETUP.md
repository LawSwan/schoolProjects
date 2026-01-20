# Cassandra Lab Setup Guide

## Directory Structure

```
CassandraLab/
├── docker-compose.yml                      # Docker Compose configuration
├── cassandra_github_analyzer.py            # Main GUI application
├── secureCassandra.py                      # Initial secure connection demo
├── README.md                               # Full project documentation
├── SETUP.md                                # This file
└── GitHubArchive-Dataset/                  # Symbolic links to GitHub Archive data
    ├── Commits.json
    ├── Contents.json
    ├── Files.json
    ├── Languages.json
    ├── Licenses.json
    ├── Sample_Commits.json
    ├── Sample_Contents.json
    ├── Sample_Files.json
    └── Sample_Repos.json
```

## What's Been Configured

### ✅ Cassandra Container
- **Network:** Connected to `githubarchive-dataset_default` (same as Redis)
- **Data Mount:** GitHub Archive JSON files accessible at `/data/` inside container
- **Port:** 9042 exposed for connections
- **Volume:** Persistent Cassandra data at `cassandralab_cassandra_data`

### ✅ GitHub Archive Data
- All JSON files are **symbolically linked** (no duplication!)
- Data accessible from host and container
- Read-only mount in container (`:ro`) for safety

## Quick Start

### Start Cassandra
```bash
cd /Users/ecpi/schoolProjects/NOSQL/Cassandra/CassandraLab
docker-compose up -d
```

### Stop Cassandra
```bash
docker-compose down
```

### Run the GUI Application
```bash
python3 cassandra_github_analyzer.py
```

### Access GitHub Archive Data in Container
```bash
# List files
docker exec cassandra ls -la /data/

# Read a JSON file
docker exec cassandra cat /data/Sample_Repos.json | head -20
```

## Docker Compose Configuration

The `docker-compose.yml` configures:
- Cassandra on port 9042
- Mounts `./GitHubArchive-Dataset` to `/data` (read-only)
- Connects to existing `githubarchive-dataset_default` network
- Persistent volume for Cassandra data

## Network Setup

Cassandra is on the same network as your other containers (Redis, MongoDB), allowing them to communicate if needed.

To verify network:
```bash
docker network inspect githubarchive-dataset_default
```

## Available Data Files

- **Commits.json** (23 MB) - Git commit data
- **Contents.json** (339 MB) - File contents
- **Files.json** (4.9 MB) - File metadata
- **Languages.json** (436 MB) - Language statistics
- **Licenses.json** (1.4 MB) - License information
- **Sample_*.json** - Smaller sample datasets for testing

## Next Steps

1. ✅ Start Cassandra container
2. ✅ Run the GUI application
3. Load sample data via the GUI
4. Explore the three features:
   - Most Active Contributors
   - Repository Language Statistics
   - Trending Topics

## Troubleshooting

### Container won't start
```bash
docker-compose logs cassandra
```

### Data not accessible
```bash
docker exec cassandra ls -la /data/
```

### Network issues
```bash
docker network inspect githubarchive-dataset_default
```

### Reset everything
```bash
docker-compose down -v  # Removes volumes too
docker-compose up -d
```

---

**Created:** 2026-01-13
**Author:** Amber Lawson
