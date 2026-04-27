<?php
session_start();

require_once(__DIR__.'/controller/user.php');
require_once(__DIR__.'/controller/user_controller.php');
require_once(__DIR__.'/util/security.php');

Security::checkHTTPS();

//set the message related to login/logout functionality
$login_msg = isset($_SESSION['logout_msg']) ?
    $_SESSION['logout_msg'] : '';

//clear the logout message after displaying
unset($_SESSION['logout_msg']);

if (isset($_POST['email']) && isset($_POST['pw'])) {
    //login and password fields were set
    $user_level = UserController::validUser(
        $_POST['email'], $_POST['pw']);

    if ($user_level === '1') {
        $_SESSION['admin'] = true;
        $_SESSION['user'] = false;
        $_SESSION['tech'] = false;
        header("Location: view/admin.php");
        exit();
    } else if ($user_level === '2') {
        $_SESSION['admin'] = false;
        $_SESSION['user'] = true;
        $_SESSION['tech'] = false;
        header("Location: view/user.php");
        exit();
    } else if ($user_level === '3') {
        $_SESSION['admin'] = false;
        $_SESSION['user'] = false;
        $_SESSION['tech'] = true;
        header("Location: view/tech.php");
        exit();
    } else {
        $login_msg = 'Failed Authentication - try again.';
    }
}
?>
<html>
<head>
    <title>Amber J. Lawson Wk 4 Performance Assessment</title>
</head>
<body>
    <h1></h1>
    <h2>Amber Lawson Application Login</h2>
    <form method='POST'>
        <p>Login ID (e-mail): <input type="text" name="email"></p>
        <p>Password: <input type="password" name="pw"></p>
        <input type="submit" value="Login" name="login">
    </form>
    <h3><?php echo $login_msg; ?></h3>
</body>
</html>
