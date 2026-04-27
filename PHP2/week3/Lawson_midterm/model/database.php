<?php
namespace Models;

class Database {
    private $host = 'localhost';
    private $username = 'sdc342midterm_user';
    private $password = 'Mjvt4W0TrNj4KHG';
    private $database = 'sdc342_wk3midterm';
    private $conn = null;
    private $error = '';

    public function getDbConn() {
        try {
            $this->conn = new \mysqli($this->host, $this->username, $this->password, $this->database);

            if ($this->conn->connect_error) {
                $this->error = $this->conn->connect_error;
                return false;
            }

            return $this->conn;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }

    public function getHost() {
        return $this->host;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDatabaseName() {
        return $this->database;
    }

    public function getError() {
        return $this->error;
    }

    public function isConnected() {
        $conn = $this->getDbConn();
        if ($conn) {
            $conn->close();
            return true;
        }
        return false;
    }
}
?>
