# GitHub Archive Dataset Guide

## Overview
This dataset contains information about GitHub repositories, commits, files, and programming languages. This is a useful tool for research...

## Dataset Files

### 1. **Sample_Repos.json** (22MB)
Repository information with watch counts
```json
{
  "repo_name": "FreeCodeCamp/FreeCodeCamp",
  "watch_count": "90457"
}
```

### 2. **Sample_Commits.json** (78MB)
Git commit information
```json
{
  "author": {
    "email": "user@example.com",
    "name": "Developer Name"
  },
  "commit": "00001793511cc31df0d5050d6c6092d82dc60a68",
  "message": "Commit message here",
  "repo_name": "apple/swift",
  "subject": "Short commit description"
}
```

### 3. **Languages.json** (416MB)
Programming languages used in each repository
```json
{
  "repo_name": "lemi136/puntovent",
  "language": [
    {
      "name": "C",
      "bytes": "80"
    }
  ]
}
```

### 4. **Files.json** (4.7MB)
File information from repositories
```json
{
  "repo_name": "enzbang/diouzhtu",
  "ref": "refs/heads/master",
  "path": "scripts/do-install.sh",
  "mode": "33261",
  "id": "49365044eed28769152726537f00a93a68988b07"
}
```

## Recommended Starting Point
Use **Sample_Repos.json** or **Sample_Commits.json** - they're smaller and easier to work with for initial testing.

## Common Analysis Questions

1. **Most Popular Repositories**: Which repos have the highest watch counts?
2. **Most Active Developers**: Which developers have the most commits?
3. **Language Distribution**: What are the most common programming languages?
4. **Repository Activity**: How many commits per repository?
5. **File Types**: What file extensions are most common?

## Redis Storage Strategy

Records are stored as:
- **Key**: `gharchive:record:<uuid>`
- **Value**: JSON string of the record
- **Index**: Set `gharchive:ids` contains all UUIDs

This allows O(1) lookup by ID and efficient set operations.
