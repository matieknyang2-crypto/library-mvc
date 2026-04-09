<?php
// public/index.php
session_start();

// Change to parent directory to load app files correctly
chdir(dirname(__DIR__));

// Simple autoloader
spl_autoload_register(function ($class) {
    $paths = [
        'app/controllers/',
        'app/models/',
    ];
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Routing
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home/index';
$url = explode('/', $url);

$controllerName = ucfirst($url[0]) . 'Controller';
$method = isset($url[1]) ? $url[1] : 'index';
$params = array_slice($url, 2);

// Default controller if not found
if (!file_exists('app/controllers/' . $controllerName . '.php')) {
    $controllerName = 'AuthController';
    $method = 'login';
}

require_once 'app/controllers/' . $controllerName . '.php';
$controller = new $controllerName();

if (method_exists($controller, $method)) {
    call_user_func_array([$controller, $method], $params);
} else {
    // Fallback to index
    call_user_func_array([$controller, 'index'], $params);
}
?>