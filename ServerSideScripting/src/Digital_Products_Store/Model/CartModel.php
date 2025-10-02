<?php
require_once 'BaseModel.php';
require_once 'ProductModel.php';

/**
 * Cart Model
 * Manages shopping cart operations
 */
class CartModel extends BaseModel {
    private $productModel;
    
    public function __construct() {
        $this->productModel = new ProductModel();
        $this->loadCart();
    }
    
    /**
     * Load cart from session
     */
    private function loadCart() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $this->data = $_SESSION['cart'];
    }
    
    /**
     * Add item to cart
     */
    public function addItem($productId, $quantity = 1) {
        $product = $this->productModel->getById($productId);
        if (!$product) {
            return false;
        }
        
        if (isset($this->data[$productId])) {
            $this->data[$productId] += $quantity;
        } else {
            $this->data[$productId] = $quantity;
        }
        
        $_SESSION['cart'] = $this->data;
        return true;
    }
    
    /**
     * Update item quantity
     */
    public function updateItem($productId, $quantity) {
        if ($quantity <= 0) {
            return $this->removeItem($productId);
        }
        
        if (isset($this->data[$productId])) {
            $this->data[$productId] = $quantity;
            $_SESSION['cart'] = $this->data;
            return true;
        }
        
        return false;
    }
    
    /**
     * Remove item from cart
     */
    public function removeItem($productId) {
        if (isset($this->data[$productId])) {
            unset($this->data[$productId]);
            $_SESSION['cart'] = $this->data;
            return true;
        }
        return false;
    }
    
    /**
     * Clear cart
     */
    public function clear() {
        $this->data = [];
        $_SESSION['cart'] = [];
    }
    
    /**
     * Get cart items with product details
     */
    public function getCartItems() {
        $items = [];
        foreach ($this->data as $productId => $quantity) {
            $product = $this->productModel->getById($productId);
            if ($product) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'total' => $product['price'] * $quantity
                ];
            }
        }
        return $items;
    }
    
    /**
     * Get cart total
     */
    public function getTotal() {
        $total = 0;
        foreach ($this->getCartItems() as $item) {
            $total += $item['total'];
        }
        return $total;
    }
    
    /**
     * Get cart count
     */
    public function getCount() {
        return array_sum($this->data);
    }
}
?>