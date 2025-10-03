<?php
require_once 'BaseController.php';
require_once __DIR__ . '/../Model/ProductModel.php';
require_once __DIR__ . '/../Model/CategoryModel.php';

/**
 * Product Controller
 * Handles product-related requests
 */
class ProductController extends BaseController {
    private $productModel;
    private $categoryModel;
    
    public function __construct() {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }
    
    /**
     * Show all products
     */
    public function index() {
        $products = $this->productModel->getAll();
        $categories = $this->categoryModel->getAll();
        
        $this->loadView('product/index', [
            'products' => $products,
            'categories' => $categories,
            'title' => 'All Products'
        ]);
    }
    
    /**
     * Show products by category
     */
    public function category($categoryId) {
        $products = $this->productModel->getByCategory($categoryId);
        $categories = $this->categoryModel->getAll();
        $currentCategory = $this->categoryModel->getById($categoryId);
        
        $this->loadView('product/index', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $currentCategory,
            'title' => $currentCategory ? $currentCategory['name'] : 'Products'
        ]);
    }
    
    /**
     * Show single product
     */
    public function show($productId) {
        $product = $this->productModel->getById($productId);
        if (!$product) {
            $this->redirect('/Digital_Products_Store/');
        }
        
        $relatedProducts = $this->productModel->getByCategory($product['category_id']);
        // Remove current product from related products
        $relatedProducts = array_filter($relatedProducts, function($p) use ($productId) {
            return $p['id'] != $productId;
        });
        $relatedProducts = array_slice($relatedProducts, 0, 4); // Limit to 4
        
        $this->loadView('product/show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ]);
    }
}

