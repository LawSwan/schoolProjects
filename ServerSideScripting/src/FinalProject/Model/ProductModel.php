<?php
require_once 'BaseModel.php';

class ProductModel extends BaseModel {
    
    public function __construct() {
        parent::__construct();
        $this->createTables();
    }
    
    private function createTables() {
        // Create products table
        $sql = "CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL UNIQUE,
            price DECIMAL(10,2) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $this->query($sql);
        
        // Create users table (personal_info)
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(50) NOT NULL,
            last_name VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $this->query($sql);
        
        // Create purchases table
        $sql = "CREATE TABLE IF NOT EXISTS purchases (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            product_id INT NOT NULL,
            quantity INT NOT NULL DEFAULT 1,
            purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
        )";
        $this->query($sql);
        
        // Insert sample data if tables are empty
        $this->insertSampleData();
    }
    
    private function insertSampleData() {
        // Check if products table is empty
        $result = $this->query("SELECT COUNT(*) as count FROM products");
        $row = mysqli_fetch_assoc($result);
        
        if ($row['count'] == 0) {
            $products = [
                ['Digital Marketing Course', 99.99],
                ['Web Development Bootcamp', 199.99],
                ['Photoshop Tutorial Pack', 49.99],
                ['Business Plan Template', 29.99],
                ['SEO Optimization Guide', 79.99]
            ];
            
            foreach ($products as $product) {
                $this->createProduct($product[0], $product[1]);
            }
        }
        
        // Check if users table is empty
        $result = $this->query("SELECT COUNT(*) as count FROM users");
        $row = mysqli_fetch_assoc($result);
        
        if ($row['count'] == 0) {
            $users = [
                ['John Doe', 'john.doe@example.com'],
                ['Jane Smith', 'jane.smith@example.com'],
                ['Bob Johnson', 'bob.johnson@example.com'],
                ['Alice Williams', 'alice.williams@example.com'],
                ['Charlie Brown', 'charlie.brown@example.com']
            ];
            
            foreach ($users as $user) {
                $this->createUser($user[0], $user[1]);
            }
        }
    }
    
    // Product methods
    public function getAllProducts() {
        $sql = "SELECT * FROM products ORDER BY name";
        $result = $this->query($sql);
        
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        
        return $products;
    }
    
    public function getProductById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM products WHERE id = $id";
        $result = $this->query($sql);
        
        return mysqli_fetch_assoc($result);
    }
    
    public function createProduct($name, $price) {
        $name = $this->escape($name);
        $price = (float)$price;
        
        $sql = "INSERT INTO products (name, price) VALUES ('$name', $price)";
        $this->query($sql);
        return $this->getLastInsertId();
    }
    
    public function updateProduct($id, $name, $price) {
        $id = (int)$id;
        $name = $this->escape($name);
        $price = (float)$price;
        
        $sql = "UPDATE products SET name='$name', price=$price WHERE id=$id";
        $this->query($sql);
        return mysqli_affected_rows($this->conn) > 0;
    }
    
    public function deleteProduct($id) {
        $id = (int)$id;
        $sql = "DELETE FROM products WHERE id=$id";
        $this->query($sql);
        return mysqli_affected_rows($this->conn) > 0;
    }
    
    // User methods
    public function getAllUsers() {
        $sql = "SELECT *, CONCAT(first_name, ' ', last_name) as name FROM users ORDER BY first_name, last_name";
        $result = $this->query($sql);
        
        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
        
        return $users;
    }
    
    public function getUserById($id) {
        $id = (int)$id;
        $sql = "SELECT *, CONCAT(first_name, ' ', last_name) as name FROM users WHERE id = $id";
        $result = $this->query($sql);
        
        return mysqli_fetch_assoc($result);
    }
    
    public function createUser($name, $email) {
        $name = $this->escape($name);
        $email = $this->escape($email);
        
        $names = explode(' ', $name, 2);
        $firstName = $this->escape($names[0]);
        $lastName = isset($names[1]) ? $this->escape($names[1]) : '';
        $email = $this->escape($email);
        $sql = "INSERT INTO users (first_name, last_name, email) VALUES ('$firstName', '$lastName', '$email')";
        $this->query($sql);
        return $this->getLastInsertId();
    }
    
    // Purchase methods
    public function getAllPurchases() {
        $sql = "SELECT p.*, CONCAT(u.first_name, ' ', u.last_name) as user_name, u.email, pr.name as product_name, pr.price
                FROM purchases p
                JOIN users u ON p.user_id = u.id
                JOIN products pr ON p.product_id = pr.id
                ORDER BY p.purchase_date DESC";
        $result = $this->query($sql);
        
        $purchases = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $purchases[] = $row;
        }
        
        return $purchases;
    }
    
    public function createPurchase($userId, $productId, $quantity = 1) {
        $userId = (int)$userId;
        $productId = (int)$productId;
        $quantity = (int)$quantity;
        
        $sql = "INSERT INTO purchases (user_id, product_id, quantity) VALUES ($userId, $productId, $quantity)";
        $this->query($sql);
        return $this->getLastInsertId();
    }
    
    public function getUsersWithPurchases() {
        $sql = "SELECT pi.*, 
                COUNT(p.id) as total_purchases,
                SUM(p.quantity * pr.price) as total_spent
                FROM users pi
                LEFT JOIN purchases p ON pi.id = p.user_id
                LEFT JOIN products pr ON p.product_id = pr.id
                GROUP BY pi.id
                ORDER BY total_spent DESC, pi.first_name, pi.last_name";
        $result = $this->query($sql);
        
        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
        
        return $users;
    }
}
?>

