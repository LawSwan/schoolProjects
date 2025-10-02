# SDC310 - Server-Side Scripting Projects
**Author:** Amber Lawson  
**Course:** SDC310 - Server-Side Scripting

This repository contains two distinct project categories running in the same Docker container:

## 🏪 **Digital Products Store** (Lab Class)
**Location:** `/Digital_Products_Store/`
- **Purpose:** Lab class e-commerce project
- **Features:** Shopping cart, product catalog, MVC architecture
- **Access:** `http://localhost:8080/Digital_Products_Store/`

## 🎓 **Final Project** (SDC310 Coursework)
**Location:** `/FinalProject/`
- **Purpose:** Consolidated learning objectives from weeks 2-5
- **Architecture:** Modern MVC application
- **Access:** `http://localhost:8080/FinalProject/`

## 📚 **Weekly Progression** (Original Assignments)
The Final Project was built by consolidating and enhancing these original weekly assignments:

### Week 2 - Form Handling
- **Location:** `/Week2/LAWSON_wk2pa.php`
- **Focus:** Basic POST/GET request processing
- **Evolution:** Enhanced with validation and MVC in Final Project

### Week 3 - Database CRUD (Midterm)
- **Location:** `/Week 3/Lawson_MIDTERM/`
- **Focus:** Address management system with full CRUD
- **Evolution:** Completely rebuilt using MVC architecture in Final Project

### Week 4 - Advanced Database Operations
- **Location:** `/Week 4/`
- **Focus:** Multi-table relationships, complex queries
- **Evolution:** Integrated into Final Project with enhanced UI

### Week 5 - Sessions & Cookies
- **Location:** `/Week 5/sdc310_week5_gp1/`
- **Focus:** State management basics
- **Evolution:** Professional session management in Final Project

## 🚀 **Quick Access**
- **Main Navigation:** `http://localhost:8080/` - Central hub for all projects
- **Digital Store:** `http://localhost:8080/Digital_Products_Store/`
- **Final Project:** `http://localhost:8080/FinalProject/`
- **phpMyAdmin:** `http://localhost:8081/`

## 🐳 **Docker Environment**
Both projects run in the same container with:
- **PHP:** 8.0+
- **MySQL:** 8.0
- **Web Server:** Apache
- **Database User:** `Amblaw`
- **Database Host:** `db`

---

## 🔧 **Setup Instructions**

### Docker Setup (Recommended)
1. Ensure Docker Desktop is installed and running
2. Open terminal in project root directory
3. Run: `docker-compose up -d`
4. Access main navigation: http://localhost:8080

### Traditional XAMPP/WAMP Setup
If Docker is not available:
1. Copy the `src` folder contents to your web server directory (htdocs/www)
2. Update database connections in respective config files
3. Run setup scripts for each project as needed
4. Access files through your local server

## 📋 **Project Separation**

### Lab Work (Digital Products Store)
- **Independent project** for lab class
- **Separate codebase** and database
- **E-commerce focus** with shopping cart functionality

### Coursework (Final Project + Weekly Assignments)
- **Academic progression** from Week 2 to Final Project
- **Learning objective demonstration**
- **MVC architecture evolution**

## 🎯 **Learning Objectives Demonstrated**

### Week 2: Form Processing & Validation
- POST/GET request handling
- Input validation and sanitization
- Error handling and user feedback

### Week 3: Database Operations & CRUD
- MySQL database integration
- Full CRUD operations
- SQL injection prevention
- Data validation

### Week 4: Advanced Database & MVC
- Multiple table relationships
- Complex queries with JOINs
- MVC architecture implementation
- User and product management

### Week 5: State Management
- PHP session handling
- Cookie management
- Data persistence across requests
- Security considerations

### Final Project: Consolidated MVC Application
- Clean architecture with separation of concerns
- Modern responsive UI/UX
- Security best practices
- Professional code organization

---

**Student:** Amber Lawson  
**Course:** SDC310 - Server-Side Scripting  
**Container Environment:** Docker with PHP 8.0+ and MySQL 8.0