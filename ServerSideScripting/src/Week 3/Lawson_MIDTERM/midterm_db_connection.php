<?php
// Database connection for midterm
$hostname = "db";
$username = "Amblaw";
$password = "password";
$dbname = "sdc310_midterm";

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if (!$conn) {
    // If connection to specific database fails, try connecting without database specified
    $conn_test = mysqli_connect($hostname, $username, $password);
    if (!$conn_test) {
        die("Connection failed: " . mysqli_connect_error() . "<br>Please run the setup script first.");
    } else {
        die("Database 'sdc310_midterm' not found. Please run the setup script first.<br><a href='midterm_setup.php'>Run Setup</a>");
    }
}
?>
