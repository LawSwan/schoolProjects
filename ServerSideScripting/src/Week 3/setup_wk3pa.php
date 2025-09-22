<?php
// Setup script for sdc310_wk3pa database and table

// Database connection for setup
$hostname = "db";
$username = "Amblaw";
$password = "password";

// Create connection to MySQL server (not specific database yet)
$conn = mysqli_connect($hostname, $username, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "<h2>Setting up sdc310_wk3pa database...</h2>";

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS sdc310_wk3pa";
if (mysqli_query($conn, $sql)) {
    echo "<p>✓ Database 'sdc310_wk3pa' created successfully or already exists</p>";
} else {
    echo "<p>✗ Error creating database: " . mysqli_error($conn) . "</p>";
}

// Select the database
mysqli_select_db($conn, "sdc310_wk3pa");

// Create table with required fields
$sql = "CREATE TABLE IF NOT EXISTS personal_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    date_of_birth DATE NOT NULL,
    favorite_color VARCHAR(50) NOT NULL,
    favorite_place VARCHAR(100) NOT NULL,
    nickname VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    echo "<p>✓ Table 'personal_info' created successfully with required fields:</p>";
    echo "<ul>";
    echo "<li>name (VARCHAR 100)</li>";
    echo "<li>date_of_birth (DATE)</li>";
    echo "<li>favorite_color (VARCHAR 50)</li>";
    echo "<li>favorite_place (VARCHAR 100)</li>";
    echo "<li>nickname (VARCHAR 50)</li>";
    echo "</ul>";
} else {
    echo "<p>✗ Error creating table: " . mysqli_error($conn) . "</p>";
}

// Insert sample data
$sql = "INSERT IGNORE INTO personal_info (id, name, date_of_birth, favorite_color, favorite_place, nickname) VALUES 
    (1, 'Amber Lawson', '1995-06-15', 'Purple', 'Paris', 'AmberLaw'),
    (2, 'John Smith', '1990-03-22', 'Blue', 'Tokyo', 'Johnny'),
    (3, 'Sarah Johnson', '1988-11-08', 'Green', 'New York', 'SJ')";

if (mysqli_query($conn, $sql)) {
    echo "<p>✓ Sample data inserted successfully</p>";
} else {
    echo "<p>✗ Error inserting sample data: " . mysqli_error($conn) . "</p>";
}

mysqli_close($conn);

echo "<h3>Setup Complete!</h3>";
echo "<p><strong>Database:</strong> sdc310_wk3pa</p>";
echo "<p><strong>Table:</strong> personal_info</p>";
echo "<p><strong>Next Step:</strong> <a href='Lawson_wk3pa.php'>Access the application</a></p>";
?>
