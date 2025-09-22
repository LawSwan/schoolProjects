<?php
// Database setup script for midterm
$hostname = "db";
$root_username = "root";
$root_password = "rootpassword";
$username = "Amblaw";
$password = "password";

// First connect as root to create database and grant permissions
$conn = mysqli_connect($hostname, $root_username, $root_password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql_db = "CREATE DATABASE IF NOT EXISTS sdc310_midterm";
if (mysqli_query($conn, $sql_db)) {
    echo "Database sdc310_midterm created successfully<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

// Select the database
mysqli_select_db($conn, "sdc310_midterm");

// Grant permissions to Amblaw user for this database
$grant_sql = "GRANT ALL PRIVILEGES ON sdc310_midterm.* TO '$username'@'%'";
if (mysqli_query($conn, $grant_sql)) {
    echo "Permissions granted to user $username<br>";
} else {
    echo "Error granting permissions: " . mysqli_error($conn) . "<br>";
}

// Flush privileges to make sure they take effect
mysqli_query($conn, "FLUSH PRIVILEGES");

// Create addresses table
$sql_table = "CREATE TABLE IF NOT EXISTS addresses (
    AddressNo INT AUTO_INCREMENT PRIMARY KEY,
    First VARCHAR(25) NOT NULL,
    Last VARCHAR(30) NOT NULL,
    Street VARCHAR(100) NOT NULL,
    City VARCHAR(25) NOT NULL,
    State VARCHAR(2) NOT NULL,
    Zip VARCHAR(10) NOT NULL
)";

if (mysqli_query($conn, $sql_table)) {
    echo "Table addresses created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

// Insert sample records
$sql_insert1 = "INSERT INTO addresses (First, Last, Street, City, State, Zip) 
                VALUES ('Lawson', 'Swan', '123 Main Street', 'Virginia Beach', 'VA', '23451')";

$sql_insert2 = "INSERT INTO addresses (First, Last, Street, City, State, Zip) 
                VALUES ('John', 'Doe', '456 Oak Avenue', 'Norfolk', 'VA', '23502')";

// Check if records already exist to avoid duplicates
$check_records = "SELECT COUNT(*) as count FROM addresses";
$result = mysqli_query($conn, $check_records);
$row = mysqli_fetch_assoc($result);

if ($row['count'] == 0) {
    if (mysqli_query($conn, $sql_insert1)) {
        echo "Sample record 1 inserted successfully<br>";
    } else {
        echo "Error inserting record 1: " . mysqli_error($conn) . "<br>";
    }

    if (mysqli_query($conn, $sql_insert2)) {
        echo "Sample record 2 inserted successfully<br>";
    } else {
        echo "Error inserting record 2: " . mysqli_error($conn) . "<br>";
    }
} else {
    echo "Sample records already exist<br>";
}

mysqli_close($conn);
echo "<br><a href='Lawson_MIDTERM.php'>Go to Address Management Application</a>";
?>
