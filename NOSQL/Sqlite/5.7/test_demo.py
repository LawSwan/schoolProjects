#!/usr/bin/env python3
"""
Demo script to showcase the Amazon Reviews Database Management System
This script will automatically load data and demonstrate key features
"""

from app import AmazonReviewsDB
import time

def demo_application():
    """Demonstrate the application features"""
    print("🚀 Amazon Reviews Database Demo Starting...")
    
    # Initialize the application
    app = AmazonReviewsDB()
    
    # Load initial data
    print("\n" + "="*60)
    print("📥 LOADING INITIAL DATA FROM JSON FILE")
    print("="*60)
    app.load_initial_data()
    time.sleep(2)
    
    # Display statistics
    print("\n" + "="*60)
    print("📊 DATABASE STATISTICS")
    print("="*60)
    app.display_statistics()
    time.sleep(2)
    
    # Show distinct categories
    print("\n" + "="*60)
    print("📂 DISTINCT PRODUCT CATEGORIES")
    print("="*60)
    app.display_distinct_categories()
    time.sleep(2)
    
    # Demo search functionality
    print("\n" + "="*60)
    print("🔍 DEMO: SEARCHING FOR REVIEWS WITH 'GREAT' IN TITLE")
    print("="*60)
    # Simulate user input for search
    import sys
    from io import StringIO
    
    # Temporarily redirect stdin for demo
    old_stdin = sys.stdin
    sys.stdin = StringIO('great\n')
    app.search_reviews_by_title()
    sys.stdin = old_stdin
    
    print("\n" + "="*60)
    print("✅ DEMO COMPLETED SUCCESSFULLY!")
    print("🕐 Demo finished at:", time.strftime('%Y-%m-%d %H:%M:%S'))
    print("="*60)

if __name__ == "__main__":
    demo_application()
