<?php

class Router {
    protected $routes = [];

    public function __construct() {
        // Include routes
        require_once __DIR__ . '/../routes/web.php';
    }

    public function add($route, $action) {
        $this->routes[$route] = $action;
    }

    public function route() {
        $uri = trim($_SERVER['REQUEST_URI'], '/');

        // If route exists, call corresponding controller method
        if (array_key_exists($uri, $this->routes)) {
            list($controller, $method) = explode('@', $this->routes[$uri]);
            $controller = 'App\\Controllers\\' . $controller;
            $controllerObject = new $controller();
            call_user_func_array([$controllerObject, $method], []);
        } else {
            // Show 404 error if route is not found
            echo '404 - Not Found';
        }
    }
}
