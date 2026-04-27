<?php
require_once(__DIR__ . '/../controller/contact.php');
require_once(__DIR__ . '/../controller/contact_controller.php');

use Controllers\Contact;
use Controllers\ContactController;

// Default values for new contact
$contactNo = -1;
$firstName = '';
$lastName = '';
$addressLine1 = '';
$addressLine2 = '';
$city = '';
$state = '';
$zip = '';
$birthdate = '';
$email = '';
$phone = '';
$notes = '';
$pageTitle = "Add a New Contact";

// Error messages
$errors = array();

// Check if updating existing contact
if (isset($_GET['contactNo'])) {
    $contact = ContactController::getContactByContactNo($_GET['contactNo']);
    if ($contact) {
        $contactNo = $contact->getContactNo();
        $firstName = $contact->getFirstName();
        $lastName = $contact->getLastName();
        $addressLine1 = $contact->getAddressLine1();
        $addressLine2 = $contact->getAddressLine2();
        $city = $contact->getCity();
        $state = $contact->getState();
        $zip = $contact->getZip();
        $birthdate = $contact->getBirthdate();
        $email = $contact->getEmail();
        $phone = $contact->getPhone();
        $notes = $contact->getNotes();
        $pageTitle = "Update an Existing Contact";
    }
}

// Handle save action
if (isset($_POST['save'])) {
    // Get form values
    $contactNo = $_POST['contactNo'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $addressLine1 = $_POST['addressLine1'];
    $addressLine2 = $_POST['addressLine2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $notes = $_POST['notes'];

    // Set page title based on mode
    if ($contactNo == -1) {
        $pageTitle = "Add a New Contact";
    } else {
        $pageTitle = "Update an Existing Contact";
    }

    // Validate First Name - Required, at least 2 characters
    if (empty($firstName)) {
        $errors['firstName'] = 'Required';
    } elseif (strlen($firstName) < 2) {
        $errors['firstName'] = 'Must be at least 2 characters.';
    }

    // Validate Last Name - Required, at least 2 characters
    if (empty($lastName)) {
        $errors['lastName'] = 'Required';
    } elseif (strlen($lastName) < 2) {
        $errors['lastName'] = 'Must be at least 2 characters.';
    }

    // Validate Street Address - Required
    if (empty($addressLine1)) {
        $errors['addressLine1'] = 'Required';
    }

    // Apt/Office/Bldg is optional - no validation needed

    // Validate City - Required, at least 2 characters
    if (empty($city)) {
        $errors['city'] = 'Required';
    } elseif (strlen($city) < 2) {
        $errors['city'] = 'Must be at least 2 characters.';
    }

    // Validate State - Required, 2 uppercase letters only
    if (empty($state)) {
        $errors['state'] = 'Required';
    } elseif (!preg_match('/^[A-Z]{2}$/', $state)) {
        $errors['state'] = 'Invalid state abbreviation - 2 Uppercase letters only';
    }

    // Validate Zip - Required, 5 numbers only
    if (empty($zip)) {
        $errors['zip'] = 'Required';
    } elseif (!preg_match('/^[0-9]{5}$/', $zip)) {
        $errors['zip'] = 'Invalid Zip Code - 5 digits only';
    }

    // Validate Date of Birth - Required
    if (empty($birthdate)) {
        $errors['birthdate'] = 'Required';
    }

    // Validate E-Mail - Required, valid email format
    if (empty($email)) {
        $errors['email'] = 'Required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Not a valid email address.';
    }

    // Validate Phone - Required, format (XXX)XXX-XXXX
    if (empty($phone)) {
        $errors['phone'] = 'Required';
    } elseif (!preg_match('/^\([0-9]{3}\)[0-9]{3}-[0-9]{4}$/', $phone)) {
        $errors['phone'] = 'Invalid phone number - expected format (XXX)XXX-XXXX';
    }

    // Validate Notes - Optional, up to 50 characters
    if (strlen($notes) > 50) {
        $errors['notes'] = 'Maximum string length is 50 characters.';
    }

    // If no errors, save to database
    if (empty($errors)) {
        $contact = new Contact(
            $firstName,
            $lastName,
            $addressLine1,
            $addressLine2,
            $city,
            $state,
            $zip,
            $birthdate,
            $email,
            $phone,
            $notes
        );
        $contact->setContactNo($contactNo);

        if ($contactNo == -1) {
            // Add new contact
            ContactController::addContact($contact);
        } else {
            // Update existing contact
            ContactController::updateContact($contact);
        }

        header('Location: ./display_contacts.php');
        exit;
    }
}

// Handle cancel action
if (isset($_POST['cancel'])) {
    header('Location: ./display_contacts.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lawson Midterm Practical</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Lawson Midterm Practical</h1>
    <h2><?php echo $pageTitle; ?></h2>
    <form method="POST">
        <input type="hidden" name="contactNo" value="<?php echo $contactNo; ?>">
        <p>
            <label>First Name:</label><br>
            <input type="text" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
            <?php if (isset($errors['firstName'])) : ?>
                <span class="error"><?php echo $errors['firstName']; ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label>Last Name:</label><br>
            <input type="text" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
            <?php if (isset($errors['lastName'])) : ?>
                <span class="error"><?php echo $errors['lastName']; ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label>Street Address:</label><br>
            <input type="text" name="addressLine1" value="<?php echo htmlspecialchars($addressLine1); ?>">
            <?php if (isset($errors['addressLine1'])) : ?>
                <span class="error"><?php echo $errors['addressLine1']; ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label>Apt/Office/Bldg:</label><br>
            <input type="text" name="addressLine2" value="<?php echo htmlspecialchars($addressLine2); ?>">
        </p>
        <p>
            <label>City:</label><br>
            <input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>">
            <?php if (isset($errors['city'])) : ?>
                <span class="error"><?php echo $errors['city']; ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label>State:</label><br>
            <input type="text" name="state" value="<?php echo htmlspecialchars($state); ?>">
            <?php if (isset($errors['state'])) : ?>
                <span class="error"><?php echo $errors['state']; ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label>Zip:</label><br>
            <input type="text" name="zip" value="<?php echo htmlspecialchars($zip); ?>">
            <?php if (isset($errors['zip'])) : ?>
                <span class="error"><?php echo $errors['zip']; ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label>Date of Birth:</label><br>
            <input type="date" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>">
            <?php if (isset($errors['birthdate'])) : ?>
                <span class="error"><?php echo $errors['birthdate']; ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label>E-Mail:</label><br>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <?php if (isset($errors['email'])) : ?>
                <span class="error"><?php echo $errors['email']; ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label>Phone:</label><br>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            <?php if (isset($errors['phone'])) : ?>
                <span class="error"><?php echo $errors['phone']; ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label>Notes:</label><br>
            <input type="text" name="notes" value="<?php echo htmlspecialchars($notes); ?>">
            <?php if (isset($errors['notes'])) : ?>
                <span class="error"><?php echo $errors['notes']; ?></span>
            <?php endif; ?>
        </p>
        <p>
            <input type="submit" name="save" value="Save">
            <input type="submit" name="cancel" value="Cancel">
        </p>
    </form>
</body>
</html>
