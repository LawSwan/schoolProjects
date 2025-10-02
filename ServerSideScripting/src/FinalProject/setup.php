<?php
/**
 * Database Setup Script for SDC310 Final Project
 * This script initializes the database and creates all necessary tables
 */

require_once 'config/config.php';

// Start output buffering for clean HTML output
ob_start();

// Database setup function
function setupDatabase() {
    $messages = [];
    
    try {
        // Connect to MySQL server (without specifying database)
        $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
        
        if (!$conn) {
            throw new Exception("Connection failed: " . mysqli_connect_error());
        }
        
        $messages[] = "✅ Connected to MySQL server successfully";
        
        // Create database if it doesn't exist
        $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
        if (mysqli_query($conn, $sql)) {
            $messages[] = "✅ Database '" . DB_NAME . "' created/verified successfully";
        } else {
            throw new Exception("Error creating database: " . mysqli_error($conn));
        }
        
        // Select the database
        if (!mysqli_select_db($conn, DB_NAME)) {
            throw new Exception("Error selecting database: " . mysqli_error($conn));
        }
        
        // Create addresses table
        $sql = "CREATE TABLE IF NOT EXISTS addresses (
            AddressNo INT AUTO_INCREMENT PRIMARY KEY,
            First VARCHAR(25) NOT NULL,
            Last VARCHAR(30) NOT NULL,
            Street VARCHAR(100) NOT NULL,
            City VARCHAR(25) NOT NULL,
            State VARCHAR(2) NOT NULL,
            Zip VARCHAR(10) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        if (mysqli_query($conn, $sql)) {
            $messages[] = "✅ Addresses table created/verified successfully";
        } else {
            throw new Exception("Error creating addresses table: " . mysqli_error($conn));
        }
        
        // Create products table
        $sql = "CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL UNIQUE,
            price DECIMAL(10,2) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        if (mysqli_query($conn, $sql)) {
            $messages[] = "✅ Products table created/verified successfully";
        } else {
            throw new Exception("Error creating products table: " . mysqli_error($conn));
        }
        
        // Create users table
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(50) NOT NULL,
            last_name VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        if (mysqli_query($conn, $sql)) {
            $messages[] = "✅ Users table created/verified successfully";
        } else {
            throw new Exception("Error creating users table: " . mysqli_error($conn));
        }
        
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
        
        if (mysqli_query($conn, $sql)) {
            $messages[] = "✅ Purchases table created/verified successfully";
        } else {
            throw new Exception("Error creating purchases table: " . mysqli_error($conn));
        }
        
        // Insert sample data if tables are empty
        $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM addresses");
        $row = mysqli_fetch_assoc($result);
        
        if ($row['count'] == 0) {
            $sampleAddresses = [
                ['John', 'Doe', '123 Main St', 'Anytown', 'CA', '12345'],
                ['Jane', 'Smith', '456 Oak Ave', 'Somewhere', 'NY', '67890'],
                ['Bob', 'Johnson', '789 Pine Rd', 'Elsewhere', 'TX', '54321'],
                ['Alice', 'Williams', '321 Elm St', 'Nowhere', 'FL', '98765'],
                ['Charlie', 'Brown', '654 Maple Dr', 'Anywhere', 'WA', '13579']
            ];
            
            foreach ($sampleAddresses as $addr) {
                $sql = "INSERT INTO addresses (First, Last, Street, City, State, Zip) 
                        VALUES ('" . mysqli_real_escape_string($conn, $addr[0]) . "', 
                                '" . mysqli_real_escape_string($conn, $addr[1]) . "', 
                                '" . mysqli_real_escape_string($conn, $addr[2]) . "', 
                                '" . mysqli_real_escape_string($conn, $addr[3]) . "', 
                                '" . mysqli_real_escape_string($conn, $addr[4]) . "', 
                                '" . mysqli_real_escape_string($conn, $addr[5]) . "')";
                mysqli_query($conn, $sql);
            }
            $messages[] = "✅ Sample addresses inserted successfully";
        }
        
        // Insert sample products
        $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM products");
        $row = mysqli_fetch_assoc($result);
        
        if ($row['count'] == 0) {
            $sampleProducts = [
                ['Digital Marketing Course', 99.99],
                ['Web Development Bootcamp', 199.99],
                ['Photoshop Tutorial Pack', 49.99],
                ['Business Plan Template', 29.99],
                ['SEO Optimization Guide', 79.99]
            ];
            
            foreach ($sampleProducts as $prod) {
                $sql = "INSERT INTO products (name, price) 
                        VALUES ('" . mysqli_real_escape_string($conn, $prod[0]) . "', " . $prod[1] . ")";
                mysqli_query($conn, $sql);
            }
            $messages[] = "✅ Sample products inserted successfully";
        }
        
        // Insert sample users
        $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM users");
        $row = mysqli_fetch_assoc($result);
        
        if ($row['count'] == 0) {
            $sampleUsers = [
                ['John', 'Doe', 'john.doe@example.com'],
                ['Jane', 'Smith', 'jane.smith@example.com'],
                ['Bob', 'Johnson', 'bob.johnson@example.com'],
                ['Alice', 'Williams', 'alice.williams@example.com'],
                ['Charlie', 'Brown', 'charlie.brown@example.com']
            ];
            
            foreach ($sampleUsers as $user) {
                $sql = "INSERT INTO users (first_name, last_name, email) 
                        VALUES ('" . mysqli_real_escape_string($conn, $user[0]) . "', 
                                '" . mysqli_real_escape_string($conn, $user[1]) . "', 
                                '" . mysqli_real_escape_string($conn, $user[2]) . "')";
                mysqli_query($conn, $sql);
            }
            $messages[] = "✅ Sample users inserted successfully";
        }
        
        mysqli_close($conn);
        $messages[] = "🎉 Database setup completed successfully!";
        
        return ['success' => true, 'messages' => $messages];
        
    } catch (Exception $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

// Run setup if requested
$setupResult = null;
if (isset($_POST['setup']) || isset($_GET['auto'])) {
    $setupResult = setupDatabase();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup - SDC310 Final Project</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>SDC310 Final Project - Database Setup</h1>
            <p class="subtitle">Initialize database and create sample data</p>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Database Configuration</h2>
                    <p class="card-subtitle">Current settings from config.php</p>
                </div>
                <div class="card-body">
                    <div class="grid grid-2">
                        <div>
                            <strong>Host:</strong> <?php echo DB_HOST; ?><br>
                            <strong>Username:</strong> <?php echo DB_USERNAME; ?><br>
                            <strong>Database:</strong> <?php echo DB_NAME; ?>
                        </div>
                        <div>
                            <strong>Application:</strong> <?php echo APP_NAME; ?><br>
                            <strong>Base URL:</strong> <?php echo BASE_URL; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($setupResult): ?>
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Setup Results</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($setupResult['success']): ?>
                            <div class="alert alert-success">
                                <strong>Setup completed successfully!</strong>
                            </div>
                            <?php foreach ($setupResult['messages'] as $message): ?>
                                <div class="p-2 mb-2 bg-green-50 border-l-4 border-green-400 text-green-700">
                                    <?php echo $message; ?>
                                </div>
                            <?php endforeach; ?>
                            
                            <div class="mt-4 text-center">
                                <a href="index.php" class="btn btn-primary btn-lg">
                                    🚀 Launch Application
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-error">
                                <strong>Setup failed:</strong> <?php echo $setupResult['error']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Initialize Database</h3>
                        <p class="card-subtitle">Click the button below to set up the database and sample data</p>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <form method="POST" action="">
                                <button type="submit" name="setup" class="btn btn-primary btn-lg">
                                    🔧 Setup Database
                                </button>
                            </form>
                            
                            <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded">
                                <h4 class="font-semibold mb-2">What this will do:</h4>
                                <ul class="text-sm text-left">
                                    <li>• Create the database if it doesn't exist</li>
                                    <li>• Create all required tables (addresses, products, users, purchases)</li>
                                    <li>• Insert sample data for testing</li>
                                    <li>• Set up proper relationships and constraints</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Database Schema</h3>
                </div>
                <div class="card-body">
                    <div class="grid grid-2">
                        <div>
                            <h4 class="font-semibold mb-2">Tables Created</h4>
                            <ul class="text-sm space-y-1">
                                <li><strong>addresses:</strong> Address management (Week 3)</li>
                                <li><strong>products:</strong> Product catalog (Week 4)</li>
                                <li><strong>users:</strong> User management (Week 4)</li>
                                <li><strong>purchases:</strong> Purchase tracking (Week 4)</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2">Sample Data</h4>
                            <ul class="text-sm space-y-1">
                                <li>• 5 sample addresses</li>
                                <li>• 5 digital products</li>
                                <li>• 5 sample users</li>
                                <li>• Ready for purchase tracking</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 SDC310 Final Project - Database Setup</p>
        </div>
    </footer>
</body>
</html>

