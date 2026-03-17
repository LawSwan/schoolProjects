# GitHub Archive MongoDB CRUD Application

A modular Streamlit web application for performing CRUD operations on GitHub Archive data using MongoDB.

## Overview

This project provides an interactive GUI for loading GitHub repository data into MongoDB and performing complete CRUD operations with beautiful data visualizations.

## 🚀 Quick Start (For Instructors)

**Prerequisites:**
- Docker running with MongoDB container
- Python dependencies installed

**To Run:**
1. Open `main.py` in VS Code
2. Click the **▶️ Run** button
3. Browser opens automatically at http://localhost:8501
4. Done! 🎉

**Stop the app:** Press `Ctrl+C` in the terminal

## Features

✅ **Modular Architecture** - Clean separation of concerns
✅ **Import Data** - Load GitHub Archive JSON datasets into MongoDB
✅ **View Data** - Browse, search, and filter repositories
✅ **Create** - Add new repository records
✅ **Update** - Modify existing repository data
✅ **Delete** - Remove repository records
✅ **Analytics** - Interactive charts and statistics with Plotly

## Technology Stack

- **Python 3.8+**
- **MongoDB 7.0** - NoSQL database
- **Streamlit** - Web GUI framework
- **Pandas** - Data manipulation
- **Plotly** - Interactive visualizations
- **Docker & Docker Compose** - Containerization

## Project Structure

```
lab/
├── main.py                     # ⭐ RUN THIS FILE! (Entry point)
├── github_mongodb_app.py       # Main Streamlit application
├── database.py                 # MongoDB connection and import functions
├── crud_operations.py          # CRUD operation functions
├── visualizations.py           # Chart and analytics functions
├── requirements.txt            # Python dependencies
├── docker-compose.yaml         # Docker services configuration
├── .gitignore                 # Git ignore rules
├── README.md                  # This file
└── GitHubArchive-Dataset/     # Dataset folder
    ├── Sample_Repos.json      (22MB)
    ├── Sample_Commits.json    (78MB)
    └── Sample_Files.json      (4.5MB)
```

## Dependencies

```bash
pip install -r requirements.txt
```

**Required packages:**
- `pymongo==4.6.1` - MongoDB driver
- `streamlit==1.29.0` - Web GUI framework
- `pandas==2.1.4` - Data analysis
- `plotly==5.18.0` - Interactive charts

## Installation

### 1. Start MongoDB with Docker Compose

```bash
cd /Users/ecpi/schoolProjects/NOSQL/mongodb/lab

# Start all services (MongoDB + Mongo Express)
docker-compose up -d

# Check if containers are running
docker-compose ps
```

**What this starts:**
- **MongoDB** - Port 27017
- **Mongo Express** - Port 8081 (Web UI for MongoDB)

### 2. Install Python Dependencies

```bash
pip install -r requirements.txt
```

## Usage

### Start the Application

**Method 1: Run main.py (Easiest for VS Code)**

Simply open `main.py` and click the **▶️ Run** button in VS Code!

Or run from terminal:
```bash
python main.py
```

The browser will automatically open at `http://localhost:8501`

**Method 2: Run Streamlit Directly**

```bash
streamlit run github_mongodb_app.py
```

The app will open in your browser at `http://localhost:8501`

### Workflow

1. **Import Data**
   - Navigate to "Import Data" page
   - Select dataset (recommend "Sample Repositories")
   - Click "Load Data into MongoDB"
   - Wait for import to complete

2. **View Data**
   - Browse all repositories
   - Search by name
   - Sort by different fields
   - Download as CSV

3. **CRUD Operations**
   - **Create**: Add new repositories
   - **Update**: Modify existing records
   - **Delete**: Remove records

4. **Analytics**
   - View statistics (total, avg, min, max)
   - Top 10 repositories bar chart
   - Watch count distribution histogram
   - Pie chart of top repos
   - Range distribution analysis

## MongoDB Access

### Via Streamlit App
- Default: `http://localhost:8501`

### Via Mongo Express (Web UI)
- URL: `http://localhost:8081`
- Username: `admin`
- Password: `password`

### Via Command Line
```bash
# Connect to MongoDB container
docker exec -it mongodb_github_archive mongosh

# Use database
use github_archive

# View collections
show collections

# Query data
db.repositories.find().limit(5)
```

## Database Schema

**Database:** `github_archive`
**Collection:** `repositories`

```json
{
  "_id": 1,
  "repo_name": "facebook/react",
  "watch_count": 10458,
  "created_at": "2024-01-16T12:00:00"
}
```

## Module Breakdown

### `main.py` (Entry Point)
- Simple launcher for the application
- Auto-opens browser
- Easy to run from VS Code with ▶️ button
- Handles graceful shutdown

### `github_mongodb_app.py` (Main Application)
- Page routing and navigation
- UI rendering for each page
- Streamlit configuration
- Core application logic

### `database.py` (Database Layer)
- MongoDB connection management
- JSON data loading
- Data import functionality
- Database statistics aggregation

### `crud_operations.py` (Data Operations)
- **Create**: Insert new repositories
- **Read**: Query and search repositories
- **Update**: Modify repository data
- **Delete**: Remove repositories
- Helper functions for bulk operations

### `visualizations.py` (Analytics & Charts)
- Top repositories bar chart
- Watch count histogram
- Pie chart visualization
- Range distribution chart
- Statistics summary display

## Docker Services

### MongoDB Container
- **Image**: `mongo:latest`
- **Port**: `27017`
- **Volumes**: Persistent data storage
- **Network**: `mongodb_network`

### Mongo Express Container
- **Image**: `mongo-express:latest`
- **Port**: `8081`
- **Purpose**: Web-based MongoDB admin interface

## Available Datasets

Located in `GitHubArchive-Dataset/`:

| File | Size | Description |
|------|------|-------------|
| `Sample_Repos.json` | 22MB | Repository names and watch counts ⭐ **Recommended** |
| `Sample_Commits.json` | 78MB | Commit history data |
| `Sample_Files.json` | 4.5MB | File metadata |

## Docker Commands

```bash
# Start services
docker-compose up -d

# Stop services
docker-compose down

# View logs
docker-compose logs mongodb

# Restart services
docker-compose restart

# Remove all data (careful!)
docker-compose down -v
```

## 👨‍🏫 For Instructors

### Running the Application

**Easiest Method:**
1. Ensure Docker is running with MongoDB
2. Open the project folder in VS Code
3. Open `main.py`
4. Click the **▶️ Run Python File** button (top-right)
5. Browser automatically opens to the application

**What You'll See:**
- Import page to load GitHub Archive data
- View page with searchable repository table
- CRUD operations (Create, Update, Delete)
- Analytics page with 4 interactive charts

### Testing CRUD Operations

1. **Import Data**: Load Sample Repositories (22MB)
2. **View**: Search and filter 400K+ records
3. **Create**: Add new repository
4. **Update**: Modify existing repository
5. **Delete**: Remove repository
6. **Analytics**: View charts and statistics

### Technologies Demonstrated

- MongoDB (NoSQL database)
- Python with pymongo
- Streamlit (web framework)
- Docker containerization
- Plotly visualizations
- Modular code architecture

---

## Troubleshooting

### MongoDB Connection Error

```bash
# Check if MongoDB is running
docker-compose ps

# Start MongoDB if not running
docker-compose up -d mongodb

# Check logs for errors
docker-compose logs mongodb
```

### Port Already in Use (8501)

```bash
# Kill process on port 8501
lsof -ti:8501 | xargs kill -9

# Or run on different port
streamlit run github_mongodb_app.py --server.port 8502
```

### Port Already in Use (27017)

```bash
# Check what's using the port
lsof -i :27017

# Stop the process or change port in docker-compose.yaml
```

### Module Import Errors

```bash
# Ensure you're in the correct directory
cd /Users/ecpi/schoolProjects/NOSQL/mongodb/lab

# Reinstall dependencies
pip install -r requirements.txt
```

## Analytics Features

### 1. Summary Statistics
- Total repository count
- Average watch count
- Maximum watch count
- Minimum watch count

### 2. Top Repositories Chart
- Horizontal bar chart
- Top 10 most watched repositories
- Color-coded by watch count

### 3. Distribution Histogram
- Watch count distribution across all repos
- 50 bins for detailed view
- Identifies popular ranges

### 4. Pie Chart
- Top repositories market share
- Percentage distribution
- Visual comparison

### 5. Range Distribution
- Bucketed analysis (0-1K, 1K-5K, etc.)
- Repository count per range
- MongoDB $bucket aggregation

## Future Enhancements

- [ ] Support for Commits and Files collections
- [ ] Advanced filtering (by date, language)
- [ ] Bulk import/export features
- [ ] User authentication
- [ ] Data backup and restore
- [ ] Real-time GitHub API integration
- [ ] Custom query builder
- [ ] Report generation (PDF)

## Development

### Adding New Features

1. **New CRUD operation**: Add to `crud_operations.py`
2. **New visualization**: Add to `visualizations.py`
3. **New page**: Add render function in `github_mongodb_app.py`
4. **Database change**: Update `database.py`

### Code Style
- Follow PEP 8
- Use type hints
- Add docstrings
- Keep functions focused and small

## Author

Amber Lawson ECPI University - NoSQL Database Course

## License

Educational use only

---

**Version:** 2.0 (Modular)
**Last Updated:** January 2025
**MongoDB:** 7.0
**Python:** 3.8+
