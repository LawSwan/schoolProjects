<?php
// Include database connection
require_once 'db_connection.php';

// Create userinfo table
$createTable = "CREATE TABLE IF NOT EXISTS userinfo (
    UserNo INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    EMail VARCHAR(100),
    FavoriteNum INT
)";

if (mysqli_query($conn, $createTable)) {
    echo "Table 'userinfo' created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

// Insert sample data
$insertData = "INSERT INTO userinfo (FirstName, LastName, EMail, FavoriteNum) VALUES
('John', 'Doe', 'john.doe@email.com', 42),
('Jane', 'Smith', 'jane.smith@email.com', 7),
('Bob', 'Johnson', 'bob.johnson@email.com', 15),
('Alice', 'Brown', 'alice.brown@email.com', 23),
('Charlie', 'Wilson', 'charlie.wilson@email.com', 88)";

if (mysqli_query($conn, $insertData)) {
    echo "Sample data inserted successfully<br>";
} else {
    echo "Error inserting data: " . mysqli_error($conn) . "<br>";
}

mysqli_close($conn);

echo "<br><a href='connectdb.php'>View User Table</a>";
?>
