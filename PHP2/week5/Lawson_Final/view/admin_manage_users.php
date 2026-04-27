<?php
session_start();
require_once(__DIR__ . '/../util/Security.php');
require_once(__DIR__ . '/../controller/UserController.php');

use Util\Security;
use Controller\UserController;

// Check if user is admin
Security::checkAdmin();

// Handle logout
if (isset($_POST['action']) && $_POST['action'] === 'logout') {
    Security::logout();
}

// Handle delete
if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['userNo'])) {
    $userNo = intval($_POST['userNo']);
    UserController::deleteUser($userNo);
    header('Location: admin_manage_users.php');
    exit();
}

// Get all users
$users = UserController::getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Name Final Practical</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        h2 { color: #555; }
        table { border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        a { color: #800000; font-weight: bold; }
        input[type="submit"] { padding: 3px 10px; margin: 2px; }
        .nav-links { margin-top: 20px; }
        .nav-links a { margin-right: 15px; }
    </style>
</head>
<body>
    <h1>Amber Lawson Final Practical</h1>
    <h2>Manage User Accounts</h2>

    <p><a href="admin_add_update_user.php">Add User</a></p>

    <table>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Hire Date</th>
            <th>E-Mail Address</th>
            <th>Extension</th>
            <th>Level</th>
            <th colspan="2">Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user->getUserId()); ?></td>
            <td><?php echo htmlspecialchars($user->getFirstName()); ?></td>
            <td><?php echo htmlspecialchars($user->getLastName()); ?></td>
            <td><?php echo htmlspecialchars($user->getHireDate()); ?></td>
            <td><?php echo htmlspecialchars($user->getEmail()); ?></td>
            <td><?php echo htmlspecialchars($user->getExtension()); ?></td>
            <td><?php echo htmlspecialchars($user->getLevelName()); ?></td>
            <td>
                <form method="GET" action="admin_add_update_user.php" style="display:inline;">
                    <input type="hidden" name="userId" value="<?php echo htmlspecialchars($user->getUserId()); ?>">
                    <input type="submit" value="Update">
                </form>
            </td>
            <td>
                <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="userNo" value="<?php echo $user->getUserNo(); ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div class="nav-links">
        <a href="admin.php">Home</a>
    </div>

    <form method="POST">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Logout">
    </form>
</body>
</html>
