# Digital Products Store

A PHP web application for selling digital products like icon packs, wallpapers, UI kits, and more.

## Project Structure
```
Digital_Products_Store/
├── database_schema.sql     # Database structure
├── sample_data.sql        # Sample products and users
├── db_connection.php      # Database connection
├── setup.php             # Database setup script
├── index.php             # Main store front
└── README.md             # This file
```

## Database Separation
This project uses a **separate database** (`digital_products_store`) from your class assignments to ensure:
- No conflicts with assignment data
- Clean separation of concerns
- Professional portfolio project
- Independent development environment

## Setup Instructions
1. Ensure Docker containers are running
2. Visit: `http://localhost:8080/Digital_Products_Store/setup.php`
3. Run the setup to create database and sample data
4. Access the store at: `http://localhost:8080/Digital_Products_Store/index.php`

## Features Planned
- [ ] Product catalog display
- [ ] User registration/login
- [ ] Shopping cart functionality
- [ ] Secure download system
- [ ] Order management
- [ ] Admin panel for product management
- [ ] Payment integration (future)

## Sample Products
The store comes with sample data including:
- **Icon Packs**: Minimal Pastel, Dark Academia, Kawaii Konvert, etc.
- **Wallpapers**: Abstract Landscapes, Minimalist Gradients
- **UI Kits**: Modern Dashboard interfaces
- **Fonts**: Handwritten Script collections
- **Graphics**: Social Media Templates

## Database Details
- **Database**: `digital_products_store`
- **Separate from**: Class assignment databases
- **Tables**: Users, Products, Categories, Orders, Downloads
- **Sample Users**: Pre-populated for testing

## Development Notes
This is designed as a professional portfolio project separate from coursework, allowing you to:
1. Build a real-world application
2. Demonstrate full-stack development skills
3. Create a marketable digital products platform
4. Maintain clean separation from academic work
