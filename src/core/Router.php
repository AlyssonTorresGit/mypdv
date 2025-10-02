<?php

namespace App\core;

class Router
{
    private static array $routes = [];
    public static function add(string $method, string $path, string $controller, string $action)
    {
        $method = strtoupper($method);
        $pattern = preg_replace(
            '/\{([a-zA-Z0-9_]+)\}/',
            '([^/]+)',
            $path
        );
        self::$routes[$method][$pattern] = ['controller' => $controller, 'action' => $action];
    }
    public static function dispatch()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
            $method = 'DELETE';
        }
        if (!isset(self::$routes[$method])) {
            http_response_code(405);
            echo "Metodo não permitido.";
            return;
        }
        foreach (self::$routes[$method] as $pattern => $route) {
            if (preg_match("#^$pattern$#", $uri, $matches)) {
                array_shift($matches);
                $controllerName = $route['controller'];
                $action = $route['action'];

                $controller = new $controllerName();
                return call_user_func_array([$controller, $action], $matches);
            }
        }
        http_response_code(404);
        echo 'Página não encontrada';
    }
}
