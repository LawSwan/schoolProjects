<?php
session_start();

require_once(__DIR__.'/../util/security.php');

//confirm user is authorized for the page
Security::checkAuthority('admin');

//user clicked the logout button
if (isset($_POST['logout'])) {
    Security::logout();
}
?>
<html>
<head>
    <title>Amber J. Lawson Wk 4 Performance Assessment</title>
</head>
<body>
    <h1>Amber J. Lawson Wk 4 Performance Assessment</h1>
    <h2>View User Accounts</h2>
    <ul>
        <li><a href="admin.php">Home</a></li>
    </ul>
    <form method='POST'>
        <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html>
