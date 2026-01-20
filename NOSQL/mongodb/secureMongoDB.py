"""
Name: Amber Lawson
Date: January 9, 2026
Assignment: Guided Practice: Python Application Securing a MongoDB Database

Objective:
This program demonstrates how to create and authenticate a secure MongoDB user
with specific database privileges. It connects to a MongoDB instance, creates
a new administrative user with read/write permissions, authenticates using
SCRAM-SHA-256, and performs basic CRUD operations on a secured database collection
containing confidential client information.
"""

from pymongo import MongoClient
import os

# Connect to local administrative database
dbLink = "mongodb://localhost:27017/"
client = MongoClient(dbLink)
db = client.admin

# Set new user information
dbName = "SecureInformation"
username = "Amblaw9047"
password = "secureDBPassword"

# Give the user read and write privileges
roles = [{"role": "readWrite", "db": dbName}]

# Run the command to create a new user
# Drop user if it already exists
try:
    db.command("dropUser", username)
    print(f"Dropped existing user: {username}")
except:
    pass  # User doesn't exist yet

result = db.command("createUser", username, pwd=password, roles=roles)

# Check if the user was added
if result["ok"] == 1.0:
    print("Successfully added new database user!")
else:
    print("Failed to add new database user.")

# Close the administrative database
client.close()

# Connect to the secured database using the created user
auth = "SCRAM-SHA-256"
client = MongoClient(dbLink, username=username, password=password, authMechanism=auth)

# Create a new collection in the SecureInformation database
db = client[dbName]
ccCollection = db["ClientContacts"]

# Add confidential information to the collection
record = {"_id": "9047", "Amber Lawson": os.getlogin(), "SSN": "333-22-4444"}
ccCollection.insert_one(record)

# Display the confidential information
query = {"_id": "9047"}
data = ccCollection.find_one(query)
print("Displaying data for Client 9047:")
print(data)

# Delete the record to avoid potential future duplicate keys
ccCollection.delete_one(query)

# Close the connection to the SecureInformation database
client.close()
