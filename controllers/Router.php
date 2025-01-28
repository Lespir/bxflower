<?php
require_once 'ProductController.php';
require_once 'OrderController.php';

class Router {
    private $routes = [
        '' => 'ProductController@index',
        'products' => 'ProductController@index',
        'product' => 'ProductController@show',
        'order' => 'OrderController@create',
        'order/submit' => 'OrderController@store'
    ];

    public function run() {
        // Get the full request URI
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        
        // Parse the URL to separate the path and query string
        $urlParts = explode('?', $uri);
        $path = $urlParts[0]; // This is the path without query parameters
        parse_str($urlParts[1] ?? '', $_GET); // This will populate the $_GET superglobal with query parameters
    
        // Match the route
        $route = $this->routes[$path] ?? null;
    
        if ($route) {
            list($controller, $method) = explode('@', $route);
            (new $controller())->$method();
        } else {
            http_response_code(404);
            echo '404 Not Found';
        }
    }
}