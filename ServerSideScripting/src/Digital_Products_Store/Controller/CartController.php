<?php
require_once 'BaseController.php';
require_once __DIR__ . '/../Model/CartModel.php';

/**
 * Cart Controller
 * Handles cart-related requests
 */
class CartController extends BaseController {
    private $cartModel;
    
    public function __construct() {
        $this->cartModel = new CartModel();
    }
    
    /**
     * Show cart page
     */
    public function index() {
        $cartItems = $this->cartModel->getCartItems();
        $cartTotal = $this->cartModel->getTotal();
        $cartCount = $this->cartModel->getCount();
        
        $this->loadView('cart/index', [
            'cartItems' => $cartItems,
            'cartTotal' => $cartTotal,
            'cartCount' => $cartCount
        ]);
    }
    
    /**
     * Add item to cart (AJAX)
     */
    public function add() {
        $productId = (int)$this->getPost('product_id');
        $quantity = (int)$this->getPost('quantity', 1);
        
        if ($productId && $quantity > 0) {
            $success = $this->cartModel->addItem($productId, $quantity);
            if ($success) {
                $this->jsonResponse([
                    'success' => true,
                    'message' => 'Product added to cart!',
                    'cartCount' => $this->cartModel->getCount()
                ]);
            } else {
                $this->jsonResponse([
                    'success' => false,
                    'message' => 'Product not found'
                ]);
            }
        } else {
            $this->jsonResponse([
                'success' => false,
                'message' => 'Invalid product ID or quantity'
            ]);
        }
    }
    
    /**
     * Update item quantity (AJAX)
     */
    public function update() {
        $productId = (int)$this->getPost('product_id');
        $quantity = (int)$this->getPost('quantity');
        
        if ($productId) {
            $success = $this->cartModel->updateItem($productId, $quantity);
            if ($success) {
                $this->jsonResponse([
                    'success' => true,
                    'message' => 'Cart updated!',
                    'cartCount' => $this->cartModel->getCount()
                ]);
            } else {
                $this->jsonResponse([
                    'success' => false,
                    'message' => 'Product not found in cart'
                ]);
            }
        } else {
            $this->jsonResponse([
                'success' => false,
                'message' => 'Invalid product ID'
            ]);
        }
    }
    
    /**
     * Remove item from cart (AJAX)
     */
    public function remove() {
        $productId = (int)$this->getPost('product_id');
        
        if ($productId) {
            $success = $this->cartModel->removeItem($productId);
            if ($success) {
                $this->jsonResponse([
                    'success' => true,
                    'message' => 'Product removed from cart!',
                    'cartCount' => $this->cartModel->getCount()
                ]);
            } else {
                $this->jsonResponse([
                    'success' => false,
                    'message' => 'Product not found in cart'
                ]);
            }
        } else {
            $this->jsonResponse([
                'success' => false,
                'message' => 'Invalid product ID'
            ]);
        }
    }
    
    /**
     * Clear cart (AJAX)
     */
    public function clear() {
        $this->cartModel->clear();
        $this->jsonResponse([
            'success' => true,
            'message' => 'Cart cleared!',
            'cartCount' => 0
        ]);
    }
    
    /**
     * Get cart count (AJAX)
     */
    public function count() {
        $this->jsonResponse([
            'success' => true,
            'cartCount' => $this->cartModel->getCount()
        ]);
    }
}