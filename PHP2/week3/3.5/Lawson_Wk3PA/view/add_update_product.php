<?php
require_once(__DIR__ . '/../controller/product.php');
require_once(__DIR__ . '/../controller/product_controller.php');
require_once(__DIR__ . '/../controller/category.php');
require_once(__DIR__ . '/../controller/category_controller.php');

$categories = CategoryController::getAllCategories();

// Default values for new product
$productNo = -1;
$productCode = '';
$productName = '';
$productCost = '';
$selectedCategoryNo = $categories[0]->getCategoryNo();
$pageTitle = "Add a New Product";

// Check if updating existing product
if (isset($_GET['pNo'])) {
    $product = ProductController::getProductById($_GET['pNo']);
    if ($product) {
        $productNo = $product->getProductNo();
        $productCode = $product->getProductCode();
        $productName = $product->getProductName();
        $productCost = $product->getProductCost();
        $selectedCategoryNo = $product->getCategory()->getCategoryNo();
        $pageTitle = "Update an Existing Product";
    }
}

// Handle save action
if (isset($_POST['save'])) {
    $categoryObj = CategoryController::getCategoryById($_POST['categoryNo']);

    $product = new Product(
        $_POST['productCode'],
        $_POST['productName'],
        $categoryObj,
        $_POST['productCost']
    );
    $product->setProductNo($_POST['productNo']);

    if ($_POST['productNo'] == -1) {
        // Add new product
        ProductController::addProduct($product);
    } else {
        // Update existing product
        ProductController::updateProduct($product);
    }

    header('Location: ./display_products.php');
    exit;
}

// Handle cancel action
if (isset($_POST['cancel'])) {
    header('Location: ./display_products.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lawson Wk 3 Performance Assessment</title>
</head>
<body>
    <h1>Lawson Wk 3 Performance Assessment</h1>
    <h2><?php echo $pageTitle; ?></h2>
    <form method="POST">
        <input type="hidden" name="productNo" value="<?php echo $productNo; ?>">
        <p>
            <label>Product Code:</label><br>
            <input type="text" name="productCode" value="<?php echo $productCode; ?>">
        </p>
        <p>
            <label>Product Name:</label><br>
            <input type="text" name="productName" value="<?php echo $productName; ?>">
        </p>
        <p>
            <label>Product Category:</label><br>
            <select name="categoryNo">
                <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category->getCategoryNo(); ?>"
                    <?php if ($category->getCategoryNo() == $selectedCategoryNo) echo 'selected'; ?>>
                    <?php echo $category->getCategoryName(); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label>Product Price:</label><br>
            <input type="text" name="productCost" value="<?php echo $productCost; ?>">
        </p>
        <p>
            <input type="submit" name="save" value="Save">
            <input type="submit" name="cancel" value="Cancel">
        </p>
    </form>
</body>
</html>
