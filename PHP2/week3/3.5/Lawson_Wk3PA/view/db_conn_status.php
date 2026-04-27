<?php
require_once(__DIR__ . '/../model/database.php');

$db = new Database();
$conn = $db->getDbConn();
$isConnected = ($conn !== false);
$error = $db->getError();

if ($conn) {
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lawson Wk 3 Performance Assessment</title>
</head>
<body>
    <h1>Lawson Wk 3 Performance Assessment</h1>
    <h2>Database Connection Status</h2>
    <ul>
        <li>Database Name: <?php echo $db->getDatabaseName(); ?></li>
        <li>Database User: <?php echo $db->getUsername(); ?></li>
        <li>Database User Password: <?php echo $db->getPassword(); ?></li>
    </ul>
    <?php if ($isConnected) : ?>
        <p><strong>Connection Successful</strong></p>
    <?php else : ?>
        <p><strong>Connection Unsuccessful</strong>Failed to connect to DB: <?php echo $error; ?></p>
    <?php endif; ?>
    <p><a href="../index.php">Home</a></p>
</body>
</html>
