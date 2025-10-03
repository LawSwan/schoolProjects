# SDC310 Final Project - Consolidated Learning Objectives

**Author:** Amber Lawson  
**Course:** SDC310 - Server-Side Scripting  
**Project:** Consolidated MVC Application (Weeks 2-5)

## Overview

This project consolidates all learning objectives from weeks 2-5 of SDC310 into a single, modern MVC (Model-View-Controller) application. The Week 3 Midterm Address Management System has been completely rebuilt using proper MVC architecture, and all other weekly assignments have been integrated into a cohesive web application.

## Features

### 🏗️ MVC Architecture
- **Models:** Handle all database operations and business logic
- **Views:** Manage presentation and user interface
- **Controllers:** Coordinate between models and views
- **Router:** Clean URL routing and request handling

### 📝 Week 2 - Form Handling & Validation
- POST/GET request processing
- Input validation and sanitization
- Error handling and user feedback
- Form state preservation

### 🏠 Week 3 - Address Management (Midterm Rebuilt)
- Full CRUD operations (Create, Read, Update, Delete)
- MySQL database integration
- Search functionality
- Data validation and error handling

### 🛍️ Week 4 - Product & User Management
- Multiple table relationships
- Complex database queries with JOINs
- User registration and management
- Purchase tracking and reporting

### 🔐 Week 5 - Sessions & Cookies
- Cookie management with expiration
- PHP session handling
- State persistence across requests
- Security considerations

## Technical Implementation

### Database Design
- **addresses:** First, Last, Street, City, State, Zip
- **products:** name, price, created_at, updated_at
- **users:** first_name, last_name, email, created_at
- **purchases:** user_id, product_id, quantity, purchase_date

### Security Features
- SQL injection prevention using prepared statements
- XSS protection with `htmlspecialchars()`
- Input validation and sanitization
- Secure session management
- CSRF protection considerations

### Modern UI/UX
- Responsive design with CSS Grid and Flexbox
- Custom CSS variables for consistent theming
- Smooth animations and transitions
- Mobile-first responsive design
- Accessible form controls and navigation

## File Structure

```
FinalProject/
├── index.php                 # Main entry point
├── config/
│   └── config.php           # Configuration and autoloader
├── Controller/
│   ├── BaseController.php   # Base controller class
│   ├── DashboardController.php
│   ├── AddressController.php
│   ├── ProductController.php
│   ├── SessionController.php
│   └── Week2Controller.php
├── Model/
│   ├── BaseModel.php        # Base model with database connection
│   ├── AddressModel.php     # Address CRUD operations
│   └── ProductModel.php     # Product, user, and purchase operations
├── View/
│   ├── layout/
│   │   └── base.php         # Main layout template
│   ├── dashboard/
│   │   └── index.php        # Dashboard view
│   ├── address/
│   │   └── index.php        # Address management view
│   ├── week2/
│   │   └── index.php        # Form handling demonstration
│   ├── week4/
│   │   └── index.php        # Product management view
│   └── week5/
│       ├── index.php        # Sessions & cookies main view
│       ├── cookies.php      # Cookie demonstration
│       └── sessions.php     # Session demonstration
├── Router/
│   └── Router.php           # URL routing and request handling
├── assets/
│   └── css/
│       └── style.css        # Modern CSS styling
└── README.md               # This file
```

## Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx) or PHP built-in server

### Database Configuration
Update the database settings in `config/config.php`:

```php
define('DB_HOST', 'your_host');
define('DB_USERNAME', 'your_username');
define('DB_PASSWORD', 'your_password');
define('DB_NAME', 'sdc310_final');
```

### Running the Application
1. Clone or download the project files
2. Configure your database connection
3. Place files in your web server directory
4. Navigate to `index.php` in your browser
5. The application will automatically create the database and tables

### Docker Setup (if using existing Docker environment)
The application is configured to work with the existing Docker setup:
- Database host: `db`
- Username: `Amblaw`
- Password: `password`
- Database: `sdc310_final`

## Learning Objectives Demonstrated

### 📋 Form Processing & Validation
- ✅ Handle POST and GET requests
- ✅ Validate and sanitize user input
- ✅ Implement proper error handling
- ✅ Maintain form state on submission

### 🗄️ Database Operations
- ✅ Establish MySQL connections
- ✅ Perform CRUD operations
- ✅ Design normalized database schemas
- ✅ Prevent SQL injection attacks

### 🏗️ MVC Architecture
- ✅ Separate concerns into Model-View-Controller
- ✅ Implement clean URL routing
- ✅ Create reusable base classes
- ✅ Organize code for maintainability

### 🔄 State Management
- ✅ Implement PHP sessions
- ✅ Manage browser cookies
- ✅ Persist data across requests
- ✅ Handle session security

### 🎨 Modern Web Development
- ✅ Responsive design principles
- ✅ Accessible user interfaces
- ✅ Progressive enhancement
- ✅ Clean, semantic HTML

## Usage

### Navigation
- **Dashboard:** Overview of all learning objectives
- **Week 2:** Form handling and validation demonstration
- **Week 3:** Address management system (CRUD operations)
- **Week 4:** Product and user management with complex queries
- **Week 5:** Session and cookie management

### Key Features
1. **Address Management:** Add, edit, delete, and search addresses
2. **Product System:** Manage products, users, and track purchases
3. **Form Processing:** Demonstrate various form handling techniques
4. **State Management:** Show cookie and session persistence

## Code Quality

### Best Practices Implemented
- Object-oriented programming principles
- Separation of concerns
- DRY (Don't Repeat Yourself) principle
- Consistent naming conventions
- Comprehensive error handling
- Security-first development

### Performance Considerations
- Efficient database queries
- Minimal HTTP requests
- Optimized CSS and JavaScript
- Responsive image handling

## Future Enhancements

Potential improvements for extended learning:
- User authentication and authorization
- AJAX for dynamic content updates
- File upload functionality
- Email integration
- API endpoints for mobile apps
- Advanced search and filtering
- Data export capabilities

## Conclusion

This project successfully demonstrates mastery of server-side PHP development concepts, from basic form handling to complex database operations, all organized within a clean MVC architecture. The modern, responsive interface provides an excellent user experience while showcasing technical proficiency in web development best practices.

---

**Note:** This application consolidates and improves upon all previous weekly assignments, with the Week 3 Midterm completely rebuilt using MVC principles while maintaining identical functionality.

