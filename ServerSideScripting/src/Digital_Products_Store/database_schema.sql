-- Digital Products Store Database Setup
-- Separate database for the digital products marketplace

-- Create dedicated database
CREATE DATABASE IF NOT EXISTS digital_products_store;
USE digital_products_store;

-- Users table for the store (separate from class assignments)
CREATE TABLE IF NOT EXISTS store_users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) UNIQUE NOT NULL,
    Email VARCHAR(100) UNIQUE NOT NULL,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL, -- For hashed passwords
    JoinDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    IsActive BOOLEAN DEFAULT TRUE
);

-- Product categories table
CREATE TABLE IF NOT EXISTS categories (
    CategoryID INT AUTO_INCREMENT PRIMARY KEY,
    CategoryName VARCHAR(50) NOT NULL,
    CategoryDescription TEXT,
    IsActive BOOLEAN DEFAULT TRUE
);

-- Products table for digital items
CREATE TABLE IF NOT EXISTS digital_products (
    ProductID INT AUTO_INCREMENT PRIMARY KEY,
    ProductCode VARCHAR(20) UNIQUE NOT NULL,
    ProductName VARCHAR(100) NOT NULL,
    ProductDescription TEXT,
    CategoryID INT,
    Price DECIMAL(10,2) NOT NULL,
    ImageURL VARCHAR(255),
    DownloadURL VARCHAR(255),
    FileSize VARCHAR(20),
    CreatedDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    IsActive BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (CategoryID) REFERENCES categories(CategoryID)
);

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    OrderID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    OrderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    TotalAmount DECIMAL(10,2) NOT NULL,
    OrderStatus ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
    FOREIGN KEY (UserID) REFERENCES store_users(UserID)
);

-- Order items table
CREATE TABLE IF NOT EXISTS order_items (
    OrderItemID INT AUTO_INCREMENT PRIMARY KEY,
    OrderID INT,
    ProductID INT,
    Quantity INT DEFAULT 1,
    UnitPrice DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (OrderID) REFERENCES orders(OrderID),
    FOREIGN KEY (ProductID) REFERENCES digital_products(ProductID)
);

-- Downloads tracking table
CREATE TABLE IF NOT EXISTS downloads (
    DownloadID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    ProductID INT,
    DownloadDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    IPAddress VARCHAR(45),
    FOREIGN KEY (UserID) REFERENCES store_users(UserID),
    FOREIGN KEY (ProductID) REFERENCES digital_products(ProductID)
);
