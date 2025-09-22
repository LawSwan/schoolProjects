<?php
// Digital Products Store - Main Front End
require_once 'db_connection.php';

// Get all categories for navigation (only categories that have products)
$categories_query = "SELECT DISTINCT c.CategoryID, c.CategoryName 
                     FROM categories c 
                     INNER JOIN digital_products dp ON c.CategoryID = dp.CategoryID 
                     WHERE c.IsActive = 1 AND dp.IsActive = 1 
                     ORDER BY c.CategoryName";
$categories_result = mysqli_query($conn, $categories_query);

// Get featured products (limit to 8 for homepage)
$products_query = "SELECT dp.*, c.CategoryName 
                   FROM digital_products dp 
                   JOIN categories c ON dp.CategoryID = c.CategoryID 
                   WHERE dp.IsActive = 1 
                   ORDER BY dp.CreatedDate DESC 
                   LIMIT 8";
$products_result = mysqli_query($conn, $products_query);

// Get filter parameter
$category_filter = isset($_GET['category']) ? (int)$_GET['category'] : 0;

// If category filter is applied, get products for that category
if ($category_filter > 0) {
    $filtered_query = "SELECT dp.*, c.CategoryName 
                       FROM digital_products dp 
                       JOIN categories c ON dp.CategoryID = c.CategoryID 
                       WHERE dp.IsActive = 1 AND dp.CategoryID = $category_filter 
                       ORDER BY dp.ProductName";
    $products_result = mysqli_query($conn, $filtered_query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $category_filter > 0 ? 'Category Products' : 'Featured Products'; ?> - Digital Products Store</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav {
            display: flex;
            gap: 2rem;
            align-items: center;
            position: relative;
        }

        .nav-item {
            position: relative;
        }

        .nav a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            padding: 0.7rem 1.5rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .nav a:hover, .nav a.active {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            transform: translateY(-2px);
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-toggle {
            cursor: pointer;
            user-select: none;
        }

        .dropdown-toggle:after {
            content: ' ▼';
            font-size: 0.8em;
            margin-left: 0.5rem;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            min-width: 200px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            border-radius: 10px;
            padding: 0.5rem 0;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu a {
            display: block;
            padding: 0.7rem 1.5rem;
            color: #333;
            text-decoration: none;
            border-radius: 0;
            transition: all 0.2s ease;
        }

        .dropdown-menu a:hover {
            background: #f8f9fa;
            color: #667eea;
            transform: translateX(5px);
        }

        .hero {
            text-align: center;
            padding: 4rem 0;
            color: white;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        .main-content {
            background: white;
            border-radius: 20px 20px 0 0;
            min-height: 60vh;
            margin-top: 2rem;
            padding: 3rem 0;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 3rem;
            font-size: 1.1rem;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid #f0f0f0;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .product-image {
            height: 200px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-category {
            color: #667eea;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .product-title {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .product-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
        }

        .product-size {
            font-size: 0.8rem;
            color: #999;
        }

        .btn {
            padding: 0.7rem 1.5rem;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .filters {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.7rem 1.5rem;
            border: 2px solid #667eea;
            background: white;
            color: #667eea;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .filter-btn:hover, .filter-btn.active {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            border-radius: 15px;
            border: 1px solid rgba(102, 126, 234, 0.2);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-weight: 600;
        }

        .footer {
            text-align: center;
            padding: 2rem;
            background: #333;
            color: white;
            margin-top: 3rem;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }

            .nav {
                gap: 1rem;
            }

            .header-content {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">Digital Store</div>
                <nav class="nav">
                    <a href="?" <?php echo !$category_filter ? 'class="active"' : ''; ?>>All Products</a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle <?php echo $category_filter ? 'active' : ''; ?>">Categories</a>
                        <div class="dropdown-menu">
                            <?php 
                            // Reset result pointer to display categories in dropdown
                            mysqli_data_seek($categories_result, 0);
                            while ($category = mysqli_fetch_assoc($categories_result)): 
                            ?>
                                <a href="?category=<?php echo $category['CategoryID']; ?>" 
                                   <?php echo $category_filter == $category['CategoryID'] ? 'class="active"' : ''; ?>>
                                    <?php echo htmlspecialchars($category['CategoryName']); ?>
                                </a>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1><?php echo $category_filter > 0 ? 'Category Products' : 'Digital Products Store'; ?></h1>
            <p><?php echo $category_filter > 0 ? 'Browse our curated collection in this category' : 'Premium digital products for creators, designers, and tech enthusiasts'; ?></p>
        </div>
    </section>

    <main class="main-content">
        <div class="container">
            <?php if (!$category_filter): ?>
                <!-- Statistics Section -->
                <div class="stats">
                    <?php
                    // Get some quick stats
                    $total_products = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM digital_products WHERE IsActive = 1"))['count'];
                    $total_categories = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM categories WHERE IsActive = 1"))['count'];
                    $avg_price = mysqli_fetch_assoc(mysqli_query($conn, "SELECT AVG(Price) as avg FROM digital_products WHERE IsActive = 1"))['avg'];
                    ?>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo $total_products; ?></div>
                        <div class="stat-label">Digital Products</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo $total_categories; ?></div>
                        <div class="stat-label">Categories</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">$<?php echo number_format($avg_price, 0); ?></div>
                        <div class="stat-label">Average Price</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">Premium</div>
                        <div class="stat-label">Quality</div>
                    </div>
                </div>
            <?php endif; ?>

            <h2 class="section-title">
                <?php echo $category_filter > 0 ? 'Category Products' : 'Featured Products'; ?>
            </h2>
            <p class="section-subtitle">
                <?php echo $category_filter > 0 ? 'Discover amazing products in this category' : 'Handpicked digital products to boost your creativity'; ?>
            </p>

            <div class="products-grid">
                <?php if (mysqli_num_rows($products_result) > 0): ?>
                    <?php while ($product = mysqli_fetch_assoc($products_result)): ?>
                        <div class="product-card">
                            <div class="product-image">
                                <?php echo strtoupper(substr($product['ProductCode'], 0, 4)); ?>
                            </div>
                            <div class="product-info">
                                <div class="product-category"><?php echo htmlspecialchars($product['CategoryName']); ?></div>
                                <h3 class="product-title"><?php echo htmlspecialchars($product['ProductName']); ?></h3>
                                <p class="product-description"><?php echo htmlspecialchars($product['ProductDescription']); ?></p>
                                <div class="product-footer">
                                    <div>
                                        <div class="product-price">$<?php echo number_format($product['Price'], 2); ?></div>
                                        <div class="product-size"><?php echo htmlspecialchars($product['FileSize']); ?></div>
                                    </div>
                                    <a href="#" class="btn btn-primary" onclick="alert('Purchase functionality coming soon!')">
                                        Buy Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                        <h3>No products found</h3>
                        <p>Try browsing a different category.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Digital Products Store by Amber Lawson. Portfolio Project.</p>
        </div>
    </footer>
</body>
</html>

<?php
mysqli_close($conn);
?>
