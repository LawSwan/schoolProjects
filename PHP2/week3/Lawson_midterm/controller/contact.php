<?php
namespace Controllers;

// Contact model class
class Contact {
    private $contactNo;
    private $firstName;
    private $lastName;
    private $addressLine1;
    private $addressLine2;
    private $city;
    private $state;
    private $zip;
    private $birthdate;
    private $email;
    private $phone;
    private $notes;

    public function __construct($firstName, $lastName, $addressLine1, $addressLine2, $city, $state, $zip, $birthdate, $email, $phone, $notes) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->addressLine1 = $addressLine1;
        $this->addressLine2 = $addressLine2;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->birthdate = $birthdate;
        $this->email = $email;
        $this->phone = $phone;
        $this->notes = $notes;
    }

    public function getContactNo() {
        return $this->contactNo;
    }

    public function setContactNo($contactNo) {
        $this->contactNo = $contactNo;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getAddressLine1() {
        return $this->addressLine1;
    }

    public function setAddressLine1($addressLine1) {
        $this->addressLine1 = $addressLine1;
    }

    public function getAddressLine2() {
        return $this->addressLine2;
    }

    public function setAddressLine2($addressLine2) {
        $this->addressLine2 = $addressLine2;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function getZip() {
        return $this->zip;
    }

    public function setZip($zip) {
        $this->zip = $zip;
    }

    public function getBirthdate() {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getNotes() {
        return $this->notes;
    }

    public function setNotes($notes) {
        $this->notes = $notes;
    }
}
?>
