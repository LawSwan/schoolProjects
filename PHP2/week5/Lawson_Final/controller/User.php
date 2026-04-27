<?php
namespace Controller;

class User {
    private $userNo;
    private $userId;
    private $password;
    private $firstName;
    private $lastName;
    private $hireDate;
    private $email;
    private $extension;
    private $userLevelNo;
    private $levelName;

    public function __construct(
        $userId = null,
        $password = null,
        $firstName = null,
        $lastName = null,
        $hireDate = null,
        $email = null,
        $extension = null,
        $userLevelNo = null,
        $levelName = null,
        $userNo = null
    ) {
        $this->userNo = $userNo;
        $this->userId = $userId;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->hireDate = $hireDate;
        $this->email = $email;
        $this->extension = $extension;
        $this->userLevelNo = $userLevelNo;
        $this->levelName = $levelName;
    }

    // Getters
    public function getUserNo() { return $this->userNo; }
    public function getUserId() { return $this->userId; }
    public function getPassword() { return $this->password; }
    public function getFirstName() { return $this->firstName; }
    public function getLastName() { return $this->lastName; }
    public function getHireDate() { return $this->hireDate; }
    public function getEmail() { return $this->email; }
    public function getExtension() { return $this->extension; }
    public function getUserLevelNo() { return $this->userLevelNo; }
    public function getLevelName() { return $this->levelName; }

    // Setters
    public function setUserNo($value) { $this->userNo = $value; }
    public function setUserId($value) { $this->userId = $value; }
    public function setPassword($value) { $this->password = $value; }
    public function setFirstName($value) { $this->firstName = $value; }
    public function setLastName($value) { $this->lastName = $value; }
    public function setHireDate($value) { $this->hireDate = $value; }
    public function setEmail($value) { $this->email = $value; }
    public function setExtension($value) { $this->extension = $value; }
    public function setUserLevelNo($value) { $this->userLevelNo = $value; }
    public function setLevelName($value) { $this->levelName = $value; }
}
