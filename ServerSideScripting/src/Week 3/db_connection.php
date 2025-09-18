<?php
//Database Connection Configuration
$hostname = "db";
$username = "Amblaw";
$password = "password";
$dbname = "mydatabase_php";

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
