<?php
session_start();

require_once __DIR__ . '/Model/ProductModel.php';

// Get products from ProductModel to ensure consistency
$productModel = new ProductModel();
$allProducts = $productModel->getAll();
$products = [];
foreach ($allProducts as $product) {
    $products[$product['id']] = [
        'name' => $product['name'],
        'price' => $product['price']
    ];
}

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
                'message' => $products[$productId]['name'] . ' added to cart!',
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
