# Amber Lawson - Server Side Scripting Project

## Project Structure
This project contains Week 2 and Week 3 performance assessments for Server Side Scripting.

## Quick Start Options

### Option A: Docker Setup (Recommended)
1. Ensure Docker Desktop is installed and running
2. Open terminal in project root directory
3. Run: `docker-compose up -d`
4. Access applications:
   - Week 2 Assignment: http://localhost:8080/Week2/LAWSON_wk2pa.php
   - Week 3 Assignment: http://localhost:8080/Week%203/Lawson_performance.php
   - phpMyAdmin: http://localhost:8081

### Option B: Traditional XAMPP/WAMP Setup
If Docker is not available:

1. Copy the `src` folder contents to your web server directory (htdocs/www)
2. Update database connection in `Week 3/db_connection.php`:
   - Change `$hostname = "db";` to `$hostname = "localhost";`
   - Update username/password as needed for your MySQL setup
3. Import database:
   - Run `Week 3/setup_performance.php` to create the database structure
4. Access files through your local server

## Database Setup
The Week 3 application requires a MySQL database. The setup script will create:
- Database: `mydatabase_php`
- Table: `personal_info` with fields for first name, last name, email, and birth date

## Assignment Details

### Week 2 Performance Assessment
- **File**: `Week2/LAWSON_wk2pa.php`
- **Description**: Form processing with conditional output display
- **Features**: POST request handling, form validation, conditional results

### Week 3 Performance Assessment  
- **File**: `Week 3/Lawson_performance.php`
- **Description**: Full CRUD application for personal information management
- **Features**: 
  - Create new records
  - Read/display all records in table format
  - Update existing records
  - Delete records
  - Professional styling with purple/pink theme
  - Form validation and error handling

## Technical Specifications
- **PHP Version**: 8.2
- **Database**: MySQL 8.0
- **Frontend**: HTML5, CSS3, responsive design
- **Database Extension**: mysqli

## Notes for Instructor
- All code is original and follows PHP best practices
- Database connections use prepared statements where applicable
- Responsive design works on various screen sizes
- Error handling implemented throughout

---
**Student**: Amber Lawson  
**Course**: Server Side Scripting  
**Submission Date**: September 18, 2025
