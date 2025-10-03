<?php
// Direct database access - completely standalone
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Direct Data Access</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 1000px; margin: 0 auto; }
        .section { background: #f9f9f9; padding: 15px; margin: 15px 0; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #e9e9e9; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; }
        .btn { background: #007bff; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔓 Direct Database Access</h1>
        <p><strong>This page accesses your data directly without any routing or redirects.</strong></p>

        <?php
        // Database connection parameters
        $host = 'my_mysql_db';
        $dbname = 'mydatabase_php';
        $username = 'Amblaw';
        $password = 'password';

        echo "<div class='section'>";
        echo "<h2>🔌 Connection Test</h2>";
        
        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
            $pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            echo "<div class='success'>✅ Successfully connected to database!</div>";
        } catch (PDOException $e) {
            echo "<div class='error'>❌ Database connection failed: " . htmlspecialchars($e->getMessage()) . "</div>";
            echo "<p><strong>Troubleshooting:</strong></p>";
            echo "<ul>";
            echo "<li>Make sure your Docker containers are running: <code>docker-compose up -d</code></li>";
            echo "<li>Check if the MySQL container is healthy</li>";
            echo "<li>Verify database credentials in docker-compose.yml</li>";
            echo "</ul>";
            echo "</div></body></html>";
            exit;
        }
        echo "</div>";

        // Show all tables
        echo "<div class='section'>";
        echo "<h2>📊 Database Tables</h2>";
        try {
            $stmt = $pdo->query("SHOW TABLES");
            $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
            echo "<p>Found " . count($tables) . " tables:</p>";
            echo "<ul>";
            foreach ($tables as $table) {
                echo "<li><strong>" . htmlspecialchars($table) . "</strong></li>";
            }
            echo "</ul>";
        } catch (Exception $e) {
            echo "<div class='error'>Error getting tables: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
        echo "</div>";

        // Personal Info Table
        echo "<div class='section'>";
        echo "<h2>👥 Personal Information</h2>";
        try {
            $stmt = $pdo->query("SELECT * FROM personal_info ORDER BY id DESC");
            $records = $stmt->fetchAll();
            
            if ($records) {
                echo "<table>";
                echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Created</th></tr>";
                foreach ($records as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['name'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['email'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['phone'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['created_at'] ?? '') . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "<p><strong>Total records: " . count($records) . "</strong></p>";
            } else {
                echo "<p>No records found in personal_info table.</p>";
            }
        } catch (Exception $e) {
            echo "<div class='error'>Error accessing personal_info: " . htmlspecialchars($e->getMessage()) . "</div>";
            echo "<p>The table might not exist yet. Try running the setup script.</p>";
        }
        echo "</div>";

        // Addresses Table
        echo "<div class='section'>";
        echo "<h2>🏠 Addresses</h2>";
        try {
            $stmt = $pdo->query("SELECT * FROM addresses ORDER BY id DESC LIMIT 20");
            $records = $stmt->fetchAll();
            
            if ($records) {
                echo "<table>";
                echo "<tr><th>ID</th><th>Street</th><th>City</th><th>State</th><th>Zip</th><th>Country</th></tr>";
                foreach ($records as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['street'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['city'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['state'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['zip'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['country'] ?? '') . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "<p><strong>Total records: " . count($records) . "</strong></p>";
            } else {
                echo "<p>No records found in addresses table.</p>";
            }
        } catch (Exception $e) {
            echo "<div class='error'>Error accessing addresses: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
        echo "</div>";

        // Products Table
        echo "<div class='section'>";
        echo "<h2>🛍️ Products</h2>";
        try {
            $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC LIMIT 20");
            $records = $stmt->fetchAll();
            
            if ($records) {
                echo "<table>";
                echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Category ID</th><th>Description</th></tr>";
                foreach ($records as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['name'] ?? '') . "</td>";
                    echo "<td>$" . htmlspecialchars($row['price'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['category_id'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars(substr($row['description'] ?? '', 0, 100)) . "...</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "<p><strong>Total records shown: " . count($records) . "</strong></p>";
            } else {
                echo "<p>No records found in products table.</p>";
            }
        } catch (Exception $e) {
            echo "<div class='error'>Error accessing products: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
        echo "</div>";

        // Session Data
        echo "<div class='section'>";
        echo "<h2>🔐 Session Data</h2>";
        if (!empty($_SESSION)) {
            echo "<pre>" . htmlspecialchars(print_r($_SESSION, true)) . "</pre>";
        } else {
            echo "<p>No session data found.</p>";
        }
        echo "</div>";

        // Cookie Data
        echo "<div class='section'>";
        echo "<h2>🍪 Cookie Data</h2>";
        if (!empty($_COOKIE)) {
            echo "<pre>" . htmlspecialchars(print_r($_COOKIE, true)) . "</pre>";
        } else {
            echo "<p>No cookies found.</p>";
        }
        echo "</div>";

        // Quick Actions
        echo "<div class='section'>";
        echo "<h2>🔧 Quick Actions</h2>";
        echo "<p>Try these files:</p>";
        echo "<a href='test.php' class='btn'>Basic PHP Test</a> ";
        echo "<a href='setup.php' class='btn'>Database Setup</a> ";
        echo "<a href='index.php?page=dashboard' class='btn'>Try Main App</a>";
        echo "</div>";
        ?>
    </div>
</body>
</html>
