<?php
// Simple data access script - bypasses MVC to avoid redirect issues
session_start();

// Database configuration (hardcoded to avoid config issues)
$host = 'my_mysql_db';
$username = 'Amblaw';
$password = 'password';
$database = 'mydatabase_php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Data Access</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .section { margin: 20px 0; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
        .data-table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        .data-table th, .data-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .data-table th { background-color: #f2f2f2; }
        .success { color: green; background: #d4edda; padding: 10px; border-radius: 4px; }
        .error { color: red; background: #f8d7da; padding: 10px; border-radius: 4px; }
        .btn { background: #007bff; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px; display: inline-block; margin: 5px; }
        .btn:hover { background: #0056b3; }
        .form-group { margin: 10px 0; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔓 Simple Data Access</h1>
        <p>This page provides direct access to your data without going through the MVC routing system.</p>

        <?php
        // Database connection
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<div class='success'>✓ Database connected successfully!</div>";
        } catch (Exception $e) {
            echo "<div class='error'>✗ Database connection failed: " . $e->getMessage() . "</div>";
            echo "<p>Please check your database configuration or make sure your Docker containers are running.</p>";
            exit;
        }

        // Handle form submissions
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            
            if ($action === 'add_person') {
                $name = $_POST['name'] ?? '';
                $email = $_POST['email'] ?? '';
                $phone = $_POST['phone'] ?? '';
                
                if ($name && $email) {
                    try {
                        $stmt = $pdo->prepare("INSERT INTO personal_info (name, email, phone) VALUES (?, ?, ?)");
                        $stmt->execute([$name, $email, $phone]);
                        echo "<div class='success'>✓ Person added successfully!</div>";
                    } catch (Exception $e) {
                        echo "<div class='error'>✗ Error adding person: " . $e->getMessage() . "</div>";
                    }
                }
            }
            
            if ($action === 'delete_person') {
                $id = $_POST['id'] ?? '';
                if ($id) {
                    try {
                        $stmt = $pdo->prepare("DELETE FROM personal_info WHERE id = ?");
                        $stmt->execute([$id]);
                        echo "<div class='success'>✓ Person deleted successfully!</div>";
                    } catch (Exception $e) {
                        echo "<div class='error'>✗ Error deleting person: " . $e->getMessage() . "</div>";
                    }
                }
            }
        }
        ?>

        <!-- Show available tables -->
        <div class="section">
            <h2>📊 Available Database Tables</h2>
            <?php
            try {
                $stmt = $pdo->query("SHOW TABLES");
                $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
                if (!empty($tables)) {
                    echo "<p>Found " . count($tables) . " tables:</p>";
                    echo "<ul>";
                    foreach ($tables as $table) {
                        echo "<li><strong>$table</strong></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No tables found in database.</p>";
                }
            } catch (Exception $e) {
                echo "<div class='error'>Error fetching tables: " . $e->getMessage() . "</div>";
            }
            ?>
        </div>

        <!-- Personal Info Data -->
        <div class="section">
            <h2>👥 Personal Information Data</h2>
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM personal_info ORDER BY id DESC");
                $people = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (!empty($people)) {
                    echo "<table class='data-table'>";
                    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th></tr>";
                    foreach ($people as $person) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($person['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($person['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($person['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($person['phone'] ?? '') . "</td>";
                        echo "<td>";
                        echo "<form method='post' style='display:inline;' onsubmit='return confirm(\"Delete this person?\");'>";
                        echo "<input type='hidden' name='action' value='delete_person'>";
                        echo "<input type='hidden' name='id' value='" . $person['id'] . "'>";
                        echo "<button type='submit' class='btn' style='background:red;'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No personal information records found.</p>";
                }
            } catch (Exception $e) {
                echo "<div class='error'>Error fetching personal info: " . $e->getMessage() . "</div>";
            }
            ?>

            <!-- Add new person form -->
            <h3>Add New Person</h3>
            <form method="post">
                <input type="hidden" name="action" value="add_person">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Phone:</label>
                    <input type="text" name="phone">
                </div>
                <button type="submit" class="btn">Add Person</button>
            </form>
        </div>

        <!-- Address Data -->
        <div class="section">
            <h2>🏠 Address Data</h2>
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM addresses ORDER BY id DESC");
                $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (!empty($addresses)) {
                    echo "<table class='data-table'>";
                    echo "<tr><th>ID</th><th>Street</th><th>City</th><th>State</th><th>Zip</th><th>Country</th></tr>";
                    foreach ($addresses as $address) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($address['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($address['street']) . "</td>";
                        echo "<td>" . htmlspecialchars($address['city']) . "</td>";
                        echo "<td>" . htmlspecialchars($address['state']) . "</td>";
                        echo "<td>" . htmlspecialchars($address['zip']) . "</td>";
                        echo "<td>" . htmlspecialchars($address['country']) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No address records found.</p>";
                }
            } catch (Exception $e) {
                echo "<div class='error'>Error fetching addresses: " . $e->getMessage() . "</div>";
            }
            ?>
        </div>

        <!-- Products Data -->
        <div class="section">
            <h2>🛍️ Products Data</h2>
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC LIMIT 20");
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (!empty($products)) {
                    echo "<table class='data-table'>";
                    echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Category</th><th>Description</th></tr>";
                    foreach ($products as $product) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($product['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['name']) . "</td>";
                        echo "<td>$" . htmlspecialchars($product['price']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['category_id']) . "</td>";
                        echo "<td>" . htmlspecialchars(substr($product['description'], 0, 100)) . "...</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No product records found.</p>";
                }
            } catch (Exception $e) {
                echo "<div class='error'>Error fetching products: " . $e->getMessage() . "</div>";
            }
            ?>
        </div>

        <!-- Session and Cookie Info -->
        <div class="section">
            <h2>🔐 Session & Cookie Data</h2>
            <h3>Session Data:</h3>
            <?php if (!empty($_SESSION)): ?>
                <pre><?php print_r($_SESSION); ?></pre>
            <?php else: ?>
                <p>No session data found.</p>
            <?php endif; ?>

            <h3>Cookie Data:</h3>
            <?php if (!empty($_COOKIE)): ?>
                <pre><?php print_r($_COOKIE); ?></pre>
            <?php else: ?>
                <p>No cookies found.</p>
            <?php endif; ?>
        </div>

        <!-- Navigation -->
        <div class="section">
            <h2>🔗 Try Main Application</h2>
            <p>Once you've accessed your data here, you can try these links to the main application:</p>
            <a href="index.php" class="btn">Main Application</a>
            <a href="index.php?page=dashboard" class="btn">Dashboard</a>
            <a href="index.php?page=personal_info" class="btn">Personal Info (MVC)</a>
            <a href="debug.php" class="btn">Debug Script</a>
        </div>
    </div>
</body>
</html>
