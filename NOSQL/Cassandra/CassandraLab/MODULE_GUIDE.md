# Module Guide

## Project Structure

```
CassandraLab/
├── main.py                    # Entry point & application controller (221 lines)
├── config.py                  # Configuration settings (37 lines)
├── database.py                # Cassandra operations (153 lines)
├── github_api.py              # GitHub API client (113 lines)
├── gui.py                     # GUI layout & styling (291 lines)
├── requirements.txt           # Dependencies
├── README.md                  # Full documentation
└── cassandra_github_analyzer.py  # OLD monolithic file (for reference)
```

## Module Breakdown

### 1. `config.py` - Configuration
**Purpose:** Centralized configuration settings

**Contains:**
- Cassandra connection settings
- GitHub API configuration
- Application parameters (max repos, delays, etc.)
- GUI settings (window size, title)

**Why separate?** Easy to modify settings without touching code logic.

---

### 2. `database.py` - Database Operations
**Purpose:** All Cassandra CRUD operations

**Key Classes:**
- `CassandraDatabase` - Handles all database interactions

**Key Methods:**
- `connect()` - Connect to Cassandra
- `setup_schema()` - Create keyspace and tables
- `insert_repository()` - CREATE operation
- `insert_or_update_topic()` - CREATE/UPDATE operation
- `insert_contributor()` - CREATE operation
- `get_all_contributors()` - READ operation
- `get_all_repositories()` - READ operation
- `get_all_topics()` - READ operation
- `clear_all_data()` - DELETE operation
- `close()` - Clean shutdown

**Why separate?** All database logic in one place, easy to test and modify schema.

---

### 3. `github_api.py` - API Client
**Purpose:** GitHub REST API interactions

**Key Classes:**
- `GitHubAPIClient` - Handles API requests

**Key Methods:**
- `fetch_trending_repositories()` - Get repos from GitHub
- `fetch_repository_contributors()` - Get contributors for a repo
- `process_repository_data()` - Extract relevant data
- `get_fallback_data()` - Return sample data when API fails

**Why separate?** Isolates API logic, easy to mock for testing, clear error handling.

---

### 4. `gui.py` - User Interface
**Purpose:** All tkinter GUI components

**Key Classes:**
- `GitHubAnalyzerGUI` - Manages all UI elements

**Key Methods:**
- `setup_window()` - Configure main window
- `setup_ui()` - Create complete UI layout
- `create_*_tab()` - Create each tab
- `display_*_data()` - Display data in widgets
- `update_status()` - Update status bar
- `show_error/success/warning()` - Message dialogs

**Why separate?** Separates presentation from logic, easier to redesign UI.

---

### 5. `main.py` - Application Controller
**Purpose:** Ties everything together, orchestrates workflow

**Key Classes:**
- `GitHubAnalyzerApp` - Main application controller

**Key Methods:**
- `connect_database()` - Initialize database connection
- `load_github_data()` - Fetch and store API data
- `load_fallback_data()` - Load sample data
- `display_contributors/languages/topics()` - Coordinate data display
- `clear_all_data()` - Delete all data
- `close()` - Clean shutdown

**Why separate?** Single responsibility - coordinates between modules, doesn't do the work itself.

---

## How It All Works Together

```
User clicks "Fetch Data"
        ↓
    main.py (controller)
        ↓
    github_api.py (fetches data)
        ↓
    main.py (receives data)
        ↓
    database.py (stores data)
        ↓
    main.py (confirms success)
        ↓
    gui.py (shows success message)
```

## Benefits of This Structure

1. **Easier to Read:** Each file has one clear purpose
2. **Easier to Debug:** Know exactly where to look for issues
3. **Easier to Test:** Can test each module independently
4. **Easier to Modify:** Change one aspect without affecting others
5. **Reusable:** Can use database.py or github_api.py in other projects
6. **Team-Friendly:** Multiple people can work on different modules

## Running the Application

```bash
# Run the new modular version
python3 main.py

# OLD way (still works, but don't use)
python3 cassandra_github_analyzer.py
```

## Adding New Features

**Want to add a new data source?**
- Create `new_api.py` module
- Import in `main.py`
- Add methods to controller

**Want to change the database?**
- Modify `database.py` only
- Rest of app doesn't need to change (as long as method signatures stay same)

**Want to redesign the GUI?**
- Modify `gui.py` only
- Logic in `main.py` stays the same

---

**Created:** 2026-01-13
**Author:** Amber Lawson
