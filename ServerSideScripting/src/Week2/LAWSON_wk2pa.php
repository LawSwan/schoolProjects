<!DOCTYPE html>
<html>
<head>
    <title>Amber Lawson Wk 2 Performance Assessment</title>
</head>
<body>
<h1>Amber Lawson Wk 2 Performance Assessment</h1>
<form method="POST">
    <h3>Name: <input type="text" name="name"></h3>
    <h3>Date of Birth: <input type="text" name="dob"></h3>
    <h3>Favorite Color: <input type="text" name="color"></h3>
    <h3>Favorite Place To Visit: <input type="text" name="place"></h3>
    <h3>Nickname: <input type="text" name="nickname"></h3>
    <input type="submit" value="Submit Information">
</form>
<?php

// Only process and display results if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Declare and clear variables for display
    $name = "";
    $dob = "";
    $color = "";
    $place = "";
    $nickname = "";

    // Retrieve values from POST data and store in local variables
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (isset($_POST['dob'])) {
        $dob = $_POST['dob'];
    }
    if (isset($_POST['color'])) {
        $color = $_POST['color'];
    }
    if (isset($_POST['place'])) {
        $place = $_POST['place'];
    }
    if (isset($_POST['nickname'])) {
        $nickname = $_POST['nickname'];
    }

    // Output the values entered or indicate missing values
    echo "<hr>";
    echo "<h2>Results:</h2>";

    // Name field
    if (strlen($name) > 0) {
        echo "<h3>Your name is: $name</h3>";
    } else {
        echo "<h3>You didn't enter your name</h3>";
    }

    // Date of Birth field
    if (strlen($dob) > 0) {
        echo "<h3>Your date of birth is: $dob</h3>";
    } else {
        echo "<h3>You didn't enter your date of birth</h3>";
    }

    // Favorite Color field
    if (strlen($color) > 0) {
        echo "<h3>Your favorite color is: $color</h3>";
    } else {
        echo "<h3>You didn't enter your favorite color</h3>";
    }

    // Favorite Place field
    if (strlen($place) > 0) {
        echo "<h3>Your favorite place to visit is: $place</h3>";
    } else {
        echo "<h3>You didn't enter your favorite place to visit</h3>";
    }

    // Nickname field
    if (strlen($nickname) > 0) {
        echo "<h3>Your nickname is: $nickname</h3>";
    } else {
        echo "<h3>You didn't enter your nickname</h3>";
    }
}
?>
</body>
</html>
