<?php
// Quick setup for traditional XAMPP/WAMP environments
// Run this file ONCE to set up the database if not using Docker

// For traditional setup, use the XAMPP connection
$hostname = "localhost";
$username = "root";
$password = "";

// Create connection to MySQL server (not specific database yet)
$conn = mysqli_connect($hostname, $username, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "<h2>Setting up database for traditional environment...</h2>";

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS mydatabase_php";
if (mysqli_query($conn, $sql)) {
    echo "<p>✓ Database 'mydatabase_php' created successfully or already exists</p>";
} else {
    echo "<p>✗ Error creating database: " . mysqli_error($conn) . "</p>";
}

// Select the database
mysqli_select_db($conn, "mydatabase_php");

// Create table
$sql = "CREATE TABLE IF NOT EXISTS personal_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    birth_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    echo "<p>✓ Table 'personal_info' created successfully or already exists</p>";
} else {
    echo "<p>✗ Error creating table: " . mysqli_error($conn) . "</p>";
}

mysqli_close($conn);

echo "<h3>Setup Complete!</h3>";
echo "<p><strong>Next Steps:</strong></p>";
echo "<ol>";
echo "<li>If you're using XAMPP/WAMP, edit <code>Week 3/Lawson_performance.php</code></li>";
echo "<li>Change line 108 from: <code>require_once 'db_connection.php';</code></li>";
echo "<li>To: <code>require_once 'db_connection_xampp.php';</code></li>";
echo "<li>Then access: <a href='Lawson_performance.php'>Lawson_performance.php</a></li>";
echo "</ol>";
?>
