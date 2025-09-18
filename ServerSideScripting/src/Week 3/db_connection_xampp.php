<?php
//Database Connection Configuration for Traditional XAMPP/WAMP Setup
//NOTE: For Docker setup, use the main db_connection.php file

$hostname = "localhost";  // Change from "db" for traditional setup
$username = "root";       // Default XAMPP username
$password = "";           // Default XAMPP password (empty)
$dbname = "mydatabase_php";

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
