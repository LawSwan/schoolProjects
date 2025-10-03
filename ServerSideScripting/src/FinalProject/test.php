<?php
// Simple test file to check if PHP is working
echo "<h1>PHP Test</h1>";
echo "<p>Current time: " . date('Y-m-d H:i:s') . "</p>";
echo "<p>PHP Version: " . PHP_VERSION . "</p>";
echo "<p>If you can see this, PHP is working!</p>";

// Test if we can access the simple_access.php file
echo "<p><a href='simple_access.php'>Try Simple Access</a></p>";
echo "<p><a href='debug.php'>Try Debug Script</a></p>";

// Show current directory and files
echo "<h2>Current Directory Info:</h2>";
echo "<p>Current directory: " . __DIR__ . "</p>";
echo "<p>Files in this directory:</p>";
echo "<ul>";
$files = scandir(__DIR__);
foreach ($files as $file) {
    if ($file !== '.' && $file !== '..') {
        echo "<li>$file</li>";
    }
}
echo "</ul>";
?>
