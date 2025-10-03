<?php
// Configuration file for the consolidated MVC application

// Database configuration
define('DB_HOST', 'my_mysql_db');  // Use Docker container name for connection
define('DB_USERNAME', 'Amblaw');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'mydatabase_php');  // Use the database name from docker-compose

// Application configuration
// Dynamically determine base URL based on current script location
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$baseUrl = dirname($scriptName);
if ($baseUrl === '/' || $baseUrl === '\\') {
    $baseUrl = '';
}
define('BASE_URL', $baseUrl . '/');
define('APP_NAME', 'SDC310 Final Project - Lawson');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Autoloader for classes
spl_autoload_register(function ($class) {
    $directories = [
        'Controller/',
        'Model/',
        'Router/'
    ];
    
    foreach ($directories as $directory) {
        $file = __DIR__ . '/../' . $directory . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
