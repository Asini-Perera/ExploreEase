<?php

class Router
{
    protected $routes = [];

    public function add($route, $action)
    {
        $this->routes[$route] = $action;
    }

    public function route()
    {
        // Get the requested URI
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        // Define the base path 
        $basePath = 'ExploreEase';

        // If the URI starts with the base path, remove it
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        // Remove any leading/trailing slashes after removing the base path
        $uri = trim($uri, '/');

        // Check if route exists
        if (array_key_exists($uri, $this->routes)) {
            list($controller, $method) = explode('@', $this->routes[$uri]);
            $controller = 'app\controllers\\' . $controller;

            // Manually include the controller file
            $controllerFile = __DIR__ . '/../' . $controller . '.php';
            if (file_exists($controllerFile)) {
                require_once $controllerFile;

                if (class_exists($controller)) {
                    $controllerObject = new $controller();
                    if (method_exists($controllerObject, $method)) {
                        call_user_func_array([$controllerObject, $method], []);
                    } else {
                        echo "Method $method not found in controller $controller\n";
                    }
                } else {
                    echo "Controller class $controller not found\n";
                }
            } else {
                echo "Controller file $controllerFile not found\n";
            }
        } else {
            echo '404 - Not Found';
        }
    }
}
