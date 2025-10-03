<?php
require_once 'BaseModel.php';

class AddressModel extends BaseModel {
    
    public function __construct() {
        parent::__construct();
        $this->createTable();
    }
    
    private function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS addresses (
            AddressNo INT AUTO_INCREMENT PRIMARY KEY,
            First VARCHAR(25) NOT NULL,
            Last VARCHAR(30) NOT NULL,
            Street VARCHAR(100) NOT NULL,
            City VARCHAR(25) NOT NULL,
            State VARCHAR(2) NOT NULL,
            Zip VARCHAR(10) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        $this->query($sql);
        
        // Insert sample data if table is empty
        $result = $this->query("SELECT COUNT(*) as count FROM addresses");
        $row = mysqli_fetch_assoc($result);
        
        if ($row['count'] == 0) {
            $this->insertSampleData();
        }
    }
    
    private function insertSampleData() {
        $sampleData = [
            ['John', 'Doe', '123 Main St', 'Anytown', 'CA', '12345'],
            ['Jane', 'Smith', '456 Oak Ave', 'Somewhere', 'NY', '67890'],
            ['Bob', 'Johnson', '789 Pine Rd', 'Elsewhere', 'TX', '54321'],
            ['Alice', 'Williams', '321 Elm St', 'Nowhere', 'FL', '98765'],
            ['Charlie', 'Brown', '654 Maple Dr', 'Anywhere', 'WA', '13579']
        ];
        
        foreach ($sampleData as $data) {
            $this->create($data[0], $data[1], $data[2], $data[3], $data[4], $data[5]);
        }
    }
    
    public function getAll() {
        $sql = "SELECT * FROM addresses ORDER BY Last, First";
        $result = $this->query($sql);
        
        $addresses = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $addresses[] = $row;
        }
        
        return $addresses;
    }
    
    public function getById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM addresses WHERE AddressNo = $id";
        $result = $this->query($sql);
        
        return mysqli_fetch_assoc($result);
    }
    
    public function create($first, $last, $street, $city, $state, $zip) {
        $first = $this->escape($first);
        $last = $this->escape($last);
        $street = $this->escape($street);
        $city = $this->escape($city);
        $state = $this->escape($state);
        $zip = $this->escape($zip);
        
        $sql = "INSERT INTO addresses (First, Last, Street, City, State, Zip) 
                VALUES ('$first', '$last', '$street', '$city', '$state', '$zip')";
        
        $this->query($sql);
        return $this->getLastInsertId();
    }
    
    public function update($id, $first, $last, $street, $city, $state, $zip) {
        $id = (int)$id;
        $first = $this->escape($first);
        $last = $this->escape($last);
        $street = $this->escape($street);
        $city = $this->escape($city);
        $state = $this->escape($state);
        $zip = $this->escape($zip);
        
        $sql = "UPDATE addresses SET 
                First='$first', Last='$last', Street='$street', 
                City='$city', State='$state', Zip='$zip' 
                WHERE AddressNo=$id";
        
        $this->query($sql);
        return mysqli_affected_rows($this->conn) > 0;
    }
    
    public function delete($id) {
        $id = (int)$id;
        $sql = "DELETE FROM addresses WHERE AddressNo=$id";
        
        $this->query($sql);
        return mysqli_affected_rows($this->conn) > 0;
    }
    
    public function search($term) {
        $term = $this->escape($term);
        $sql = "SELECT * FROM addresses 
                WHERE First LIKE '%$term%' 
                OR Last LIKE '%$term%' 
                OR Street LIKE '%$term%' 
                OR City LIKE '%$term%' 
                OR State LIKE '%$term%' 
                OR Zip LIKE '%$term%'
                ORDER BY Last, First";
        
        $result = $this->query($sql);
        
        $addresses = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $addresses[] = $row;
        }
        
        return $addresses;
    }
}
?>

