<?php
session_start();

// Original sample data from your database
$products = [
    1 => ['ProductName' => 'Minimal Pastel', 'Price' => 9.99],
    2 => ['ProductName' => 'Dark Academia', 'Price' => 12.99],
    3 => ['ProductName' => 'Kawaii Konvert', 'Price' => 8.99],
    4 => ['ProductName' => 'Cottagecore Magic', 'Price' => 11.99],
    5 => ['ProductName' => 'Neon Tech', 'Price' => 13.99],
    6 => ['ProductName' => 'Abstract Landscapes', 'Price' => 5.99],
    7 => ['ProductName' => 'Minimalist Gradients', 'Price' => 4.99],
    8 => ['ProductName' => 'Modern Dashboard UI', 'Price' => 29.99],
    9 => ['ProductName' => 'Handwritten Script Collection', 'Price' => 15.99],
    10 => ['ProductName' => 'Social Media Templates', 'Price' => 19.99]
];

$action = $_POST['action'] ?? $_GET['action'] ?? '';

header('Content-Type: application/json');

switch ($action) {
    case 'add':
        $productId = (int)($_POST['product_id'] ?? $_GET['product_id'] ?? 0);
        $quantity = (int)($_POST['quantity'] ?? $_GET['quantity'] ?? 1);
        
        if ($productId && $quantity > 0 && isset($products[$productId])) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId] += $quantity;
            } else {
                $_SESSION['cart'][$productId] = $quantity;
            }
            
            $cartCount = array_sum($_SESSION['cart']);
            echo json_encode([
                'success' => true,
                'message' => $products[$productId]['ProductName'] . ' added to cart!',
                'cartCount' => $cartCount
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }
        break;
        
    case 'update':
        $productId = (int)($_POST['product_id'] ?? $_GET['product_id'] ?? 0);
        $quantity = (int)($_POST['quantity'] ?? $_GET['quantity'] ?? 0);
        
        if ($productId && isset($_SESSION['cart'][$productId])) {
            if ($quantity <= 0) {
                unset($_SESSION['cart'][$productId]);
            } else {
                $_SESSION['cart'][$productId] = $quantity;
            }
            
            $cartCount = array_sum($_SESSION['cart']);
            echo json_encode([
                'success' => true,
                'message' => 'Cart updated!',
                'cartCount' => $cartCount
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Product not found in cart'
            ]);
        }
        break;
        
    case 'remove':
        $productId = (int)($_POST['product_id'] ?? $_GET['product_id'] ?? 0);
        
        if ($productId && isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
            $cartCount = array_sum($_SESSION['cart']);
            echo json_encode([
                'success' => true,
                'message' => 'Product removed from cart!',
                'cartCount' => $cartCount
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Product not found in cart'
            ]);
        }
        break;
        
    case 'clear':
        $_SESSION['cart'] = [];
        echo json_encode([
            'success' => true,
            'message' => 'Cart cleared!',
            'cartCount' => 0
        ]);
        break;
        
    case 'count':
        $cartCount = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
        echo json_encode([
            'success' => true,
            'cartCount' => $cartCount
        ]);
        break;
        
    default:
        echo json_encode([
            'success' => false,
            'message' => 'Invalid action'
        ]);
}
?>
