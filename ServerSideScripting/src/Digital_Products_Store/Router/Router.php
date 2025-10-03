<?php
require_once __DIR__ . '/../Controller/ProductController.php';
require_once __DIR__ . '/../Controller/CartController.php';

/**
 * Router Class
 * Handles URL routing and dispatches requests to appropriate controllers
 */
class Router {
    private $routes = [];
    
    public function __construct() {
        $this->setupRoutes();
    }
    
    /**
     * Setup route patterns
     */
    private function setupRoutes() {
        $this->routes = [
            'GET' => [
                '/' => ['ProductController', 'index'],
                '/category/(\d+)' => ['ProductController', 'category'],
                '/product/(\d+)' => ['ProductController', 'show'],
                '/cart' => ['CartController', 'index']
            ],
            'POST' => [
                '/cart/add' => ['CartController', 'add'],
                '/cart/update' => ['CartController', 'update'],
                '/cart/remove' => ['CartController', 'remove'],
                '/cart/clear' => ['CartController', 'clear'],
                '/cart/count' => ['CartController', 'count']
            ]
        ];
    }
    
    /**
     * Route the request
     */
    public function route() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remove base path if needed
        $basePath = '/Digital_Products_Store';
        if (strpos($path, $basePath) === 0) {
            $path = substr($path, strlen($basePath));
        }
        
        // Handle direct access to mvc.php
        if ($path === '/mvc.php') {
            $path = '/';
        }
        
        // Handle cart page via query parameter
        if (isset($_GET['page']) && $_GET['page'] === 'cart') {
            $path = '/cart';
        }
        
        // Handle root path
        if ($path === '') {
            $path = '/';
        }
        
        // Handle POST requests with action parameter
        if ($method === 'POST' && isset($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                case 'add':
                    $this->dispatch(['CartController', 'add']);
                    return;
                case 'update':
                    $this->dispatch(['CartController', 'update']);
                    return;
                case 'remove':
                    $this->dispatch(['CartController', 'remove']);
                    return;
                case 'clear':
                    $this->dispatch(['CartController', 'clear']);
                    return;
                case 'count':
                    $this->dispatch(['CartController', 'count']);
                    return;
            }
        }
        
        // Check for exact matches first
        if (isset($this->routes[$method][$path])) {
            $this->dispatch($this->routes[$method][$path]);
            return;
        }
        
        // Check for pattern matches
        foreach ($this->routes[$method] as $pattern => $handler) {
            if ($pattern !== $path && preg_match('#^' . $pattern . '$#', $path, $matches)) {
                array_shift($matches); // Remove full match
                $this->dispatch($handler, $matches);
                return;
            }
        }
        
        // No route found
        $this->handle404();
    }
    
    /**
     * Dispatch request to controller
     */
    private function dispatch($handler, $params = []) {
        list($controllerName, $method) = $handler;
        
        $controller = new $controllerName();
        
        if (method_exists($controller, $method)) {
            call_user_func_array([$controller, $method], $params);
        } else {
            $this->handle404();
        }
    }
    
    /**
     * Handle 404 errors
     */
    private function handle404() {
        http_response_code(404);
        echo "Page not found";
        exit();
    }
}
