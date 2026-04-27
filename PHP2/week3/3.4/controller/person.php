<?php
require_once(__DIR__ . '/role.php');

class Person {
    private $personNo;
    private $firstName;
    private $lastName;
    private $startDate;
    private $role;
    
    public function __construct($firstName, $lastName, $startDate, $role) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->startDate = $startDate;
        $this->role = $role;
        $this->personNo = null;
    }
    
    public function getPersonNo() {
        return $this->personNo;
    }
    
    public function getFirstName() {
        return $this->firstName;
    }
    
    public function getLastName() {
        return $this->lastName;
    }
    
    public function getStartDate() {
        return $this->startDate;
    }
    
    public function getRole() {
        return $this->role;
    }
    
    public function setPersonNo($personNo) {
        $this->personNo = $personNo;
    }
    
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }
    
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }
    
    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }
    
    public function setRole($role) {
        $this->role = $role;
    }
}
?>