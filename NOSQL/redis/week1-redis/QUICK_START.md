# Quick Start Guide - Week 1 Redis Project

## 🚀 Get Started in 5 Minutes

### Step 1: Start Redis (30 seconds)
```bash
cd /Users/ecpi/schoolProjects/NOSQL/redis/week1-redis/GitHubArchive-Dataset
docker-compose up -d
```

### Step 2: Install Python Dependencies (30 seconds)
```bash
cd /Users/ecpi/schoolProjects/NOSQL/redis/week1-redis
pip install -r requirements.txt
```

### Step 3: Run the Application (10 seconds)
```bash
python3 redis_crud_enhanced.py
```

### Step 4: Import Sample Data (2 minutes)
```
Choose: 1
Path to file: GitHubArchive-Dataset/Sample_Repos.json
Limit: 100
```

Wait for import to complete...

### Step 5: Try the Analysis Features!

#### See What Data You Have
```
Choose: 7    (View first 10 records)
Choose: 8    (Count total records)
```

#### Search for Repositories
```
Choose: 9
Enter repository name: FreeCodeCamp
```

You'll see all records containing "FreeCodeCamp"!

#### See Most Popular Repositories
```
Choose: 10
```

This shows the top 10 repositories by watch count (popularity).

#### Find Most Active Developers
First, import commit data:
```
Choose: 1
Path to file: GitHubArchive-Dataset/Sample_Commits.json
Limit: 500
```

Then analyze:
```
Choose: 11
```

This shows developers with the most commits!

## 📊 What to Expect

### With Sample_Repos.json (100 records):
- You'll see repository names and watch counts
- Perfect for testing Features 9 and 10
- Example repos: FreeCodeCamp, facebook/react, etc.

### With Sample_Commits.json (500 records):
- You'll see commit information with authors
- Perfect for testing Feature 11 (Most Active Developers)
- Shows developer activity patterns

## 🎯 Common Queries to Try

1. **Popular Projects**:
   - Search: "react"
   - Search: "swift"
   - Search: "FreeCodeCamp"

2. **Top Repositories**:
   - Use option 10 after importing Sample_Repos.json
   - See which projects have most watchers

3. **Active Developers**:
   - Use option 11 after importing Sample_Commits.json
   - See who's committing the most

## ❓ What Am I Looking At?

### Repository Record Example:
```json
{
  "_id": "uuid-here",
  "repo_name": "FreeCodeCamp/FreeCodeCamp",
  "watch_count": "90457"
}
```
- `repo_name`: The GitHub repository (owner/project)
- `watch_count`: How many people are watching/starring it
- `_id`: Unique identifier in Redis

### Commit Record Example:
```json
{
  "_id": "uuid-here",
  "author": {
    "name": "John Doe",
    "email": "john@example.com"
  },
  "commit": "abc123...",
  "repo_name": "apple/swift",
  "message": "Fix bug in compiler",
  "subject": "Fix bug in compiler"
}
```
- `author`: Who made the commit
- `repo_name`: Which project
- `message`: What they changed
- `commit`: Git commit hash

## 🎓 Understanding the Analysis Features

### Feature 1: Search by Repository Name
**What it does**: Finds all records for a specific repository

**Example**: If you search "react", you might find:
- facebook/react
- reactjs/react-router
- vuejs/vue (if searching broadly)

**Why it's useful**: Track specific projects across the dataset

### Feature 2: Top Repositories by Watch Count
**What it does**: Ranks repositories by popularity (watch count)

**Example Output**:
```
1. FreeCodeCamp/FreeCodeCamp - 90,457 watches
2. facebook/react - 85,234 watches
3. vuejs/vue - 78,901 watches
```

**Why it's useful**: Shows most popular open-source projects

### Feature 3: Most Active Developers
**What it does**: Counts commits per developer

**Example Output**:
```
1. Devin Coughlin - 234 commits across 12 repos
2. Jane Developer - 189 commits across 8 repos
3. John Coder - 156 commits across 15 repos
```

**Why it's useful**: Identifies key contributors and activity patterns

## 💡 Pro Tips

1. **Start with 100 records** when testing
2. **Use Sample_Repos.json** for repository analysis
3. **Use Sample_Commits.json** for developer analysis
4. **Search is case-insensitive** - "react" finds "React", "REACT", etc.
5. **Records persist** in Redis until you delete them or restart the container

## 🔧 If Something Goes Wrong

### "Could not connect to Redis"
```bash
# Check if Redis is running
docker ps

# Restart Redis
cd GitHubArchive-Dataset
docker-compose down
docker-compose up -d
```

### "File not found"
```bash
# Make sure you're in the right directory
pwd
# Should show: .../week1-redis

# Use relative path
GitHubArchive-Dataset/Sample_Repos.json

# Or full path
/Users/ecpi/schoolProjects/NOSQL/redis/week1-redis/GitHubArchive-Dataset/Sample_Repos.json
```

### "Taking too long to import"
- Use a smaller limit (50-100 records)
- Languages.json is very large, avoid for testing

## 🎉 You're Ready!

Now you understand:
- ✅ What data you're working with (GitHub repositories and commits)
- ✅ How to query the data (search, filter, analyze)
- ✅ What the features do (search, rank, aggregate)
- ✅ What to expect in the output

Go explore the data and have fun! 🚀
