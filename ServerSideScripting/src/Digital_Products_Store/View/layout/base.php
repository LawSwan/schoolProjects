<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title . ' - ' : ''; ?>Digital Products Store</title>
    <style>
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
        .elegant-nav a:hover, .elegant-nav a.active {
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
    </style>
    <?php if (isset($additionalCSS)): ?>
        <style><?php echo $additionalCSS; ?></style>
    <?php endif; ?>
</head>
<body>
    <header class="elegant-header">
        <div class="container">
            <a href="/Digital_Products_Store/" class="elegant-logo">DIGITAL STORE</a>
            <nav class="elegant-nav">
                <a href="/Digital_Products_Store/" class="<?php echo (!isset($currentPage) || $currentPage === 'home') ? 'active' : ''; ?>">All Products</a>
                <a href="/Digital_Products_Store/cart" class="elegant-cart-link">
                    🛒 Cart <span class="elegant-cart-count" id="cartCount"><?php echo isset($cartCount) ? $cartCount : 0; ?></span>
                </a>
            </nav>
        </div>
    </header>

    <main class="elegant-main">
        <?php echo $content; ?>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Digital Products Store by Amber Lawson. Portfolio Project.</p>
        </div>
    </footer>

    <script>
        // Update cart count on page load
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/Digital_Products_Store/cart/count')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const cartCountElement = document.getElementById('cartCount');
                        if (cartCountElement) {
                            cartCountElement.textContent = data.cartCount;
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
    <?php if (isset($additionalJS)): ?>
        <script><?php echo $additionalJS; ?></script>
    <?php endif; ?>
</body>
</html>

