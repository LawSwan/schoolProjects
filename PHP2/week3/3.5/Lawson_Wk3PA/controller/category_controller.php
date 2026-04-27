<?php
require_once(__DIR__ . '/category.php');
require_once(__DIR__ . '/../model/category_db.php');

class CategoryController {
    public static function getAllCategories() {
        $queryRes = CategoryDB::getCategories();

        if ($queryRes) {
            $categories = array();

            foreach ($queryRes as $row) {
                $categories[] = new Category(
                    $row['CategoryNo'],
                    $row['CategoryName']
                );
            }

            return $categories;
        } else {
            return false;
        }
    }

    public static function getCategoryById($categoryNo) {
        $row = CategoryDB::getCategoryById($categoryNo);

        if ($row) {
            return new Category(
                $row['CategoryNo'],
                $row['CategoryName']
            );
        } else {
            return false;
        }
    }
}
?>
