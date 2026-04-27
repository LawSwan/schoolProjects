<?php
session_start();

require_once(__DIR__ . '/controller/UserController.php');

use Controller\UserController;

$error = '';
$logout_msg = '';

// Check for logout message
if (isset($_SESSION['logout_msg'])) {
    $logout_msg = $_SESSION['logout_msg'];
    unset($_SESSION['logout_msg']);
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $userId = $_POST['userId'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($userId) || empty($password)) {
        $error = 'Please enter both User ID and Password.';
    } else {
        $level = UserController::validUser($userId, $password);

        if ($level !== false) {
            // Login successful
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_level'] = $level;

            // Redirect based on user level
            if ($level == 1) {
                header('Location: view/admin.php');
                exit();
            } else if ($level == 2) {
                header('Location: view/tech.php');
                exit();
            }
        } else {
            $error = 'Invalid User ID or Password.';
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
        .error { color: red; }
        .success { color: green; }
        form { margin-top: 20px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type="text"], input[type="password"] { width: 200px; padding: 5px; }
        input[type="submit"] { margin-top: 15px; padding: 8px 15px; }
    </style>
</head>
<body>
    <h1>Amber Lawson Final Practical</h1>
    <h2>Amber Lawson Application Login</h2>

    <?php if (!empty($logout_msg)): ?>
        <p class="success"><?php echo htmlspecialchars($logout_msg); ?></p>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php">
        <input type="hidden" name="action" value="login">

        <label for="userId">Login ID:</label>
        <input type="text" id="userId" name="userId" value="<?php echo htmlspecialchars($_POST['userId'] ?? ''); ?>">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">

        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
