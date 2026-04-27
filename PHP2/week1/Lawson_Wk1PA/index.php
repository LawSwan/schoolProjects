<?php
require_once('validator.php');

// Declare and clear variables
$name = '';
$dob = '';
$email = '';
$favorite_int = '';
$nickname = '';

// Declare and clear error variables
$name_error = '';
$dob_error = '';
$email_error = '';
$favorite_int_error = '';
$nickname_error = '';

// Retrieve values from POST
if (isset($_POST['name']))
    $name = trim($_POST['name']);
if (isset($_POST['dob']))
    $dob = trim($_POST['dob']);
if (isset($_POST['email']))
    $email = trim($_POST['email']);
if (isset($_POST['favorite_int']))
    $favorite_int = trim($_POST['favorite_int']);
if (isset($_POST['nickname']))
    $nickname = trim($_POST['nickname']);

// Perform validation
// Name validation - returns value
$name_error = lawson_validator\validateName($name);

// Date of Birth validation - returns value
$dob_error = lawson_validator\validateDateOfBirth($dob);

// Email validation - passed by reference
lawson_validator\validateEmail($email, $email_error);

// Favorite Integer validation - uses exceptions
try {
    lawson_validator\validateInteger($favorite_int);
} catch (\Exception $e) {
    $favorite_int_error = $e->getMessage();
}

// Nickname validation - uses control logic (if-else)
$nickname_error = lawson_validator\validateNickname($nickname);

?>
<html>
<head>
    <title>Amber Lawson Wk 1 Performance Assessment</title>
</head>

<body>
    <h2>Enter data for Validation</h2>
    <form method='POST'>
        <h3>Enter your name: <input type="text" name="name"
            value="<?php echo htmlspecialchars($name); ?>">
            <?php if (strlen($name_error) > 0)
                echo "<span style='color: red;'>{$name_error}</span>"; ?>
        </h3>

        <h3>Enter your birthdate: <input type="text" name="dob"
            value="<?php echo htmlspecialchars($dob); ?>">
            <?php if (strlen($dob_error) > 0)
                echo "<span style='color: red;'>{$dob_error}</span>"; ?>
        </h3>

        <h3>Enter your e-mail: <input type="text" name="email"
            value="<?php echo htmlspecialchars($email); ?>">
            <?php if (strlen($email_error) > 0)
                echo "<span style='color: red;'>{$email_error}</span>"; ?>
        </h3>

        <h3>Enter your favorite integer: <input type="text" name="favorite_int"
            value="<?php echo htmlspecialchars($favorite_int); ?>">
            <?php if (strlen($favorite_int_error) > 0)
                echo "<span style='color: red;'>{$favorite_int_error}</span>"; ?>
        </h3>

        <h3>Enter your nickname: <input type="text" name="nickname"
            value="<?php echo htmlspecialchars($nickname); ?>">
            <?php if (strlen($nickname_error) > 0)
                echo "<span style='color: red;'>{$nickname_error}</span>"; ?>
        </h3>

        <input type="submit" value="Validate Values">
    </form>

    <h3><?php
        if (strlen($name_error) > 0 || strlen($dob_error) > 0
            || strlen($email_error) > 0 || strlen($favorite_int_error) > 0
            || strlen($nickname_error) > 0) {
            echo "Errors found, please check your entries";
        } else {
            echo "All fields valid";
        }
    ?>
    </h3>
</body>
</html>
