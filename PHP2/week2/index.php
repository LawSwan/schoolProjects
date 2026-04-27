<?php
require_once('display_name.php');

$dispName = new DisplayName();
$dispName->setName("Amber", "Lawson");
?>

<html>
<head>
 <title>Week2 GP1 - Amber Lawson</title>
</head>

<body>
 <h2>
        Hello! <?php echo $dispName->getName(); ?>! Welcome to Object-Oriented PHP!
    </h2>
</body>
</html>