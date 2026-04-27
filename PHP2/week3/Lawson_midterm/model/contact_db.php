<?php
namespace Models;

require_once(__DIR__ . '/database.php');

class ContactDB {
    public static function getContacts() {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = 'SELECT * FROM contacts';
            return $dbConn->query($query);
        } else {
            return false;
        }
    }

    public static function getContactByContactNo($contactNo) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "SELECT * FROM contacts WHERE ContactNo = '$contactNo'";
            $result = $dbConn->query($query);
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public static function addContact($firstName, $lastName, $addressLine1, $addressLine2, $city, $state, $zip, $birthdate, $email, $phone, $notes) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "INSERT INTO contacts (ContactFirstName, ContactLastName, ContactAddressLine1, ContactAddressLine2, ContactCity, ContactState, ContactZip, ContactBirthdate, ContactEMail, ContactPhone, ContactNotes)
                      VALUES ('$firstName', '$lastName', '$addressLine1', '$addressLine2', '$city', '$state', '$zip', '$birthdate', '$email', '$phone', '$notes')";
            return $dbConn->query($query) === TRUE;
        } else {
            return false;
        }
    }

    public static function updateContact($contactNo, $firstName, $lastName, $addressLine1, $addressLine2, $city, $state, $zip, $birthdate, $email, $phone, $notes) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "UPDATE contacts SET
                      ContactFirstName = '$firstName',
                      ContactLastName = '$lastName',
                      ContactAddressLine1 = '$addressLine1',
                      ContactAddressLine2 = '$addressLine2',
                      ContactCity = '$city',
                      ContactState = '$state',
                      ContactZip = '$zip',
                      ContactBirthdate = '$birthdate',
                      ContactEMail = '$email',
                      ContactPhone = '$phone',
                      ContactNotes = '$notes'
                      WHERE ContactNo = '$contactNo'";
            return $dbConn->query($query) === TRUE;
        } else {
            return false;
        }
    }

    public static function deleteContact($contactNo) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "DELETE FROM contacts WHERE ContactNo = '$contactNo'";
            return $dbConn->query($query) === TRUE;
        } else {
            return false;
        }
    }
}
?>
