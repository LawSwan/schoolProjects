<?php
require_once(__DIR__ . '/category.php');

// Product model class
class Product {
    private $productNo;
    private $productCode;
    private $productName;
    private $category;
    private $productCost;

    public function __construct($productCode, $productName, $category, $productCost) {
        $this->productCode = $productCode;
        $this->productName = $productName;
        $this->category = $category;
        $this->productCost = $productCost;
    }

    public function getProductNo() {
        return $this->productNo;
    }

    public function setProductNo($productNo) {
        $this->productNo = $productNo;
    }

    public function getProductCode() {
        return $this->productCode;
    }

    public function setProductCode($productCode) {
        $this->productCode = $productCode;
    }

    public function getProductName() {
        return $this->productName;
    }

    public function setProductName($productName) {
        $this->productName = $productName;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function getProductCost() {
        return $this->productCost;
    }

    public function setProductCost($productCost) {
        $this->productCost = $productCost;
    }
}
?>
