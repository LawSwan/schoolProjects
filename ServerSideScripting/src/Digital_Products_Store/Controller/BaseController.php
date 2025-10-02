<?php
/**
 * Base Controller Class
 * Provides common functionality for all controllers
 */
abstract class BaseController {
    protected $data = [];
    
    /**
     * Load a view
     */
    protected function loadView($viewName, $data = []) {
        $this->data = array_merge($this->data, $data);
        
        // Extract data to variables for the view
        extract($this->data);
        
        $viewPath = __DIR__ . '/../View/' . $viewName . '.php';
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            throw new Exception("View not found: $viewName");
        }
    }
    
    /**
     * Redirect to a URL
     */
    protected function redirect($url) {
        header("Location: $url");
        exit();
    }
    
    /**
     * Return JSON response
     */
    protected function jsonResponse($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
    
    /**
     * Get POST data
     */
    protected function getPost($key = null, $default = null) {
        if ($key === null) {
            return $_POST;
        }
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }
    
    /**
     * Get GET data
     */
    protected function getGet($key = null, $default = null) {
        if ($key === null) {
            return $_GET;
        }
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }
}
?>

