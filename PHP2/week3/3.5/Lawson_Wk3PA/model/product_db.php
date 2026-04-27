<?php
require_once(__DIR__ . '/database.php');

class ProductDB {
    public static function getProducts() {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = 'SELECT * FROM products
                      INNER JOIN categories
                      ON products.CategoryNo = categories.CategoryNo';
            return $dbConn->query($query);
        } else {
            return false;
        }
    }

    public static function getProductById($productNo) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "SELECT * FROM products
                      INNER JOIN categories
                      ON products.CategoryNo = categories.CategoryNo
                      WHERE ProductNo = '$productNo'";
            $result = $dbConn->query($query);
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public static function addProduct($code, $name, $categoryNo, $cost) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "INSERT INTO products (ProductCode, ProductName, CategoryNo, ProductPrice)
                      VALUES ('$code', '$name', '$categoryNo', '$cost')";
            return $dbConn->query($query) === TRUE;
        } else {
            return false;
        }
    }

    public static function updateProduct($productNo, $code, $name, $categoryNo, $cost) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "UPDATE products SET
                      ProductCode = '$code',
                      ProductName = '$name',
                      CategoryNo = '$categoryNo',
                      ProductPrice = '$cost'
                      WHERE ProductNo = '$productNo'";
            return $dbConn->query($query) === TRUE;
        } else {
            return false;
        }
    }

    public static function deleteProduct($productNo) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "DELETE FROM products WHERE ProductNo = '$productNo'";
            return $dbConn->query($query) === TRUE;
        } else {
            return false;
        }
    }
}
?>
