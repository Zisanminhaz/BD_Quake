<?php
// Start session for login system
session_start();

// Load config and core classes
require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__) . '/core/Database.php';

// Simple router: ?controller=home&action=index
$controllerParam = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

$controllerName = ucfirst(strtolower($controllerParam)) . 'Controller';
$controllerFile = APP_ROOT . '/controllers/' . $controllerName . '.php';

if (!file_exists($controllerFile)) {
    http_response_code(404);
    echo "Controller '$controllerName' not found.";
    exit;
}

require_once $controllerFile;

if (!class_exists($controllerName)) {
    http_response_code(500);
    echo "Controller class '$controllerName' not defined.";
    exit;
}

$controller = new $controllerName();

if (!method_exists($controller, $action)) {
    http_response_code(404);
    echo "Action '$action' not found in controller '$controllerName'.";
    exit;
}

// Call the controller action
$controller->$action();
