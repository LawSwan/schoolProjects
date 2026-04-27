<?php
// Category model class
class Category {
    private $categoryNo;
    private $categoryName;

    public function __construct($categoryNo, $categoryName) {
        $this->categoryNo = $categoryNo;
        $this->categoryName = $categoryName;
    }

    public function getCategoryNo() {
        return $this->categoryNo;
    }

    public function setCategoryNo($categoryNo) {
        $this->categoryNo = $categoryNo;
    }

    public function getCategoryName() {
        return $this->categoryName;
    }

    public function setCategoryName($categoryName) {
        $this->categoryName = $categoryName;
    }
}
?>
