# Server-Side Scripting Portfolio

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

Full-stack PHP web applications demonstrating MVC architecture, database integration, and modern web development patterns.

---

## Featured Project: Digital Products Store

A complete e-commerce platform built with custom MVC framework demonstrating professional PHP development practices.

### Features

- **Product Catalog**: Browse digital products by category
- **Shopping Cart**: Add/remove items with session persistence
- **Category Filtering**: Dynamic product organization
- **Related Products**: Smart recommendations based on category
- **Admin Tools**: Database cleanup and management utilities

### MVC Architecture

```
Digital_Products_Store/
├── Controller/
│   ├── BaseController.php    # Parent controller with shared methods
│   ├── ProductController.php # Product listing and details
│   └── CartController.php    # Shopping cart operations
├── Model/
│   ├── BaseModel.php         # Database connection wrapper
│   ├── ProductModel.php      # Product CRUD operations
│   ├── CategoryModel.php     # Category management
│   └── CartModel.php         # Cart data handling
├── View/
│   ├── layout/
│   │   └── base.php          # Main layout template
│   ├── product/
│   │   └── index.php         # Product listing view
│   └── cart/
│       └── index.php         # Shopping cart view
├── Router/
│   └── Router.php            # URL routing system
├── mvc.php                   # Application entry point
├── db_connection.php         # Database configuration
└── setup.php                 # Database initialization
```

### Code Highlights

**Product Controller with Category Filtering:**
```php
public function category($categoryId) {
    $products = $this->productModel->getByCategory($categoryId);
    $categories = $this->categoryModel->getAll();
    $currentCategory = $this->categoryModel->getById($categoryId);

    $this->loadView('product/index', [
        'products' => $products,
        'categories' => $categories,
        'currentCategory' => $currentCategory,
        'title' => $currentCategory ? $currentCategory['name'] : 'Products'
    ]);
}
```

**Related Products Logic:**
```php
$relatedProducts = $this->productModel->getByCategory($product['category_id']);
$relatedProducts = array_filter($relatedProducts, function($p) use ($productId) {
    return $p['id'] != $productId;
});
$relatedProducts = array_slice($relatedProducts, 0, 4);
```

---

## Course Structure

| Week | Topics | Projects |
|------|--------|----------|
| Week 4 | Database Models | Database connection patterns |
| Final | Full-Stack MVC | Digital Products Store |

---

## Technologies

### Backend
- PHP 8.x
- Custom MVC Framework
- PDO for database access
- Session management

### Frontend
- HTML5/CSS3
- Responsive layouts
- Template-based views

### Database
- MySQL
- Prepared statements
- CRUD operations

---

## Running the Application

### Prerequisites
- PHP 8.0+
- MySQL/MariaDB
- Web server (Apache/Nginx) or PHP built-in server

### Setup

1. **Configure Database**
   ```php
   // Edit db_connection.php
   $host = 'localhost';
   $dbname = 'digital_products';
   $username = 'your_username';
   $password = 'your_password';
   ```

2. **Initialize Database**
   ```bash
   php setup.php
   ```

3. **Start Development Server**
   ```bash
   cd ServerSideScripting/src/Digital_Products_Store
   php -S localhost:8000
   ```

4. **Access Application**
   ```
   http://localhost:8000/mvc.php
   ```

---

## Design Patterns Used

### MVC (Model-View-Controller)
- **Models**: Handle data access and business logic
- **Views**: Present data with PHP templates
- **Controllers**: Process requests and coordinate responses

### Front Controller
- Single entry point (`mvc.php`) for all requests
- Centralized routing and request handling

### Repository Pattern
- Models abstract database operations
- Clean separation of data access from business logic

---

## Skills Demonstrated

- Custom MVC framework development
- Database design and integration
- Session and cart management
- Routing and URL handling
- Template-based view rendering
- Code organization and architecture
- PHP OOP best practices

---

## Author

**Amber Lawson**
Server-Side Scripting Coursework
