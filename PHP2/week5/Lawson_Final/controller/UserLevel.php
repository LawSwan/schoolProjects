<?php
namespace Controller;

class UserLevel {
    private $userLevelNo;
    private $levelName;

    public function __construct($userLevelNo = null, $levelName = null) {
        $this->userLevelNo = $userLevelNo;
        $this->levelName = $levelName;
    }

    // Getters
    public function getUserLevelNo() { return $this->userLevelNo; }
    public function getLevelName() { return $this->levelName; }

    // Setters
    public function setUserLevelNo($value) { $this->userLevelNo = $value; }
    public function setLevelName($value) { $this->levelName = $value; }
}
