<?php
session_start();

// Original sample data from your database
$products = [
    1 => [
        'ProductID' => 1,
        'ProductCode' => 'IP01',
        'ProductName' => 'Minimal Pastel',
        'ProductDescription' => 'Soft pastel icons for a clean home screen. Perfect for minimalist aesthetics.',
        'CategoryName' => 'Icon Packs',
        'Price' => 9.99,
        'ImageURL' => 'https://images.unsplash.com/photo-1611224923853-80b023f02d71?w=400&h=300&fit=crop',
        'FileSize' => '15MB'
    ],
    2 => [
        'ProductID' => 2,
        'ProductCode' => 'IP02',
        'ProductName' => 'Dark Academia',
        'ProductDescription' => 'Elegant, moody icons with a vintage feel. Inspired by classic literature and scholarly vibes.',
        'CategoryName' => 'Icon Packs',
        'Price' => 12.99,
        'ImageURL' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=300&fit=crop',
        'FileSize' => '18MB'
    ],
    3 => [
        'ProductID' => 3,
        'ProductCode' => 'IP03',
        'ProductName' => 'Kawaii Konvert',
        'ProductDescription' => 'Cute pink and earthy icons inspired by kawaii style. Adorable and functional.',
        'CategoryName' => 'Icon Packs',
        'Price' => 8.99,
        'ImageURL' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=300&fit=crop',
        'FileSize' => '12MB'
    ],
    4 => [
        'ProductID' => 4,
        'ProductCode' => 'IP04',
        'ProductName' => 'Cottagecore Magic',
        'ProductDescription' => 'Nature-inspired icons with cozy, cottage vibes. Brings the outdoors to your screen.',
        'CategoryName' => 'Icon Packs',
        'Price' => 11.99,
        'ImageURL' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=400&h=300&fit=crop',
        'FileSize' => '16MB'
    ],
    5 => [
        'ProductID' => 5,
        'ProductCode' => 'IP05',
        'ProductName' => 'Neon Tech',
        'ProductDescription' => 'Bright, glowing icons for a futuristic look. Perfect for tech enthusiasts.',
        'CategoryName' => 'Icon Packs',
        'Price' => 13.99,
        'ImageURL' => 'https://images.unsplash.com/photo-1518709268805-4e9042af2176?w=400&h=300&fit=crop',
        'FileSize' => '20MB'
    ],
    6 => [
        'ProductID' => 6,
        'ProductCode' => 'WP01',
        'ProductName' => 'Abstract Landscapes',
        'ProductDescription' => 'Stunning abstract landscape wallpapers in 4K resolution.',
        'CategoryName' => 'Wallpapers',
        'Price' => 5.99,
        'ImageURL' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=300&fit=crop',
        'FileSize' => '25MB'
    ],
    7 => [
        'ProductID' => 7,
        'ProductCode' => 'WP02',
        'ProductName' => 'Minimalist Gradients',
        'ProductDescription' => 'Clean gradient wallpapers for a modern look.',
        'CategoryName' => 'Wallpapers',
        'Price' => 4.99,
        'ImageURL' => 'https://images.unsplash.com/photo-1557683316-973673baf926?w=400&h=300&fit=crop',
        'FileSize' => '8MB'
    ],
    8 => [
        'ProductID' => 8,
        'ProductCode' => 'UK01',
        'ProductName' => 'Modern Dashboard UI',
        'ProductDescription' => 'Complete dashboard interface kit with components.',
        'CategoryName' => 'UI Kits',
        'Price' => 29.99,
        'ImageURL' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=300&fit=crop',
        'FileSize' => '45MB'
    ],
    9 => [
        'ProductID' => 9,
        'ProductCode' => 'FT01',
        'ProductName' => 'Handwritten Script Collection',
        'ProductDescription' => 'Beautiful handwritten fonts for personal and commercial use.',
        'CategoryName' => 'Fonts',
        'Price' => 15.99,
        'ImageURL' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=300&fit=crop',
        'FileSize' => '5MB'
    ],
    10 => [
        'ProductID' => 10,
        'ProductCode' => 'GR01',
        'ProductName' => 'Social Media Templates',
        'ProductDescription' => 'Instagram and social media design templates.',
        'CategoryName' => 'Graphics',
        'Price' => 19.99,
        'ImageURL' => 'https://images.unsplash.com/photo-1611224923853-80b023f02d71?w=400&h=300&fit=crop',
        'FileSize' => '35MB'
    ]
];

// Get cart items with product details
$cartItems = [];
$cartTotal = 0;

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        if (isset($products[$productId])) {
            $product = $products[$productId];
            $total = $product['Price'] * $quantity;
            $cartTotal += $total;
            
            $cartItems[] = [
                'ProductID' => $product['ProductID'],
                'ProductName' => $product['ProductName'],
                'ProductDescription' => $product['ProductDescription'],
                'ProductCode' => $product['ProductCode'],
                'CategoryName' => $product['CategoryName'],
                'Price' => $product['Price'],
                'FileSize' => $product['FileSize'],
                'ImageURL' => $product['ImageURL'],
                'Quantity' => $quantity,
                'Total' => $total
            ];
        }
    }
}

$cartCount = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Digital Products Store</title>
    <style>
        /* Elegant Cart Design with Refined Gradient */
        body {
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(90deg, #ff8a50 0%, #ff6b9d 25%, #c44569 50%, #8b5fbf 75%, #4a90e2 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        
        .elegant-header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 1.5rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        
        .elegant-header .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .elegant-logo {
            font-size: 2.5rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            letter-spacing: -1px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        .elegant-logo::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            border-radius: 8px;
            z-index: -1;
        }
        
        .elegant-nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .elegant-nav a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 400;
            font-size: 1rem;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }
        
        .elegant-nav a:hover {
            color: rgba(255, 255, 255, 1);
            background: rgba(255, 255, 255, 0.1);
        }
        
        .elegant-cart-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 400;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .elegant-cart-link:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .elegant-cart-count {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            border-radius: 50%;
            padding: 0.2rem 0.5rem;
            font-size: 0.8rem;
            font-weight: 600;
            min-width: 20px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .elegant-main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }
        
        .elegant-cart-title {
            font-size: 2.5rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 3rem;
            text-align: center;
            letter-spacing: -1px;
        }
        
        .elegant-cart-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 3rem;
            align-items: start;
        }
        
        .elegant-cart-items {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .elegant-cart-item {
            display: grid;
            grid-template-columns: 120px 1fr auto auto;
            gap: 1.5rem;
            align-items: center;
            padding: 2rem 0;
            border-bottom: 1px dashed rgba(255, 255, 255, 0.2);
        }
        
        .elegant-cart-item:last-child {
            border-bottom: none;
        }
        
        .elegant-item-image {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .elegant-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .elegant-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #ff8a50, #ff6b9d, #c44569, #8b5fbf);
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
        }
        
        .elegant-item-details {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .elegant-item-category {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
        }
        
        .elegant-item-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.95);
            margin: 0;
            line-height: 1.3;
        }
        
        .elegant-item-code {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
        }
        
        .elegant-item-remove {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .elegant-item-remove:hover {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(244, 67, 54, 0.8);
        }
        
        .elegant-item-price {
            text-align: right;
            font-size: 1.2rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.95);
        }
        
        .elegant-order-summary {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: sticky;
            top: 120px;
        }
        
        .elegant-summary-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 1.5rem;
        }
        
        .elegant-promo-section {
            margin-bottom: 2rem;
        }
        
        .elegant-promo-label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .elegant-promo-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            font-size: 0.95rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transition: border-color 0.3s ease;
        }
        
        .elegant-promo-input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.4);
        }
        
        .elegant-promo-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .elegant-price-breakdown {
            margin-bottom: 2rem;
        }
        
        .elegant-price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .elegant-price-row.total {
            font-size: 1.2rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.95);
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .elegant-checkout-btn {
            width: 100%;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 1rem 2rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .elegant-checkout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .elegant-empty-cart {
            text-align: center;
            padding: 4rem 2rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .elegant-empty-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            opacity: 0.6;
        }
        
        .elegant-empty-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 1rem;
        }
        
        .elegant-empty-text {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 2rem;
        }
        
        .elegant-browse-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            text-decoration: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .elegant-browse-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }
        
        .elegant-message {
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
            font-weight: 500;
            text-align: center;
        }
        
        .elegant-message.success {
            background: rgba(76, 175, 80, 0.2);
            color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(76, 175, 80, 0.3);
        }
        
        .elegant-message.error {
            background: rgba(244, 67, 54, 0.2);
            color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(244, 67, 54, 0.3);
        }
        
        @media (max-width: 768px) {
            .elegant-cart-layout {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .elegant-cart-item {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 1rem;
            }
            
            .elegant-item-image {
                width: 150px;
                height: 150px;
                margin: 0 auto;
            }
        }
    </style>
</head>
<body>
    <header class="elegant-header">
        <div class="container">
            <a href="/Digital_Products_Store/" class="elegant-logo">DIGITAL STORE</a>
            <nav class="elegant-nav">
                <a href="/Digital_Products_Store/">All Products</a>
                <a href="/Digital_Products_Store/cart.php" class="elegant-cart-link">
                    🛒 Cart <span class="elegant-cart-count"><?php echo $cartCount; ?></span>
                </a>
            </nav>
        </div>
    </header>

    <main class="elegant-main">
        <h1 class="elegant-cart-title">shopping cart</h1>

        <?php if (count($cartItems) > 0): ?>
            <div class="elegant-cart-layout">
                <div class="elegant-cart-items">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="elegant-cart-item" data-product-id="<?php echo $item['ProductID']; ?>">
                            <div class="elegant-item-image">
                                <?php if ($item['ImageURL']): ?>
                                    <img src="<?php echo htmlspecialchars($item['ImageURL']); ?>" 
                                         alt="<?php echo htmlspecialchars($item['ProductName']); ?>">
                                <?php else: ?>
                                    <div class="elegant-placeholder">
                                        <?php echo strtoupper(substr($item['ProductCode'], 0, 4)); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="elegant-item-details">
                                <div class="elegant-item-category"><?php echo htmlspecialchars($item['CategoryName']); ?></div>
                                <h3 class="elegant-item-title"><?php echo htmlspecialchars($item['ProductName']); ?></h3>
                                <div class="elegant-item-code">Code: <?php echo htmlspecialchars($item['ProductCode']); ?></div>
                            </div>
                            
                            <button type="button" class="elegant-item-remove remove-item" 
                                    data-product-id="<?php echo $item['ProductID']; ?>">
                                ×
                            </button>
                            
                            <div class="elegant-item-price">
                                $<?php echo number_format($item['Total'], 2); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="elegant-order-summary">
                    <h3 class="elegant-summary-title">Order Summary</h3>
                    
                    <div class="elegant-promo-section">
                        <label class="elegant-promo-label">enter promo code or gift card number</label>
                        <input type="text" class="elegant-promo-input" placeholder="Enter code">
                    </div>
                    
                    <div class="elegant-price-breakdown">
                        <div class="elegant-price-row">
                            <span>subtotal:</span>
                            <span>$<?php echo number_format($cartTotal, 2); ?></span>
                        </div>
                        <div class="elegant-price-row">
                            <span>estimated shipping:</span>
                            <span>$0.00</span>
                        </div>
                        <div class="elegant-price-row total">
                            <span>total:</span>
                            <span>$<?php echo number_format($cartTotal, 2); ?></span>
                        </div>
                    </div>
                    
                    <button type="button" class="elegant-checkout-btn" id="checkout-btn">checkout</button>
                </div>
            </div>
        <?php else: ?>
            <div class="elegant-empty-cart">
                <div class="elegant-empty-icon">🛒</div>
                <h3 class="elegant-empty-title">Your cart is empty</h3>
                <p class="elegant-empty-text">Add some amazing digital products to get started!</p>
                <a href="/Digital_Products_Store/" class="elegant-browse-btn">Browse Products</a>
            </div>
        <?php endif; ?>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Digital Products Store by Amber Lawson. Portfolio Project.</p>
        </div>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Remove item functionality
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                
                fetch('/Digital_Products_Store/cart_handler.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=remove&product_id=${productId}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update cart count
                        const cartCountElement = document.querySelector('.elegant-cart-count');
                        if (cartCountElement) {
                            cartCountElement.textContent = data.cartCount;
                        }
                        
                        // Remove item from display
                        const itemElement = this.closest('.elegant-cart-item');
                        itemElement.remove();
                        
                        // Check if cart is empty
                        const remainingItems = document.querySelectorAll('.elegant-cart-item');
                        if (remainingItems.length === 0) {
                            location.reload(); // Reload to show empty cart
                        }
                        
                        showMessage(data.message, 'success');
                    } else {
                        showMessage(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('An error occurred', 'error');
                });
            });
        });
        
        // Checkout functionality
        document.getElementById('checkout-btn')?.addEventListener('click', function() {
            showMessage('Checkout functionality coming soon!', 'success');
        });
        
        // Show message
        function showMessage(message, type) {
            // Create or update message element
            let messageEl = document.querySelector('.elegant-message');
            if (!messageEl) {
                messageEl = document.createElement('div');
                messageEl.className = 'elegant-message';
                document.querySelector('.elegant-main').insertBefore(messageEl, document.querySelector('.elegant-cart-layout, .elegant-empty-cart'));
            }
            
            messageEl.textContent = message;
            messageEl.className = `elegant-message ${type}`;
            
            // Auto-hide after 3 seconds
            setTimeout(() => {
                messageEl.remove();
            }, 3000);
        }
    });
    </script>
</body>
</html>
