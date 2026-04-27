# Amazon Reviews Database Management System

## Overview
This Python application performs CRUD operations on a MongoDB database containing Amazon product reviews. It provides a comprehensive menu-driven interface for managing ReviewData and ProductData collections.

## Prerequisites
- Python 3.12+
- MongoDB container running on port 27017
- Required Python packages: pymongo, datetime

## Setup Instructions

### 1. Start MongoDB Container
```bash
docker start 73f139ad85a4
```

### 2. Install Dependencies
```bash
pip install pymongo
```

### 3. Run the Application
```bash
python app.py
```

## Features

### ✅ Database Operations
- **Load Initial Data**: Import JSON dataset into ReviewData and ProductData collections
- **Insert Operations**: Add new reviews and products
- **Search Operations**: Find reviews by ID, title, or body content
- **Analytics**: Count reviews by star rating and product category
- **Delete Operations**: Remove individual reviews or entire datasets

### ✅ Menu Options
1. 📥 Load Initial Data from JSON
2. ➕ Insert New Review Data  
3. ➕ Insert New Product Data
4. 🔍 Display Review by Review ID
5. 📂 Display All Distinct Product Categories
6. ⭐ Count 4-5 Star Reviews by Category
7. ⭐ Count 1-2 Star Reviews by Category
8. 🔎 Search Reviews by Title (Regex)
9. 🔎 Search Reviews by Body (Regex)
10. 🗑️ Delete a Review
11. 🗑️ Delete All Review Data
12. 🗑️ Delete All Product Data
13. 📊 Display Database Statistics
0. 🚪 Exit

### ✅ Data Structure

#### ReviewData Collection
- review_id: Unique identifier
- product_id: Associated product
- reviewer_id: User who wrote review
- stars: Rating (1-5)
- review_body: Full review text
- review_title: Review title
- language: Review language

#### ProductData Collection
- product_id: Unique identifier
- product_category: Product category
- language: Product language

## Usage Examples

### Search Reviews by Title
- Uses MongoDB $regex operator for case-insensitive pattern matching
- Example: Search for "great" finds all reviews with "great" in the title

### Search Reviews by Body
- Uses MongoDB $regex operator for flexible text search
- Example: Search for "quality" finds all reviews mentioning quality

### Analytics Queries
- Count high-rated reviews (4-5 stars) by product category
- Count low-rated reviews (1-2 stars) by product category
- Display star rating distribution across all reviews

## MongoDB Collections Structure

The application creates two main collections:

1. **Amazon_EN_Reviews.ReviewData**: Stores individual review records
2. **Amazon_EN_Reviews.ProductData**: Stores unique product information

## Requirements Met
✅ Header comment with name, date, and program summary  
✅ Menu-driven system for user interaction  
✅ Insert operations for ReviewData and ProductData  
✅ Display review information by review_id  
✅ Display all distinct product categories  
✅ Count 4-5 star reviews by category  
✅ Count 1-2 star reviews by category  
✅ Search reviews by title using $regex operator  
✅ Search reviews by body using $regex operator  
✅ Delete individual reviews  
✅ Delete all ReviewData and ProductData  
✅ Real-time date/time display in output  

## Technical Implementation
- **Database**: MongoDB with pymongo driver
- **Search**: Uses MongoDB $regex operator for flexible pattern matching
- **Error Handling**: Comprehensive try-catch blocks for robust operation
- **User Interface**: Clean, emoji-enhanced menu system with clear feedback
- **Data Validation**: Input validation and confirmation prompts for destructive operations
