<?php
// Setup script for Digital Products Store
// Creates database and tables with sample data

$hostname = "db";
$root_username = "root";
$root_password = "rootpassword";
$username = "Amblaw";
$password = "password";

echo "<h1>Digital Products Store - Database Setup</h1>";
echo "<p>Setting up your digital products marketplace database...</p>";

// Connect as root to create database and grant permissions
$conn = mysqli_connect($hostname, $root_username, $root_password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Read and execute schema file
$schema_sql = file_get_contents('database_schema.sql');
$schema_queries = explode(';', $schema_sql);

echo "<h3>Creating Database Schema...</h3>";
foreach ($schema_queries as $query) {
    $query = trim($query);
    if (!empty($query)) {
        if (mysqli_query($conn, $query)) {
            echo "✓ Query executed successfully<br>";
        } else {
            echo "✗ Error: " . mysqli_error($conn) . "<br>";
        }
    }
}

// Grant permissions to user
$grant_sql = "GRANT ALL PRIVILEGES ON digital_products_store.* TO '$username'@'%'";
if (mysqli_query($conn, $grant_sql)) {
    echo "✓ Permissions granted to user $username<br>";
} else {
    echo "✗ Error granting permissions: " . mysqli_error($conn) . "<br>";
}

mysqli_query($conn, "FLUSH PRIVILEGES");

// Switch to the new database
mysqli_select_db($conn, "digital_products_store");

// Check if data already exists
$check_data = mysqli_query($conn, "SELECT COUNT(*) as count FROM digital_products");
$data_exists = false;
if ($check_data) {
    $row = mysqli_fetch_assoc($check_data);
    $data_exists = ($row['count'] > 0);
}

if (!$data_exists) {
    // Read and execute sample data
    $data_sql = file_get_contents('sample_data.sql');
    $data_queries = explode(';', $data_sql);

    echo "<h3>Inserting Sample Data...</h3>";
    foreach ($data_queries as $query) {
        $query = trim($query);
        if (!empty($query)) {
            if (mysqli_query($conn, $query)) {
                echo "✓ Sample data inserted<br>";
            } else {
                echo "✗ Error: " . mysqli_error($conn) . "<br>";
            }
        }
    }
} else {
    echo "<h3>Sample Data Already Exists</h3>";
    echo "<p>Skipping data insertion to avoid duplicates.</p>";
}

mysqli_close($conn);

echo "<h3>Setup Complete!</h3>";
echo "<p>Your Digital Products Store database is ready!</p>";
echo "<div style='margin: 20px 0; padding: 15px; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px;'>";
echo "<strong>Database:</strong> digital_products_store<br>";
echo "<strong>Tables Created:</strong><br>";
echo "• store_users (customer accounts)<br>";
echo "• categories (product categories)<br>";
echo "• digital_products (your products)<br>";
echo "• orders (customer orders)<br>";
echo "• order_items (order details)<br>";
echo "• downloads (download tracking)<br>";
echo "</div>";

echo "<p><a href='index.php' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Launch Store</a></p>";
?>
