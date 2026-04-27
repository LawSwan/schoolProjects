<?php
namespace Controllers;

require_once(__DIR__ . '/contact.php');
require_once(__DIR__ . '/../model/contact_db.php');

use Models\ContactDB;

class ContactController {
    public static function getAllContacts() {
        $queryRes = ContactDB::getContacts();

        if ($queryRes) {
            $contacts = array();

            foreach ($queryRes as $row) {
                $contact = new Contact(
                    $row['ContactFirstName'],
                    $row['ContactLastName'],
                    $row['ContactAddressLine1'],
                    $row['ContactAddressLine2'],
                    $row['ContactCity'],
                    $row['ContactState'],
                    $row['ContactZip'],
                    $row['ContactBirthdate'],
                    $row['ContactEMail'],
                    $row['ContactPhone'],
                    $row['ContactNotes']
                );
                $contact->setContactNo($row['ContactNo']);

                $contacts[] = $contact;
            }

            return $contacts;
        } else {
            return false;
        }
    }

    public static function getContactByContactNo($contactNo) {
        $row = ContactDB::getContactByContactNo($contactNo);

        if ($row) {
            $contact = new Contact(
                $row['ContactFirstName'],
                $row['ContactLastName'],
                $row['ContactAddressLine1'],
                $row['ContactAddressLine2'],
                $row['ContactCity'],
                $row['ContactState'],
                $row['ContactZip'],
                $row['ContactBirthdate'],
                $row['ContactEMail'],
                $row['ContactPhone'],
                $row['ContactNotes']
            );
            $contact->setContactNo($row['ContactNo']);

            return $contact;
        } else {
            return false;
        }
    }

    public static function addContact($contact) {
        return ContactDB::addContact(
            $contact->getFirstName(),
            $contact->getLastName(),
            $contact->getAddressLine1(),
            $contact->getAddressLine2(),
            $contact->getCity(),
            $contact->getState(),
            $contact->getZip(),
            $contact->getBirthdate(),
            $contact->getEmail(),
            $contact->getPhone(),
            $contact->getNotes()
        );
    }

    public static function updateContact($contact) {
        return ContactDB::updateContact(
            $contact->getContactNo(),
            $contact->getFirstName(),
            $contact->getLastName(),
            $contact->getAddressLine1(),
            $contact->getAddressLine2(),
            $contact->getCity(),
            $contact->getState(),
            $contact->getZip(),
            $contact->getBirthdate(),
            $contact->getEmail(),
            $contact->getPhone(),
            $contact->getNotes()
        );
    }

    public static function deleteContact($contactNo) {
        return ContactDB::deleteContact($contactNo);
    }
}
?>
