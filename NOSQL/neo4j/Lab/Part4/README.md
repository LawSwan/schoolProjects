# GitHub Archive Neo4j Analytics Platform

A Python application that integrates GitHub Archive data with Neo4j graph database to provide powerful analytics and insights into GitHub activity patterns.

## Features

- **Data Import**: Download and import GitHub Archive data from gharchive.org
- **CRUD Operations**: Create, Read, Update, Delete operations on users, repositories, and events
- **Advanced Analytics**:
  - User collaboration pattern discovery
  - Repository similarity analysis based on contributors or programming languages
  - Event timeline visualization
  - Programming language statistics and distribution
- **Interactive Web UI**: Streamlit-based dashboard for easy interaction

## Technology Stack

- **Database**: Neo4j (Graph Database)
- **Backend**: Python 3.x
- **Libraries**:
  - `neo4j` - Neo4j Python driver
  - `streamlit` - Web application framework
  - `pandas` - Data manipulation
  - `plotly` - Interactive visualizations
  - `requests` - HTTP library for downloading data
- **Data Source**: [GitHub Archive](https://www.gharchive.org/)

## Installation

### Prerequisites

1. **Docker** with Neo4j container running
2. **Python 3.8+**

### Setup


1. Install Python dependencies:
```bash
pip install -r requirements.txt
```

2. Ensure your Neo4j container is running:
```bash
docker start ee528a55d8ef
```

## Usage

### Method 1: Web Application (Recommended)

Launch the Streamlit web interface:

```bash
streamlit run streamlit_app.py
```

This will open a web browser with an interactive dashboard where you can:
- Connect to your Neo4j database
- Download and import GitHub Archive data
- Perform CRUD operations through forms
- View analytics and visualizations

### Method 2: Command Line

#### Test the core Neo4j application:
```bash
python github_neo4j_app.py
```

#### Download GitHub Archive data:
```bash
python github_archive_loader.py
```

#### Import data into Neo4j:
```bash
python data_integration.py
```

## Project Structure

```
Part4/
├── github_neo4j_app.py       # Core Neo4j CRUD operations and analytics
├── github_archive_loader.py  # GitHub Archive data downloader and parser
├── data_integration.py       # Integration layer connecting loader to Neo4j
├── streamlit_app.py          # Interactive web application
├── requirements.txt          # Python dependencies
├── README.md                 # This file
└── data/                     # Downloaded GitHub Archive files (created automatically)
```

## Neo4j Database Schema

### Node Types

- **User**: GitHub users
  - Properties: `id`, `username`, `email`, `updated_at`

- **Repository**: GitHub repositories
  - Properties: `id`, `name`, `language`, `description`, `updated_at`

- **Event**: GitHub events (PushEvent, PullRequestEvent, etc.)
  - Properties: `id`, `type`, `created_at`

### Relationship Types

- `OWNS`: User owns Repository
- `CONTRIBUTED_TO`: User contributed to Repository
- `PERFORMED`: User performed Event
- `ON_REPO`: Event occurred on Repository

## Database Connection

Default connection settings:
- **URI**: `neo4j://localhost:7687`
- **Username**: `neo4j`
- **Password**: `password1`

These can be modified in the Streamlit sidebar or in the individual Python scripts.

## GitHub Archive Data

GitHub Archive (https://www.gharchive.org/) provides hourly snapshots of all public GitHub activity. Each hour is stored as a compressed JSON file containing events like:

- **PushEvent**: Code commits
- **PullRequestEvent**: Pull request activity
- **IssuesEvent**: Issue creation and updates
- **WatchEvent**: Repository stars
- **ForkEvent**: Repository forks
- **CreateEvent**: Repository/branch/tag creation
- And many more...

## Analytics Features

### 1. User Collaboration Patterns
Discover which users have worked on the same repositories, helping identify collaboration networks.

### 2. Repository Similarity Analysis
Find repositories that are similar based on:
- Common contributors
- Programming language

### 3. Event Timeline
Analyze the sequence and distribution of GitHub events over time, filtered by user, repository, or event type.

### 4. Programming Language Statistics
Visualize the distribution of programming languages across all repositories in the database.

## Development Notes

- The application uses `MERGE` operations to avoid duplicate nodes
- All CRUD operations are atomic and use Neo4j sessions
- Error handling is implemented throughout the codebase
- The modular design allows easy extension with new features

## Dependencies

```
neo4j>=5.0.0          # Neo4j Python driver
streamlit>=1.28.0     # Web application framework
pandas>=2.0.0         # Data manipulation
plotly>=5.17.0        # Interactive visualizations
requests>=2.31.0      # HTTP requests for data download
```

## Future Enhancements

- Add more analytical features (trending repositories, user influence scores)
- Implement data caching for faster queries
- Add export functionality (CSV, JSON)
- Expand GitHub API integration for richer repository metadata
- Add authentication and user sessions
- Implement real-time data streaming

## Troubleshooting

### Connection Issues
- Ensure Neo4j container is running: `docker ps`
- Verify port 7687 is accessible
- Check credentials in connection settings

### Import Errors
- Verify internet connection for downloading GitHub Archive data
- Check that the selected date has available data
- Reduce the import limit if experiencing memory issues

### Performance
- For large datasets, import data in smaller batches
- Use indexes in Neo4j for frequently queried properties
- Consider limiting the number of events imported initially

## Author

Created as part of NOSQL database coursework - Neo4j Lab Part 4

## License

Educational project - free to use and modify