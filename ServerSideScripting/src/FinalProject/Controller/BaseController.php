<?php
class BaseController {
    protected function render($view, $data = []) {
        // Extract data array to variables
        extract($data);
        
        // Start output buffering
        ob_start();
        
        // Include the view file
        $viewFile = __DIR__ . '/../View/' . $view . '.php';
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            throw new Exception("View file not found: $viewFile");
        }
        
        // Get the content
        $content = ob_get_clean();
        
        // Include the layout
        include __DIR__ . '/../View/layout/base.php';
    }
    
    protected function redirect($url) {
        header("Location: index.php?page=$url");
        exit();
    }
    
    protected function getPost($key, $default = '') {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }
    
    protected function getGet($key, $default = '') {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }
    
    protected function setFlashMessage($type, $message) {
        $_SESSION['flash_message'] = [
            'type' => $type,
            'message' => $message
        ];
    }
    
    protected function getFlashMessage() {
        if (isset($_SESSION['flash_message'])) {
            $message = $_SESSION['flash_message'];
            unset($_SESSION['flash_message']);
            return $message;
        }
        return null;
    }
}
?>

