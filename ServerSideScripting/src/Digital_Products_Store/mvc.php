<?php
session_start();

require_once __DIR__ . '/Router/Router.php';

try {
    $router = new Router();
    $router->route();
} catch (Exception $e) {
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}
?>

