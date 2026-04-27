<?php
session_start();
require_once(__DIR__ . '/../util/Security.php');

use Util\Security;

// Check if user is technician
Security::checkTech();

// Handle logout
if (isset($_POST['action']) && $_POST['action'] === 'logout') {
    Security::logout();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amber Lawson Final Practical</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        h2 { color: #555; }
        ul { list-style-type: disc; margin-left: 20px; }
        li { margin: 10px 0; }
        a { color: #800000; font-weight: bold; }
        input[type="submit"] { margin-top: 20px; padding: 5px 15px; }
    </style>
</head>
<body>
    <h1>Amber Lawson Final Practical</h1>
    <h2>Technician Menu</h2>

    <ul>
        <li><a href="tech_incident_management.php">Manage Incidents</a></li>
        <li><a href="tech_db_conn_status.php">View DB Status</a></li>
    </ul>

    <form method="POST">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Logout">
    </form>
</body>
</html>
