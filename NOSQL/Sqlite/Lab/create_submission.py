"""
Create Submission Zip - Simple and Clean
Packages only the essential application files
"""

import zipfile
import os
from datetime import datetime

# Files to include in submission
FILES_TO_INCLUDE = [
    'main.py',
    'github_sqlite_app.py',
    'database.py',
    'crud_operations.py',
    'visualizations.py',
    'github_api.py',
    'requirements.txt',
    'README.md'
]

def create_zip():
    """Create submission zip file"""
    timestamp = datetime.now().strftime('%Y%m%d')
    zip_name = f"GitHub_SQLite_CRUD_Submission_{timestamp}.zip"

    print("Creating submission package...")
    print(f"Output: {zip_name}\n")

    with zipfile.ZipFile(zip_name, 'w', zipfile.ZIP_DEFLATED) as zipf:
        for file in FILES_TO_INCLUDE:
            if os.path.exists(file):
                zipf.write(file)
                size = os.path.getsize(file)
                print(f"✅ {file} ({size:,} bytes)")
            else:
                print(f"⚠️  {file} NOT FOUND")

    zip_size = os.path.getsize(zip_name)
    print(f"\n✅ Created: {zip_name}")
    print(f"📦 Size: {zip_size:,} bytes ({zip_size/1024:.1f} KB)")
    print("\nReady for submission!")

if __name__ == "__main__":
    create_zip()
