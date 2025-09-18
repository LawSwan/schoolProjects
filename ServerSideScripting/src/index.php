<?php
$connect = new mysqli(
    'db',
    'Amblaw',
    'password',
    'mydatabase_php'
);


$table_name = "products"; // Update to your actual table name

$query = "SELECT * FROM $table_name";
$response = mysqli_query($connect, $query);

if (!$response) {
    echo "Query error: " . mysqli_error($connect);
    exit;
}

echo "<h1>Product List</h1>";
while($row = mysqli_fetch_assoc($response)) {
    echo "<div>";
    echo "<strong>{$row['ProductName']}</strong> ({$row['ProductID']})<br>";
    echo "<em>{$row['ProductDescription']}</em><br>";
    echo "<hr>";
    echo "</div>";
}
?>