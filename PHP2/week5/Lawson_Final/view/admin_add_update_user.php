<?php
session_start();
require_once(__DIR__ . '/../util/Security.php');
require_once(__DIR__ . '/../util/Validation.php');
require_once(__DIR__ . '/../controller/UserController.php');

use Util\Security;
use Util\Validation;
use Controller\UserController;

// Check if user is admin
Security::checkAdmin();

// Handle logout
if (isset($_POST['action']) && $_POST['action'] === 'logout') {
    Security::logout();
}

// Initialize variables
$isUpdate = false;
$userNo = null;
$userId = '';
$password = '';
$firstName = '';
$lastName = '';
$hireDate = '';
$email = '';
$extension = '';
$level = 1;
$errors = [];
$success = '';

// Get all user levels for dropdown
$levels = UserController::getAllLevels();

// Check if updating an existing user
if (isset($_GET['userId'])) {
    $isUpdate = true;
    $existingUser = UserController::getUserById($_GET['userId']);
    if ($existingUser) {
        $userNo = $existingUser->getUserNo();
        $userId = $existingUser->getUserId();
        $password = $existingUser->getPassword();
        $firstName = $existingUser->getFirstName();
        $lastName = $existingUser->getLastName();
        $hireDate = $existingUser->getHireDate();
        $email = $existingUser->getEmail();
        $extension = $existingUser->getExtension();
        $level = $existingUser->getUserLevelNo();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save') {
    // Get form data
    $userNo = isset($_POST['userNo']) ? intval($_POST['userNo']) : null;
    $isUpdate = $userNo !== null && $userNo > 0;

    $userId = trim($_POST['userId'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $hireDate = trim($_POST['hireDate'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $extension = trim($_POST['extension'] ?? '');
    $level = intval($_POST['level'] ?? 1);

    // Validate all fields
    $errors = Validation::validateUserFields($userId, $password, $firstName, $lastName, $hireDate, $email, $extension, $level);

    // Check if userId already exists (for new users or if changed)
    if (empty($errors['userId'])) {
        if (UserController::userIdExists($userId, $isUpdate ? $userNo : null)) {
            $errors['userId'] = 'This User ID already exists.';
        }
    }

    // If no errors, save to database
    if (!Validation::hasErrors($errors)) {
        if ($isUpdate) {
            // Update existing user
            $result = UserController::updateUser($userNo, $userId, $password, $firstName, $lastName, $hireDate, $email, $extension, $level);
            if ($result) {
                header('Location: admin_manage_users.php');
                exit();
            } else {
                $success = '';
                $errors['general'] = 'Failed to update user.';
            }
        } else {
            // Add new user
            $result = UserController::addUser($userId, $password, $firstName, $lastName, $hireDate, $email, $extension, $level);
            if ($result) {
                header('Location: admin_manage_users.php');
                exit();
            } else {
                $errors['general'] = 'Failed to add user.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amber Lawson Final Practical</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        h2 { color: #555; }
        form { margin-top: 20px; }
        label { display: inline-block; width: 100px; margin-top: 10px; font-weight: bold; }
        input[type="text"], input[type="password"], input[type="date"], select {
            width: 200px; padding: 5px;
        }
        .error { color: red; margin-left: 10px; }
        .required { color: red; margin-left: 10px; }
        input[type="submit"] { margin-top: 15px; padding: 5px 15px; margin-right: 10px; }
        .nav-links { margin-top: 20px; }
        .nav-links a { margin-right: 15px; color: #800000; font-weight: bold; }
        .field-row { margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>Amber Lawson Final Practical</h1>
    <h2><?php echo $isUpdate ? 'Update User' : 'Add a New User'; ?></h2>

    <?php if (!empty($errors['general'])): ?>
        <p class="error"><?php echo htmlspecialchars($errors['general']); ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="hidden" name="action" value="save">
        <?php if ($isUpdate): ?>
            <input type="hidden" name="userNo" value="<?php echo $userNo; ?>">
        <?php endif; ?>

        <div class="field-row">
            <label for="userId">User ID:</label>
            <input type="text" id="userId" name="userId" value="<?php echo htmlspecialchars($userId); ?>">
            <?php if (!empty($errors['userId'])): ?>
                <span class="error"><?php echo htmlspecialchars($errors['userId']); ?></span>
            <?php elseif (empty($userId) && $_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
                <span class="required">Required</span>
            <?php endif; ?>
        </div>

        <div class="field-row">
            <label for="password">Password:</label>
            <input type="text" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
            <?php if (!empty($errors['password'])): ?>
                <span class="error"><?php echo htmlspecialchars($errors['password']); ?></span>
            <?php elseif (empty($password) && $_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
                <span class="required">Required</span>
            <?php endif; ?>
        </div>

        <div class="field-row">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
            <?php if (!empty($errors['firstName'])): ?>
                <span class="error"><?php echo htmlspecialchars($errors['firstName']); ?></span>
            <?php elseif (empty($firstName) && $_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
                <span class="required">Required</span>
            <?php endif; ?>
        </div>

        <div class="field-row">
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
            <?php if (!empty($errors['lastName'])): ?>
                <span class="error"><?php echo htmlspecialchars($errors['lastName']); ?></span>
            <?php elseif (empty($lastName) && $_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
                <span class="required">Required</span>
            <?php endif; ?>
        </div>

        <div class="field-row">
            <label for="hireDate">Hire Date:</label>
            <input type="date" id="hireDate" name="hireDate" value="<?php echo htmlspecialchars($hireDate); ?>">
            <?php if (!empty($errors['hireDate'])): ?>
                <span class="error"><?php echo htmlspecialchars($errors['hireDate']); ?></span>
            <?php elseif (empty($hireDate) && $_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
                <span class="required">Required</span>
            <?php endif; ?>
        </div>

        <div class="field-row">
            <label for="email">E-Mail:</label>
            <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <?php if (!empty($errors['email'])): ?>
                <span class="error"><?php echo htmlspecialchars($errors['email']); ?></span>
            <?php elseif (empty($email) && $_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
                <span class="required">Required</span>
            <?php endif; ?>
        </div>

        <div class="field-row">
            <label for="extension">Extension:</label>
            <input type="text" id="extension" name="extension" value="<?php echo htmlspecialchars($extension); ?>">
            <?php if (!empty($errors['extension'])): ?>
                <span class="error"><?php echo htmlspecialchars($errors['extension']); ?></span>
            <?php elseif (empty($extension) && $_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
                <span class="required">Required</span>
            <?php endif; ?>
        </div>

        <div class="field-row">
            <label for="level">Level:</label>
            <select id="level" name="level">
                <?php foreach ($levels as $lvl): ?>
                    <option value="<?php echo $lvl->getUserLevelNo(); ?>" <?php echo ($level == $lvl->getUserLevelNo()) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($lvl->getLevelName()); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <input type="submit" value="Save">
            <input type="button" value="Cancel" onclick="window.location.href='admin_manage_users.php'">
        </div>
    </form>

    <div class="nav-links">
        <a href="admin.php">Home</a>
    </div>

    <form method="POST">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Logout">
    </form>
</body>
</html>
