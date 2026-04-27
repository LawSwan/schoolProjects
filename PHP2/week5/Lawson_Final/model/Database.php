<?php
namespace Model;

class Database {
    // DB connection parameters
    private $host = 'localhost';
    private $dbname = 'sdc342_wk5final';
    private $username = 'root';
    private $password = '';

    // DB connection and error message
    private $conn;
    private $conn_error = '';

    // Constructor - connect to the DB
    public function __construct() {
        mysqli_report(MYSQLI_REPORT_OFF);

        $this->conn = mysqli_connect(
            $this->host,
            $this->username,
            $this->password,
            $this->dbname
        );

        if ($this->conn === false) {
            $this->conn_error = "Failed to connect to DB: " . mysqli_connect_error();
        }
    }

    public function __destruct() {
        if ($this->conn) {
            mysqli_close($this->conn);
        }
    }

    public function getDbConn() {
        return $this->conn;
    }

    public function getDbError() {
        return $this->conn_error;
    }

    public function isConnected() {
        return $this->conn !== false;
    }

    public function getDbName() {
        return $this->dbname;
    }

    public function getDbUser() {
        return $this->username;
    }

    public function getDbPassword() {
        return $this->password;
    }

    public function getHost() {
        return $this->host;
    }
}
