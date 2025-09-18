<!DOCTYPE html>
<html>
<head>
    <title>Week2 GP1 - Amber Lawson</title>
</head>
<body>
<form method="POST">
    <h3>Enter your first name: <input type="text" name="fname"></h3>
    <h3>Enter your last name: <input type="text" name="lname"></h3>
    <h3>Enter your email address: <input type="text" name="email"></h3>
    <h3>Enter your favorite number: <input type="text" name="fav_num"></h3>
    <input type="submit" value="Submit Values">
</form>
<?php

// Declare and clear variables for display

$first_name = "";
$last_name = "";
$email = "";
$favorite = "";

// Retrieve values from query string and store in a local variable
if (isset($_POST['fname'])) {
    $first_name = $_POST['fname'];
    echo "<p>fname is set in POST</p>";
}
if (isset($_POST['lname'])) {
    $last_name = $_POST['lname'];
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}
if (isset($_POST['fav_num'])) {
    $favorite = $_POST['fav_num'];
}

// Output the values entered as long as there is a value there
if (strlen($first_name) > 0 || strlen($last_name) > 0) {
    echo "<h3>The name you entered is: $first_name $last_name </h3>";
}
if (strlen($email) > 0) {
    echo "<h3>The email address you gave is: $email </h3>";
}
if (strlen($favorite) > 0) {
    if (is_numeric($favorite))
        echo "<h3>You said your favorite number is: $favorite </h3>";
    else
        echo "<h3>That’s not a number!</h3>";
}
?>
</body>
</html>