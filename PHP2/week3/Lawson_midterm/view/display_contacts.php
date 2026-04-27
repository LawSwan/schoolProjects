<?php
require_once(__DIR__ . '/../controller/contact.php');
require_once(__DIR__ . '/../controller/contact_controller.php');

use Controllers\Contact;
use Controllers\ContactController;

// Handle delete action
if (isset($_POST['delete']) && isset($_POST['contactNo'])) {
    ContactController::deleteContact($_POST['contactNo']);
}

// Handle update button - redirect to add_update page
if (isset($_POST['update']) && isset($_POST['contactNo'])) {
    header('Location: ./add_update_contact.php?contactNo=' . $_POST['contactNo']);
    exit;
}

$contacts = ContactController::getAllContacts();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lawson Midterm Practical</title>
</head>
<body>
    <h1>Lawson Midterm Practical</h1>
    <h2>My Contacts</h2>
    <p><a href="./add_update_contact.php">Add Contact</a></p>
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Street Address</th>
            <th>Apt/Office/Bldg</th>
            <th>City</th>
            <th>State</th>
            <th>Zip Code</th>
            <th>DOB</th>
            <th>E-Mail Address</th>
            <th>Phone Number</th>
            <th>Additional Information</th>
            <th></th>
            <th></th>
        </tr>
        <?php if ($contacts) : ?>
            <?php foreach ($contacts as $contact) : ?>
            <tr>
                <td><?php echo $contact->getContactNo(); ?></td>
                <td><?php echo $contact->getLastName() . ', ' . $contact->getFirstName(); ?></td>
                <td><?php echo $contact->getAddressLine1(); ?></td>
                <td><?php echo $contact->getAddressLine2(); ?></td>
                <td><?php echo $contact->getCity(); ?></td>
                <td><?php echo $contact->getState(); ?></td>
                <td><?php echo $contact->getZip(); ?></td>
                <td><?php echo $contact->getBirthdate(); ?></td>
                <td><?php echo $contact->getEmail(); ?></td>
                <td><?php echo $contact->getPhone(); ?></td>
                <td><?php echo $contact->getNotes(); ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="contactNo" value="<?php echo $contact->getContactNo(); ?>">
                        <input type="submit" name="update" value="Update">
                    </form>
                </td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="contactNo" value="<?php echo $contact->getContactNo(); ?>">
                        <input type="submit" name="delete" value="Delete">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <p><a href="../index.php">Home</a></p>
</body>
</html>
