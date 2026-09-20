<?php
namespace App\Core;

/**
 * Class Router
 * Handles URI routing, dynamic parameter extraction, and middleware execution.
 *
 * @package App\Core
 */
class Router {
    private $routes = [];

    /**
     * Registers a new route with the application.
     *
     * @param string $method HTTP method (GET, POST, etc.)
     * @param string $uri The URI pattern to match (e.g., '/course/{id}')
     * @param string $controllerAction The controller and method in the format 'Controller@method'
     * @param array $middlewares Optional array of middleware class names to execute before the controller
     * @return void
     */
    public function add($method, $uri, $controllerAction, $middlewares = []) {
        $this->routes[] = [
            'method'           => strtoupper($method),
            'uri'              => $uri,
            'controllerAction' => $controllerAction,
            'middlewares'      => $middlewares
        ];
    }

    /**
     * Matches the current request URI and method against registered routes.
     * Extracts dynamic parameters, executes middlewares, and dispatches the controller action.
     *
     * @param string $uri The request URI
     * @param string $method The HTTP method
     * @return mixed Responses from the controller action
     */
    public function dispatch($uri, $method) {
        
        $uri = strtok($uri, '?');
        
        $uri = rtrim($uri, '/');
        if ($uri === '') {
            $uri = '/';
        }

        foreach ($this->routes as $route) {
            if ($route['method'] !== strtoupper($method)) {
                continue;
            }

            $pattern = preg_replace('/\{[a-z_]+\}/', '([^/]+)', $route['uri']);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $uri, $matches)) {
                
                $params = array_slice($matches, 1);

                $parts          = explode('@', $route['controllerAction']);
                $controllerName = "App\\Controllers\\" . $parts[0];
                $action         = $parts[1];

                foreach ($route['middlewares'] as $middlewareAlias) {
                    $middlewareClass = "App\\Middlewares\\" . $middlewareAlias;
                    if (class_exists($middlewareClass)) {
                        $middlewareInstance = new $middlewareClass();
                        $middlewareInstance->handle();
                    } else {
                        die("Middleware {$middlewareClass} not found.");
                    }
                }

                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $action)) {
                        return $controller->$action(...$params);
                    } else {
                        die("Method {$action} not found in controller {$controllerName}");
                    }
                } else {
                    die("Controller class {$controllerName} not found");
                }
            }
        }

        http_response_code(404);
        die("404 Not Found - The requested URL '{$uri}' was not found on this server. (Original URI: {$_SERVER['REQUEST_URI']})");
    }
}
