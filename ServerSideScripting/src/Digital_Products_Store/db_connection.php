<?php
// Database connection for Digital Products Store
// Separate from class assignments

$hostname = "db";
$username = "Amblaw";
$password = "password";
$dbname = "digital_products_store";

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if (!$conn) {
    // If connection to specific database fails, try connecting without database specified
    $conn_test = mysqli_connect($hostname, $username, $password);
    if (!$conn_test) {
        die("Connection failed: " . mysqli_connect_error() . "<br>Please check your database configuration.");
    } else {
        die("Database 'digital_products_store' not found. Please run the setup script first.<br><a href='setup.php'>Run Setup</a>");
    }
}

// Set charset to handle special characters
mysqli_set_charset($conn, "utf8");
?>
