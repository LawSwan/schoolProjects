<?php
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'sdc342_wk3_gp3';
    
    public function getDbConn() {
        try {
            // First try to connect without selecting a database
            $conn = new mysqli($this->host, $this->username, $this->password);
            
            if ($conn->connect_error) {
                error_log("Connection failed: " . $conn->connect_error);
                return false;
            }
            
            // Create database if it doesn't exist
            $createDbQuery = "CREATE DATABASE IF NOT EXISTS " . $this->database;
            if (!$conn->query($createDbQuery)) {
                error_log("Error creating database: " . $conn->error);
                return false;
            }
            
            // Select the database
            if (!$conn->select_db($this->database)) {
                error_log("Error selecting database: " . $conn->error);
                return false;
            }
            
            return $conn;
        } catch (Exception $e) {
            error_log("Database connection error: " . $e->getMessage());
            return false;
        }
    }
}
?>
