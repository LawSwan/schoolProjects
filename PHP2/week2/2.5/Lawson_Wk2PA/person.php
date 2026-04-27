<?php
class Person {
    // Private properties
    private $firstName;
    private $lastName;
    private $addressLine1;
    private $addressLine2;
    private $city;
    private $state;
    private $zipCode;
    
    // Constructor with parameters to set all properties
    public function __construct($firstName, $lastName, $addressLine1, $addressLine2, $city, $state, $zipCode) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->addressLine1 = $addressLine1;
        $this->addressLine2 = $addressLine2;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
    }
    
    // Getter methods
    public function getFirstName() {
        return $this->firstName;
    }
    
    public function getLastName() {
        return $this->lastName;
    }
    
    public function getAddressLine1() {
        return $this->addressLine1;
    }
    
    public function getAddressLine2() {
        return $this->addressLine2;
    }
    
    public function getCity() {
        return $this->city;
    }
    
    public function getState() {
        return $this->state;
    }
    
    public function getZipCode() {
        return $this->zipCode;
    }
    
    // Setter methods
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }
    
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }
    
    public function setAddressLine1($addressLine1) {
        $this->addressLine1 = $addressLine1;
    }
    
    public function setAddressLine2($addressLine2) {
        $this->addressLine2 = $addressLine2;
    }
    
    public function setCity($city) {
        $this->city = $city;
    }
    
    public function setState($state) {
        $this->state = $state;
    }
    
    public function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
    }
    
    // Function to return formatted name as "Last, First"
    public function getFormattedName() {
        return $this->lastName . ", " . $this->firstName;
    }
    
    // Function to return formatted address
    public function getFormattedAddress() {
        if (!empty($this->addressLine2)) {
            return $this->addressLine1 . ", " . $this->addressLine2;
        } else {
            return $this->addressLine1;
        }
    }
    
    // Function to return formatted address location as "City, State Zip"
    public function getFormattedAddressLocation() {
        return $this->city . ", " . $this->state . " " . $this->zipCode;
    }
    
    // Static functions for labels and messages
    public static function getNameAndAddressLabel() {
        return "Name and Address Information";
    }
    
    public static function getFullNameLabel() {
        return "Full Name";
    }
    
    public static function getAddressLabel() {
        return "Address";
    }
    
    public static function getCityStateZipLabel() {
        return "City/State/Zip";
    }
}
?>
