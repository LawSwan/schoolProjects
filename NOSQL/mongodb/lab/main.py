"""
Main Entry Point for GitHub Archive MongoDB CRUD Application

Simply run this file to start the Streamlit application.
Click the 'Run' button in VS Code or execute: python main.py
"""

import subprocess
import sys
import webbrowser
import time
from threading import Timer

def open_browser():
    """Open the browser after a short delay"""
    time.sleep(2)
    webbrowser.open('http://localhost:8501')

def main():
    """Launch the Streamlit application"""
    print("=" * 60)
    print("  GitHub Archive MongoDB CRUD Application")
    print("=" * 60)
    print("\n🚀 Starting Streamlit server...")
    print("📊 Opening browser at http://localhost:8501")
    print("\n💡 To stop the server: Press Ctrl+C")
    print("=" * 60 + "\n")

    # Open browser after 2 seconds
    Timer(2.0, open_browser).start()

    # Run Streamlit with logger settings to reduce output
    try:
        subprocess.run([
            sys.executable, "-m", "streamlit", "run",
            "github_mongodb_app.py",
            "--server.headless=true",
            "--logger.level=error"
        ])
    except KeyboardInterrupt:
        print("\n\n✅ Application stopped successfully!")
        print("Thank you for using GitHub Archive MongoDB CRUD!\n")
        sys.exit(0)

if __name__ == "__main__":
    main()
