# SDC310 Midterm - Address Management System
**Created by: Lawson**

## Overview
This is a complete PHP web application for managing addresses with full CRUD (Create, Read, Update, Delete) functionality.

## Files Included
- `midterm_setup.php` - Database and table setup script
- `midterm_db_connection.php` - Database connection configuration
- `Lawson_MIDTERM.php` - Main application with CRUD functionality

## Database Requirements
- Database: `sdc310_midterm`
- User: `ecpi_user`
- Table: `addresses` with the following structure:
  - AddressNo (auto-increment, primary key)
  - First (25 characters, not null)
  - Last (30 characters, not null)
  - Street (100 characters, not null)
  - City (25 characters, not null)
  - State (2 characters, not null)
  - Zip (10 characters, not null)

## Setup Instructions
1. Run `midterm_setup.php` first to create the database and table
2. Access `Lawson_MIDTERM.php` to use the application

## Features
- **View All Addresses**: Displays all addresses in a formatted table
- **Add New Address**: Form to add new addresses with validation
- **Edit Address**: Click "Edit" to modify existing addresses
- **Delete Address**: Click "Delete" to remove addresses (with confirmation)
- **Responsive Design**: Works on desktop and mobile devices
- **Input Validation**: Ensures data integrity and security

## Sample Data
The setup script includes two sample records:
1. Lawson Swan - 123 Main Street, Virginia Beach, VA 23451
2. John Doe - 456 Oak Avenue, Norfolk, VA 23502

## Security Features
- SQL injection protection using mysqli_real_escape_string()
- HTML output escaping using htmlspecialchars()
- Form validation and data sanitization
- Confirmation dialogs for delete operations
