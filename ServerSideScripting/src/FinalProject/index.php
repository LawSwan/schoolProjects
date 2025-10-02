<?php
// Main entry point for the consolidated MVC application
require_once 'config/config.php';
require_once 'Router/Router.php';

// Start session for the entire application
session_start();

// Create router instance
$router = new Router();

// Define routes for all weeks
$router->addRoute('', 'DashboardController', 'index');
$router->addRoute('dashboard', 'DashboardController', 'index');
$router->addRoute('week2', 'Week2Controller', 'index');
$router->addRoute('week3', 'AddressController', 'index');
$router->addRoute('week3/create', 'AddressController', 'create');
$router->addRoute('week3/edit', 'AddressController', 'edit');
$router->addRoute('week3/delete', 'AddressController', 'delete');
$router->addRoute('week4', 'ProductController', 'index');
$router->addRoute('week4/products', 'ProductController', 'products');
$router->addRoute('week4/users', 'ProductController', 'users');
$router->addRoute('week5', 'SessionController', 'index');
$router->addRoute('week5/cookies', 'SessionController', 'cookies');
$router->addRoute('week5/sessions', 'SessionController', 'sessions');
$router->addRoute('personal_info', 'PersonalInfoController', 'index');

// Handle the request
$router->handleRequest();

