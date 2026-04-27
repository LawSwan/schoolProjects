-- Database: sdc342_wk3pa
-- User: sdc342pa_user
-- Password: Mjvt4W0TrNj4KHG

CREATE DATABASE IF NOT EXISTS sdc342_wk3pa;
USE sdc342_wk3pa;

-- Create user and grant permissions
CREATE USER IF NOT EXISTS 'sdc342pa_user'@'localhost' IDENTIFIED BY 'Mjvt4W0TrNj4KHG';
GRANT ALL PRIVILEGES ON sdc342_wk3pa.* TO 'sdc342pa_user'@'localhost';
FLUSH PRIVILEGES;

-- Create categories table
CREATE TABLE IF NOT EXISTS categories (
    CategoryNo INT PRIMARY KEY AUTO_INCREMENT,
    CategoryName VARCHAR(50) NOT NULL
);

-- Create products table
CREATE TABLE IF NOT EXISTS products (
    ProductNo INT PRIMARY KEY AUTO_INCREMENT,
    ProductCode VARCHAR(20) NOT NULL,
    ProductName VARCHAR(100) NOT NULL,
    CategoryNo INT NOT NULL,
    ProductPrice DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (CategoryNo) REFERENCES categories(CategoryNo)
);

-- Insert categories
INSERT INTO categories (CategoryName) VALUES
('Clothing'),
('Electronics'),
('Furnishings'),
('Shoes');

-- Insert sample products
INSERT INTO products (ProductCode, ProductName, CategoryNo, ProductPrice) VALUES
('FS541BRL', 'Brown Leather Sofa', 3, 351.75),
('CS09870RC', 'Red Cotton Shirt', 1, 21.35),
('S89468GH', 'Green Leather High Heels', 4, 179.58),
('CB15470BRS', 'Brown Silk Blouse', 1, 59.99),
('ET5843SL54', 'Sony 54 inch LCD TV', 2, 999.99),
('S99183BPL', 'Black Patent Leather Loafer', 4, 127.31),
('EC239847HP', 'HP Laptop Model 239847', 2, 1399.99),
('FR6238TS', 'Tan Suede Rocker Recliner', 3, 221.10);
