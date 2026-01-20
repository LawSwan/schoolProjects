# Week 1: Redis + GitHub Archive Integration

A Python application that demonstrates CRUD operations and data analysis using Redis as a NoSQL database with GitHub Archive dataset.

## 📋 Table of Contents
- [Features](#features)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)
- [Dataset Information](#dataset-information)
- [Analysis Features](#analysis-features)
- [Project Structure](#project-structure)

## ✨ Features

### Basic CRUD Operations
1. **Create** - Add new records to Redis
2. **Read** - Retrieve records by ID
3. **Update** - Modify existing records
4. **Delete** - Remove records from database
5. **List** - View all record IDs
6. **Import** - Bulk import from JSON files

### Advanced Analysis Features
7. **Search by Repository** - Find all records for a specific repository
8. **Top Repositories** - Rank repositories by watch count (popularity)
9. **Most Active Developers** - Identify developers with most commits

## 🔧 Prerequisites

- Python 3.7+
- Docker and Docker Compose
- Redis Python client library

## 📦 Installation

### 1. Install Python Dependencies

```bash
pip install redis
```

Or create a requirements file:
```bash
# requirements.txt
redis==5.0.0
```

Then install:
```bash
pip install -r requirements.txt
```

### 2. Start Redis with Docker

```bash
cd week1-redis/GitHubArchive-Dataset
docker-compose up -d
```

Verify Redis is running:
```bash
docker ps
```

You should see `nosql-redis` container running on port 6379.

## 🚀 Usage

### Start the Application

```bash
python3 redis_crud_enhanced.py
```

### Quick Start Guide

1. **Import Sample Data**
   - Choose option `1` from menu
   - Enter filename: `Sample_Repos.json`
   - Limit: `100` (for testing)
   - Wait for import to complete

2. **View Your Data**
   - Choose option `7` to see first 10 records
   - Choose option `8` to count total records

3. **Try Analysis Features**
   - Option `9`: Search for "FreeCodeCamp" or "swift"
   - Option `10`: See most popular repositories
   - Option `11`: Find most active developers (use Commits data)

### Example Workflow

```bash
# 1. Start the application
python3 redis_crud_enhanced.py

# 2. Import data
Choose: 1
Path to file: Sample_Repos.json
Limit: 100

# 3. Search for repositories
Choose: 9
Enter repository name: FreeCodeCamp

# 4. See top repositories
Choose: 10
```

## 📊 Dataset Information

### Available Datasets

| File | Size | Description | Best For |
|------|------|-------------|----------|
| `Sample_Repos.json` | 22MB | Repository names and watch counts | Testing, popularity analysis |
| `Sample_Commits.json` | 78MB | Commit information with authors | Developer activity analysis |
| `Languages.json` | 416MB | Programming languages per repo | Language distribution analysis |
| `Files.json` | 4.7MB | File paths and metadata | File type analysis |

### Data Structure Examples

**Repositories:**
```json
{
  "repo_name": "FreeCodeCamp/FreeCodeCamp",
  "watch_count": "90457"
}
```

**Commits:**
```json
{
  "author": {
    "name": "Developer Name",
    "email": "dev@example.com"
  },
  "commit": "abc123...",
  "repo_name": "apple/swift",
  "message": "Commit message",
  "subject": "Short description"
}
```

**Languages:**
```json
{
  "repo_name": "user/repo",
  "language": [
    {"name": "Python", "bytes": "15000"},
    {"name": "JavaScript", "bytes": "8000"}
  ]
}
```

## 🔍 Analysis Features Explained

### Feature 1: Search by Repository Name
**Purpose**: Find all records related to a specific repository

**Use Case**:
- Investigate a particular project
- Find all commits for a repository
- Track repository activity over time

**Example**:
```python
# Find all records containing "react"
results = app.search_by_repo("react", limit=10)
```

**What You'll See**:
- All records where repo_name contains your search term
- Works with partial matches (case-insensitive)
- Useful for tracking specific projects

### Feature 2: Top Repositories by Watch Count
**Purpose**: Identify most popular/watched repositories

**Use Case**:
- Understand which projects are most popular
- Analyze trends in open-source community
- Identify influential projects

**Redis Advantage**:
- Fast in-memory sorting
- Efficient data aggregation
- O(n log n) performance for sorting

**Example Output**:
```
1. FreeCodeCamp/FreeCodeCamp - 90,457 watches
2. facebook/react - 85,000 watches
3. vuejs/vue - 75,000 watches
```

### Feature 3: Most Active Developers
**Purpose**: Find developers with most commits

**Use Case**:
- Identify key contributors
- Understand development patterns
- Track developer activity across repositories

**What You'll See**:
- Developer name and email
- Total commit count
- Number of different repos they contributed to

**Example Output**:
```
1. John Doe - 1,234 commits across 45 repos
2. Jane Smith - 987 commits across 32 repos
```

## 📁 Project Structure

```
week1-redis/
├── redis_crud_enhanced.py      # Enhanced CRUD application
├── README.md                    # This file
├── DATASET_GUIDE.md            # Dataset documentation
├── requirements.txt            # Python dependencies
└── GitHubArchive-Dataset/
    ├── docker-compose.yml      # Redis configuration
    ├── Sample_Repos.json       # Repository data
    ├── Sample_Commits.json     # Commit data
    ├── Languages.json          # Language data
    └── Files.json              # File data
```

## 🎯 Redis Concepts Demonstrated

### 1. Key-Value Storage
- Each record stored with unique UUID
- Fast O(1) lookup by key

### 2. Sets
- Track all record IDs in a set
- Efficient membership testing
- Set operations (union, intersection, difference)

### 3. In-Memory Performance
- Lightning-fast data access
- Suitable for caching and real-time analytics
- Persistent storage with AOF (Append-Only File)

## 🐛 Troubleshooting

### Redis Connection Error
```bash
# Make sure Redis is running
docker ps

# If not running, start it
cd GitHubArchive-Dataset
docker-compose up -d
```

### File Not Found Error
```bash
# Make sure you're in the correct directory
cd week1-redis

# Or provide full path to JSON file
python3 redis_crud_enhanced.py
# Then enter: GitHubArchive-Dataset/Sample_Repos.json
```

### Import Taking Too Long
- Use the `limit` parameter when importing
- Start with 100-1000 records for testing
- Languages.json is very large (416MB), use small limit

## 📝 Testing Recommendations

1. **Start Small**: Import 100 records from Sample_Repos.json
2. **Test CRUD**: Create, read, update, delete a single record
3. **Test Search**: Search for "FreeCodeCamp" or "swift"
4. **Test Analytics**:
   - Top repos (use Sample_Repos.json)
   - Most active developers (use Sample_Commits.json)

## 🎓 Learning Objectives

By completing this project, you will:
- ✅ Understand Redis key-value storage
- ✅ Implement CRUD operations in Python
- ✅ Work with JSON data at scale
- ✅ Perform data analysis with NoSQL databases
- ✅ Use Docker for database deployment
- ✅ Apply Redis for real-world use cases

## 📚 Additional Resources

- [Redis Documentation](https://redis.io/documentation)
- [Redis Python Client](https://redis-py.readthedocs.io/)
- [GitHub Archive](https://www.gharchive.org/)
- [Docker Compose Guide](https://docs.docker.com/compose/)

## 🤝 Contributing

This is a group project. When making changes:
1. Commit regularly with clear messages
2. Update README.md with new features
3. Document any new dependencies
4. Test before pushing to main branch

## 📄 License

Educational project for NoSQL Database course.

---

**Need Help?** Check DATASET_GUIDE.md for dataset details or reach out to your team members!
