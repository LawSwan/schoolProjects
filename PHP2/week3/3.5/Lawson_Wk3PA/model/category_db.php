<?php
require_once(__DIR__ . '/database.php');

class CategoryDB {
    public static function getCategories() {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = 'SELECT * FROM categories ORDER BY CategoryName';
            return $dbConn->query($query);
        } else {
            return false;
        }
    }

    public static function getCategoryById($categoryNo) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "SELECT * FROM categories WHERE CategoryNo = '$categoryNo'";
            $result = $dbConn->query($query);
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
}
?>
