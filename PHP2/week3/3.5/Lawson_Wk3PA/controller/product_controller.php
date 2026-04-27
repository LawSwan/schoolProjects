<?php
require_once(__DIR__ . '/product.php');
require_once(__DIR__ . '/category.php');
require_once(__DIR__ . '/../model/product_db.php');

class ProductController {
    public static function getAllProducts() {
        $queryRes = ProductDB::getProducts();

        if ($queryRes) {
            $products = array();

            foreach ($queryRes as $row) {
                $category = new Category(
                    $row['CategoryNo'],
                    $row['CategoryName']
                );

                $product = new Product(
                    $row['ProductCode'],
                    $row['ProductName'],
                    $category,
                    $row['ProductPrice']
                );
                $product->setProductNo($row['ProductNo']);

                $products[] = $product;
            }

            return $products;
        } else {
            return false;
        }
    }

    public static function getProductById($productNo) {
        $row = ProductDB::getProductById($productNo);

        if ($row) {
            $category = new Category(
                $row['CategoryNo'],
                $row['CategoryName']
            );

            $product = new Product(
                $row['ProductCode'],
                $row['ProductName'],
                $category,
                $row['ProductPrice']
            );
            $product->setProductNo($row['ProductNo']);

            return $product;
        } else {
            return false;
        }
    }

    public static function addProduct($product) {
        return ProductDB::addProduct(
            $product->getProductCode(),
            $product->getProductName(),
            $product->getCategory()->getCategoryNo(),
            $product->getProductCost()
        );
    }

    public static function updateProduct($product) {
        return ProductDB::updateProduct(
            $product->getProductNo(),
            $product->getProductCode(),
            $product->getProductName(),
            $product->getCategory()->getCategoryNo(),
            $product->getProductCost()
        );
    }

    public static function deleteProduct($productNo) {
        return ProductDB::deleteProduct($productNo);
    }
}
?>
