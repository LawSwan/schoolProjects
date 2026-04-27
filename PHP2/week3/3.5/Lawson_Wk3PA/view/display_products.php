<?php
require_once(__DIR__ . '/../controller/product.php');
require_once(__DIR__ . '/../controller/product_controller.php');
require_once(__DIR__ . '/../controller/category.php');
require_once(__DIR__ . '/../controller/category_controller.php');

// Handle delete action
if (isset($_POST['delete']) && isset($_POST['pNo'])) {
    ProductController::deleteProduct($_POST['pNo']);
}

// Handle update button - redirect to add_update page
if (isset($_POST['update']) && isset($_POST['pNo'])) {
    header('Location: ./add_update_product.php?pNo=' . $_POST['pNo']);
    exit;
}

$products = ProductController::getAllProducts();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lawson Wk 3 Performance Assessment</title>
</head>
<body>
    <h1>Lawson Wk 3 Performance Assessment</h1>
    <h2>Product Information</h2>
    <p><a href="./add_update_product.php">Add Product</a></p>
    <table border="1">
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th></th>
            <th></th>
        </tr>
        <?php if ($products) : ?>
            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product->getProductCode(); ?></td>
                <td><?php echo $product->getProductName(); ?></td>
                <td><?php echo $product->getCategory()->getCategoryName(); ?></td>
                <td><?php echo $product->getProductCost(); ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="pNo" value="<?php echo $product->getProductNo(); ?>">
                        <input type="submit" name="update" value="Update">
                    </form>
                </td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="pNo" value="<?php echo $product->getProductNo(); ?>">
                        <input type="submit" name="delete" value="Delete">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <p><a href="../index.php">Home</a></p>
</body>
</html>
