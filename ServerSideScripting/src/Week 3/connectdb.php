<?php
// Include database connection
require_once 'db_connection.php';

//Query for all users
$query = "SELECT * FROM userinfo";
$result = mysqli_query($conn, $query);
?>

<style>
table {
    border-spacing: 5px;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 15px;
    text-align: center;
}
th {
    background-color:lightpink; 
}
tr:nth-child(even) {
    background-color:whitesmoke;
}
tr:nth-child(odd) {
    background-color:lightgray;
}
</style>
<html>
<head>
    <title>Week3 GP1 - Amber Lawson</title>
</head>

<body>
<h2>Current Users:</h2>
<table>
    <tr style="font-size:large;">
        <th>User #</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>E-Mail</th>
        <th>Favorite Number</th>
    </tr>
    <?php while($row = mysqli_fetch_array($result)):?>
    <tr>
        <td><?php echo $row["UserNo"];?></td>
        <td><?php echo $row["FirstName"];?></td>
        <td><?php echo $row["LastName"];?></td>
        <td><?php echo $row["EMail"];?></td>
        <td><?php echo $row["FavoriteNum"];?></td>
    </tr>
    <?php endwhile;?>
</table>
</body>
</html>
