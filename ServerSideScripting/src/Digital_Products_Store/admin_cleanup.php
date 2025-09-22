<?php
require_once 'db_connection.php';

echo "<h2>Database Cleanup Tool</h2>";

if (isset($_GET['action']) && $_GET['action'] === 'remove_ui_kits') {
    try {
        // First, delete all products in UI Kits category
        $delete_products = "DELETE FROM products WHERE CategoryID = (SELECT CategoryID FROM categories WHERE CategoryName = 'UI Kits')";
        $result1 = mysqli_query($conn, $delete_products);
        
        if ($result1) {
            $products_deleted = mysqli_affected_rows($conn);
            echo "<p>✓ Deleted $products_deleted UI Kits products</p>";
        }
        
        // Then delete the UI Kits category
        $delete_category = "DELETE FROM categories WHERE CategoryName = 'UI Kits'";
        $result2 = mysqli_query($conn, $delete_category);
        
        if ($result2) {
            $categories_deleted = mysqli_affected_rows($conn);
            echo "<p>✓ Deleted $categories_deleted UI Kits category</p>";
        }
        
        echo "<p><strong>Cleanup completed successfully!</strong></p>";
        echo "<p><a href='index.php'>← Back to Store</a></p>";
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>This tool will remove the UI Kits category and all its products.</p>";
    echo "<p><a href='?action=remove_ui_kits' onclick=\"return confirm('Are you sure you want to remove UI Kits category and all its products? This cannot be undone.')\">Remove UI Kits</a></p>";
    echo "<p><a href='index.php'>← Back to Store</a></p>";
}

mysqli_close($conn);
?>
