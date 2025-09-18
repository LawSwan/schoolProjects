<?php
// Include database connection
require_once 'db_connection.php';

echo "<h2>Setting up Database for Lawson Performance Assessment</h2>";

// Create personal_info table
$createTable = "CREATE TABLE IF NOT EXISTS personal_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    date_of_birth DATE NOT NULL,
    favorite_color VARCHAR(50) NOT NULL,
    favorite_place VARCHAR(100) NOT NULL,
    nickname VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $createTable)) {
    echo "<p style='color: green;'>✓ Table 'personal_info' created successfully</p>";
} else {
    echo "<p style='color: red;'>✗ Error creating table: " . mysqli_error($conn) . "</p>";
}

// Insert sample data
$insertData = "INSERT IGNORE INTO personal_info (id, name, date_of_birth, favorite_color, favorite_place, nickname) VALUES
(1, 'John Doe', '1990-05-15', 'Blue', 'Paris', 'Johnny'),
(2, 'Jane Smith', '1985-12-08', 'Green', 'Tokyo', 'Janie'),
(3, 'Bob Johnson', '1992-03-22', 'Red', 'New York', 'Bobby')";

if (mysqli_query($conn, $insertData)) {
    echo "<p style='color: green;'>✓ Sample data inserted successfully</p>";
} else {
    echo "<p style='color: red;'>✗ Error inserting data: " . mysqli_error($conn) . "</p>";
}

mysqli_close($conn);

echo "<br><a href='Lawson_performance.php'>→ Go to Performance Assessment Application</a>";
?>
