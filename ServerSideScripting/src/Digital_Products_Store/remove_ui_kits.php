<?php
// Quick script to remove UI Kits category and products
require_once 'db_connection.php';

// Remove UI Kits products first (to avoid foreign key constraints)
$remove_products = "DELETE FROM digital_products WHERE CategoryID = 3";
if (mysqli_query($conn, $remove_products)) {
    echo "✓ UI Kits products removed<br>";
} else {
    echo "✗ Error removing products: " . mysqli_error($conn) . "<br>";
}

// Remove UI Kits category
$remove_category = "DELETE FROM categories WHERE CategoryID = 3";
if (mysqli_query($conn, $remove_category)) {
    echo "✓ UI Kits category removed<br>";
} else {
    echo "✗ Error removing category: " . mysqli_error($conn) . "<br>";
}

mysqli_close($conn);
echo "<br><a href='index.php'>Back to Store</a>";
?>
