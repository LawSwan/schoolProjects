"""
Cassandra GitHub Archive Analyzer
Author: Amber Lawson
Date: 2026-01-13
Project: 3.3 Group Project - Cassandra Integration

This is the main entry point for the application.
The code has been refactored into modular components for better organization.

Module Structure:
- config.py      : Configuration settings
- database.py    : Cassandra database operations
- github_api.py  : GitHub API client
- gui.py         : GUI components
- main.py        : Application controller

See MODULE_GUIDE.md for detailed documentation.
"""

# Import and run the modular application
from main import main

if __name__ == "__main__":
    main()
