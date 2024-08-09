<?php

namespace Framework;

use Authorize;
use ErrorController;

require basePath("/Framework/middleware/Authorize.php");

class Router
{
    protected $routes = [];

    /**
     * Add a new route (pushed the route into the routes array)
     *
     * @param string $method
     * @param string $uri
     * @param string $action
     * @param array $middleware
     * @return void
     */
    function registerRoute(string $method, string $uri, string $action, array $middleware = []): void
    {
        list($controller, $controllerMethod) = explode("@", $action);

        $this->routes[] = [
            "method" => $method,
            "uri" => $uri,
            "controller" => $controller,
            "controllerMethod" => $controllerMethod,
            "middleware" => $middleware
        ];
    }

    /**
     * Add a GET route
     * 
     * @param string $uri
     * @param string $controller
     * @param array $middleware
     * @return void
     */
    public function get($uri, $controller, $middleware = [])
    {
        $this->registerRoute("GET", $uri, $controller, $middleware);
    }

    /**
     * Add a POST route
     * 
     * @param string $uri
     * @param string $controller
     * @param array $middleware
     * @return void
     */
    public function post($uri, $controller, $middleware = [])
    {
        $this->registerRoute("POST", $uri, $controller, $middleware);
    }

    /**
     * Add a PUT route
     * 
     * @param string $uri
     * @param string $controller
     * @param array $middleware
     * @return void
     */
    public function put($uri, $controller, $middleware = [])
    {
        $this->registerRoute("PUT", $uri, $controller, $middleware);
    }

    /**
     * Add a DELETE route
     * 
     * @param string $uri
     * @param string $controller
     * @param array $middleware
     * @return void
     */
    public function delete($uri, $controller, $middleware = [])
    {
        $this->registerRoute("DELETE", $uri, $controller, $middleware);
    }

    /**
     * Route the request
     * 
     * @param string $uri
     * @param string $method
     * @return void
     */

    function route($uri): void
    {
        $requestedMethod = $_SERVER["REQUEST_METHOD"];

        // Check for _method input
        if ($requestedMethod === "POST" && isset($_POST["_method"])) {
            // Override the requestedMethod with the value of _method
            $requestedMethod = strtoupper($_POST["_method"]);
        }

        foreach ($this->routes as $route) {

            // uri requested by user
            $uriSegments = explode("/", trim($uri, '/'));

            // Uri for each iteration
            $routeSegments = explode("/", trim($route["uri"], "/"));

            $match = true;

            if (count($uriSegments) === count($routeSegments) && strtoupper($route['method'] === $requestedMethod)) {
                $params = [];
                $match = true;

                for ($i = 0; $i < count($uriSegments); $i++) {
                    // if the uri's don't match and there is no param
                    if ($routeSegments[$i] !== $uriSegments[$i] && !preg_match("/\{(.+?)\}/", $routeSegments[$i])) {
                        $match = false;
                        break;
                    }

                    // Check for the param and add to params array
                    if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        // $params[$matches[$i]] = $uriSegments[$i];
                        $params[$matches[1]] = $uriSegments[$i];
                    }
                };

                if ($match) {
                    foreach ($route["middleware"] as $middleware) {
                        (new Authorize())->handle($middleware);
                    }
                    // Extract controller and controller method

                    // Using namespaces:
                    // $controller = "App\\Controllers\\" . $route["controller"];

                    // Not using namespaces:
                    require basePath("App/controllers/" . $route["controller"] . ".php");
                    $controller = new $route['controller']();

                    $controllerMethod = $route["controllerMethod"];

                    // Instatiate the controller and call the method
                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod($params);
                    return;
                }
            }
        }
        require basePath("App/controllers/ErrorController.php");
        ErrorController::notFound();
    }
}
