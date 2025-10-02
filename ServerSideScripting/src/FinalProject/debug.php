<?php
// Debug/Recovery script to help access data when main app has redirect issues
session_start();

// Include config for database access
require_once 'config/config.php';

echo "<!DOCTYPE html>";
echo "<html><head><title>Debug/Recovery Access</title>";
echo "<style>body{font-family:Arial,sans-serif;margin:40px;} .section{margin:20px 0;padding:20px;border:1px solid #ccc;} .data{background:#f5f5f5;padding:10px;margin:10px 0;}</style>";
echo "</head><body>";

echo "<h1>Debug/Recovery Access</h1>";
echo "<p>This page helps you access your data when the main application has redirect issues.</p>";

// Show current session data
echo "<div class='section'>";
echo "<h2>Current Session Data</h2>";
if (!empty($_SESSION)) {
    echo "<div class='data'>";
    echo "<pre>" . print_r($_SESSION, true) . "</pre>";
    echo "</div>";
} else {
    echo "<p>No session data found.</p>";
}
echo "</div>";

// Show current cookies
echo "<div class='section'>";
echo "<h2>Current Cookies</h2>";
if (!empty($_COOKIE)) {
    echo "<div class='data'>";
    echo "<pre>" . print_r($_COOKIE, true) . "</pre>";
    echo "</div>";
} else {
    echo "<p>No cookies found.</p>";
}
echo "</div>";

// Database connection test
echo "<div class='section'>";
echo "<h2>Database Connection Test</h2>";
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color:green;'>✓ Database connection successful!</p>";
    
    // Show available tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (!empty($tables)) {
        echo "<h3>Available Tables:</h3>";
        echo "<ul>";
        foreach ($tables as $table) {
            echo "<li>$table</li>";
        }
        echo "</ul>";
    }
    
} catch (Exception $e) {
    echo "<p style='color:red;'>✗ Database connection failed: " . $e->getMessage() . "</p>";
}
echo "</div>";

// Direct access links
echo "<div class='section'>";
echo "<h2>Direct Access Links</h2>";
echo "<p>Try these direct links to access different parts of your application:</p>";
echo "<ul>";
echo "<li><a href='index.php'>Main Application (index.php)</a></li>";
echo "<li><a href='index.php?page=dashboard'>Dashboard</a></li>";
echo "<li><a href='index.php?page=week2'>Week 2 - Forms</a></li>";
echo "<li><a href='index.php?page=week3'>Week 3 - Addresses</a></li>";
echo "<li><a href='index.php?page=week4'>Week 4 - Products</a></li>";
echo "<li><a href='index.php?page=week5'>Week 5 - Sessions</a></li>";
echo "<li><a href='index.php?page=personal_info'>Personal Info</a></li>";
echo "</ul>";
echo "</div>";

// Clear session option
echo "<div class='section'>";
echo "<h2>Recovery Options</h2>";
echo "<p>If you're still having issues, you can try:</p>";
echo "<ul>";
echo "<li><a href='?clear_session=1' onclick='return confirm(\"Clear all session data?\")'>Clear Session Data</a></li>";
echo "<li><a href='?clear_cookies=1' onclick='return confirm(\"Clear all cookies?\")'>Clear Cookies</a></li>";
echo "</ul>";

// Handle clear requests
if (isset($_GET['clear_session'])) {
    session_destroy();
    session_start();
    echo "<p style='color:green;'>Session data cleared! <a href='debug.php'>Refresh page</a></p>";
}

if (isset($_GET['clear_cookies'])) {
    foreach ($_COOKIE as $name => $value) {
        setcookie($name, '', time() - 3600, '/');
    }
    echo "<p style='color:green;'>Cookies cleared! <a href='debug.php'>Refresh page</a></p>";
}

echo "</div>";

echo "<div class='section'>";
echo "<h2>Server Information</h2>";
echo "<div class='data'>";
echo "<strong>PHP Version:</strong> " . PHP_VERSION . "<br>";
echo "<strong>Server Software:</strong> " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "<br>";
echo "<strong>Document Root:</strong> " . ($_SERVER['DOCUMENT_ROOT'] ?? 'Unknown') . "<br>";
echo "<strong>Script Name:</strong> " . ($_SERVER['SCRIPT_NAME'] ?? 'Unknown') . "<br>";
echo "<strong>Request URI:</strong> " . ($_SERVER['REQUEST_URI'] ?? 'Unknown') . "<br>";
echo "<strong>Base URL (calculated):</strong> " . BASE_URL . "<br>";
echo "</div>";
echo "</div>";

echo "</body></html>";
?>

