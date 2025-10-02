<?php
require_once 'BaseController.php';
require_once __DIR__ . '/../Model/ProductModel.php';

class ProductController extends BaseController {
    private $productModel;
    
    public function __construct() {
        $this->productModel = new ProductModel();
    }
    
    public function index() {
        $action = $this->getGet('action');
        
        // Handle POST requests
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest();
            return;
        }
        
        // Handle GET actions
        if ($action === 'delete_product') {
            $this->deleteProduct();
            return;
        }
        
        // Get data for display
        $products = $this->productModel->getAllProducts();
        $users = $this->productModel->getAllUsers();
        $purchases = $this->productModel->getAllPurchases();
        $usersWithPurchases = $this->productModel->getUsersWithPurchases();
        
        $editProduct = null;
        if ($action === 'edit_product') {
            $id = $this->getGet('id');
            $editProduct = $this->productModel->getProductById($id);
        }
        
        $flashMessage = $this->getFlashMessage();
        
        $this->render('week4/index', [
            'pageTitle' => 'Week 4 - Products & Database Operations',
            'products' => $products,
            'users' => $users,
            'purchases' => $purchases,
            'usersWithPurchases' => $usersWithPurchases,
            'editProduct' => $editProduct,
            'flashMessage' => $flashMessage
        ]);
    }
    
    private function handlePostRequest() {
        $action = $this->getPost('action');
        
        switch ($action) {
            case 'create_product':
                $this->createProduct();
                break;
            case 'update_product':
                $this->updateProduct();
                break;
            case 'create_user':
                $this->createUser();
                break;
            case 'create_purchase':
                $this->createPurchase();
                break;
        }
    }
    
    private function createProduct() {
        $name = trim($this->getPost('name'));
        $price = $this->getPost('price');
        
        if (empty($name) || empty($price)) {
            $this->setFlashMessage('error', 'Product name and price are required.');
            $this->redirect('week4');
            return;
        }
        
        if (!is_numeric($price) || $price <= 0) {
            $this->setFlashMessage('error', 'Price must be a positive number.');
            $this->redirect('week4');
            return;
        }
        
        try {
            $this->productModel->createProduct($name, $price);
            $this->setFlashMessage('success', 'Product created successfully!');
        } catch (Exception $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $this->setFlashMessage('error', 'Product name already exists. Please choose a different name.');
            } else {
                $this->setFlashMessage('error', 'Error creating product: ' . $e->getMessage());
            }
        }
        
        $this->redirect('week4');
    }
    
    private function updateProduct() {
        $id = $this->getPost('id');
        $name = trim($this->getPost('name'));
        $price = $this->getPost('price');
        
        if (empty($name) || empty($price)) {
            $this->setFlashMessage('error', 'Product name and price are required.');
            $this->redirect('week4');
            return;
        }
        
        if (!is_numeric($price) || $price <= 0) {
            $this->setFlashMessage('error', 'Price must be a positive number.');
            $this->redirect('week4');
            return;
        }
        
        try {
            $this->productModel->updateProduct($id, $name, $price);
            $this->setFlashMessage('success', 'Product updated successfully!');
        } catch (Exception $e) {
            $this->setFlashMessage('error', 'Error updating product: ' . $e->getMessage());
        }
        
        $this->redirect('week4');
    }
    
    private function deleteProduct() {
        $id = $this->getGet('id');
        
        if ($id) {
            try {
                $this->productModel->deleteProduct($id);
                $this->setFlashMessage('success', 'Product deleted successfully!');
            } catch (Exception $e) {
                $this->setFlashMessage('error', 'Error deleting product: ' . $e->getMessage());
            }
        }
        
        $this->redirect('week4');
    }
    
    private function createUser() {
        $name = trim($this->getPost('name'));
        $email = trim($this->getPost('email'));
        
        if (empty($name)) {
            $this->setFlashMessage('error', 'Name is required.');
            $this->redirect('week4');
            return;
        }
        
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->setFlashMessage('error', 'Please enter a valid email address.');
            $this->redirect('week4');
            return;
        }
        
        try {
            $this->productModel->createUser($name, $email);
            $this->setFlashMessage('success', 'User created successfully!');
        } catch (Exception $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $this->setFlashMessage('error', 'Name already exists. Please use a different name.');
            } else {
                $this->setFlashMessage('error', 'Error creating user: ' . $e->getMessage());
            }
        }
        
        $this->redirect('week4');
    }
    
    private function createPurchase() {
        $userId = $this->getPost('user_id');
        $productId = $this->getPost('product_id');
        $quantity = $this->getPost('quantity', 1);
        
        if (empty($userId) || empty($productId)) {
            $this->setFlashMessage('error', 'Please select both user and product.');
            $this->redirect('week4');
            return;
        }
        
        if (!is_numeric($quantity) || $quantity <= 0) {
            $this->setFlashMessage('error', 'Quantity must be a positive number.');
            $this->redirect('week4');
            return;
        }
        
        try {
            $this->productModel->createPurchase($userId, $productId, $quantity);
            $this->setFlashMessage('success', 'Purchase recorded successfully!');
        } catch (Exception $e) {
            $this->setFlashMessage('error', 'Error recording purchase: ' . $e->getMessage());
        }
        
        $this->redirect('week4');
    }
}
?>

