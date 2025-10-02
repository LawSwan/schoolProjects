<?php
class Router {
    private $routes = [];
    
    public function addRoute($path, $controller, $method) {
        $this->routes[$path] = [
            'controller' => $controller,
            'method' => $method
        ];
    }
    
    public function handleRequest() {
        $path = $this->getPath();
        
        if (isset($this->routes[$path])) {
            $route = $this->routes[$path];
            $controllerName = $route['controller'];
            $method = $route['method'];
            
            // Include the controller file
            $controllerFile = __DIR__ . '/../Controller/' . $controllerName . '.php';
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                
                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $method)) {
                        $controller->$method();
                    } else {
                        $this->show404("Method $method not found in $controllerName");
                    }
                } else {
                    $this->show404("Controller $controllerName not found");
                }
            } else {
                $this->show404("Controller file not found: $controllerFile");
            }
        } else {
            $this->show404("Route not found: $path");
        }
    }
    
    private function getPath() {
        $path = $_GET['page'] ?? '';
        return trim($path, '/');
    }
    
    private function show404($message = "Page not found") {
        http_response_code(404);
        echo "<h1>404 - Not Found</h1>";
        echo "<p>$message</p>";
        echo "<a href='?page=dashboard'>Return to Dashboard</a>";
    }
}
