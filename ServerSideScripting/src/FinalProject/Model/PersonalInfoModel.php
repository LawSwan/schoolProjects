<?php
require_once 'BaseModel.php';

class PersonalInfoModel extends BaseModel {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getAll() {
        $sql = "SELECT * FROM personal_info ORDER BY name";
        $result = $this->query($sql);
        
        $people = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $people[] = $row;
        }
        
        return $people;
    }
    
    public function getById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM personal_info WHERE id = $id";
        $result = $this->query($sql);
        
        return mysqli_fetch_assoc($result);
    }
    
    public function create($name, $date_of_birth, $favorite_color, $favorite_place, $nickname, $email, $phone) {
        $name = $this->escape($name);
        $date_of_birth = $this->escape($date_of_birth);
        $favorite_color = $this->escape($favorite_color);
        $favorite_place = $this->escape($favorite_place);
        $nickname = $this->escape($nickname);
        $email = $this->escape($email);
        $phone = $this->escape($phone);
        
        $sql = "INSERT INTO personal_info (name, date_of_birth, favorite_color, favorite_place, nickname, email, phone, created_at) 
                VALUES ('$name', '$date_of_birth', '$favorite_color', '$favorite_place', '$nickname', '$email', '$phone', NOW())";
        
        $this->query($sql);
        return $this->getLastInsertId();
    }
    
    public function update($id, $name, $date_of_birth, $favorite_color, $favorite_place, $nickname, $email, $phone) {
        $id = (int)$id;
        $name = $this->escape($name);
        $date_of_birth = $this->escape($date_of_birth);
        $favorite_color = $this->escape($favorite_color);
        $favorite_place = $this->escape($favorite_place);
        $nickname = $this->escape($nickname);
        $email = $this->escape($email);
        $phone = $this->escape($phone);
        
        $sql = "UPDATE personal_info SET 
                name='$name', date_of_birth='$date_of_birth', favorite_color='$favorite_color', 
                favorite_place='$favorite_place', nickname='$nickname', email='$email', phone='$phone'
                WHERE id=$id";
        
        $this->query($sql);
        return mysqli_affected_rows($this->conn) > 0;
    }
    
    public function delete($id) {
        $id = (int)$id;
        $sql = "DELETE FROM personal_info WHERE id=$id";
        
        $this->query($sql);
        return mysqli_affected_rows($this->conn) > 0;
    }
    
    public function search($term) {
        $term = $this->escape($term);
        $sql = "SELECT * FROM personal_info 
                WHERE name LIKE '%$term%' 
                OR favorite_color LIKE '%$term%' 
                OR favorite_place LIKE '%$term%' 
                OR nickname LIKE '%$term%' 
                OR email LIKE '%$term%'
                ORDER BY name";
        
        $result = $this->query($sql);
        
        $people = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $people[] = $row;
        }
        
        return $people;
    }
}
?>

