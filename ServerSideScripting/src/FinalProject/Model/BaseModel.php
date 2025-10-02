<?php
class BaseModel {
    protected $conn;
    
    public function __construct() {
        $this->connect();
    }
    
    private function connect() {
        $this->conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
    
    protected function query($sql) {
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            throw new Exception("Query failed: " . mysqli_error($this->conn));
        }
        return $result;
    }
    
    protected function escape($string) {
        return mysqli_real_escape_string($this->conn, $string);
    }
    
    protected function getLastInsertId() {
        return mysqli_insert_id($this->conn);
    }
    
    public function __destruct() {
        if ($this->conn) {
            mysqli_close($this->conn);
        }
    }
}
