<?php
session_start();
require_once(__DIR__ . '/../util/Security.php');
require_once(__DIR__ . '/../model/Database.php');

use Util\Security;
use Model\Database;

// Check if user is technician
Security::checkTech();

// Handle logout
if (isset($_POST['action']) && $_POST['action'] === 'logout') {
    Security::logout();
}

// Create database connection to check status
$db = new Database();
$isConnected = $db->isConnected();
$dbError = $db->getDbError();
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
        li { margin: 5px 0; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .nav-links { margin-top: 20px; }
        .nav-links a { margin-right: 15px; color: #800000; font-weight: bold; }
        input[type="submit"] { padding: 5px 15px; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>Amber Lawson Final Practical</h1>
    <h2>Database Connection Status</h2>

    <ul>
        <li>Database Name: <?php echo htmlspecialchars($db->getDbName()); ?></li>
        <li>Database User: <?php echo htmlspecialchars($db->getDbUser()); ?></li>
        <li>Database User Password: <?php echo htmlspecialchars($db->getDbPassword()); ?></li>
    </ul>

    <?php if ($isConnected): ?>
        <p class="success">Connection Successful</p>
    <?php else: ?>
        <p class="error">Connection Failed</p>
        <p class="error"><?php echo htmlspecialchars($dbError); ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Logout">
    </form>

    <div class="nav-links">
        <a href="tech.php">Home</a>
    </div>
</body>
</html>
