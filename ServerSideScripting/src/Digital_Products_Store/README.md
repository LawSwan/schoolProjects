# Digital Products Store - MVC Framework

A clean, organized digital products store built with a proper MVC (Model-View-Controller) architecture, featuring dynamic carousel and shopping cart functionality.

## 🏗️ MVC Architecture

### **Models** (`/Model/`)
- `BaseModel.php` - Abstract base class with common functionality
- `ProductModel.php` - Manages product data and operations
- `CategoryModel.php` - Handles category data
- `CartModel.php` - Shopping cart operations and session management

### **Controllers** (`/Controller/`)
- `BaseController.php` - Base controller with common methods
- `ProductController.php` - Handles product-related requests
- `CartController.php` - Manages cart operations and AJAX responses

### **Views** (`/View/`)
- `layout/base.php` - Base template with header, footer, and styling
- `product/index.php` - Product listing with dynamic carousel
- `cart/index.php` - Shopping cart interface

### **Router** (`/Router/`)
- `Router.php` - URL routing and request dispatching

## 📁 File Structure

```
Digital_Products_Store/
├── mvc.php              # Main MVC entry point
├── index.php            # Redirects to MVC framework
├── Model/               # Data layer
│   ├── BaseModel.php
│   ├── ProductModel.php
│   ├── CategoryModel.php
│   └── CartModel.php
├── Controller/          # Business logic layer
│   ├── BaseController.php
│   ├── ProductController.php
│   └── CartController.php
├── View/               # Presentation layer
│   ├── layout/
│   │   └── base.php
│   ├── product/
│   │   └── index.php
│   └── cart/
│       └── index.php
├── Router/             # URL routing
│   └── Router.php
├── cart_handler.php    # Legacy cart handler (kept for compatibility)
├── cart.php           # Legacy cart page (kept for compatibility)
└── README.md
```

## ✨ Features

- ✅ **Clean MVC Architecture** - Proper separation of concerns
- ✅ **Dynamic Product Carousel** - Beautiful carousel with navigation
- ✅ **Individual Product Image Carousels** - Multiple images per product
- ✅ **Sunset Gradient Design** - Elegant glass-morphism UI
- ✅ **Session-based Shopping Cart** - Persistent cart across sessions
- ✅ **AJAX Cart Operations** - Smooth add/remove/update functionality
- ✅ **Responsive Design** - Works on all devices
- ✅ **10 Sample Products** - Across 5 categories

## 🌐 Access

**Main Store:** `http://localhost:8080/Digital_Products_Store/`
**MVC Framework:** `http://localhost:8080/Digital_Products_Store/mvc.php`

## 🛍️ Products

**Icon Packs (5):** Minimal Pastel, Dark Academia, Kawaii, Cottagecore Magic, Neon Tech  
**Wallpapers (2):** Abstract Landscapes, Minimalist Gradients  
**UI Kits (1):** Modern Dashboard UI  
**Fonts (1):** Handwritten Script Collection  
**Graphics (1):** Social Media Templates  

## 🔧 Technical Details

- **Framework:** Custom MVC built in PHP
- **Data Storage:** In-memory arrays (easily extensible to database)
- **Session Management:** PHP sessions for cart persistence
- **AJAX:** Fetch API for smooth cart operations
- **Styling:** CSS3 with gradients and backdrop-filter
- **Responsive:** Mobile-first design approach

---
*Portfolio Project by Amber Lawson*
