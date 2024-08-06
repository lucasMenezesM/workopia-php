<?php

namespace Framework;

use ErrorController;

class Router
{
    protected $routes = [];

    /**
     * Add a new route (pushed the route into the routes array)
     *
     * @param string $method
     * @param string $uri
     * @param string $action
     * @return void
     */
    function registerRoute(string $method, string $uri, string $action): void
    {
        list($controller, $controllerMethod) = explode("@", $action);

        $this->routes[] = [
            "method" => $method,
            "uri" => $uri,
            "controller" => $controller,
            "controllerMethod" => $controllerMethod
        ];
    }

    /**
     * Add a GET route
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function get($uri, $controller)
    {
        $this->registerRoute("GET", $uri, $controller);
    }

    /**
     * Add a POST route
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function post($uri, $controller)
    {
        $this->registerRoute("POST", $uri, $controller);
    }

    /**
     * Add a PUT route
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function put($uri, $controller)
    {
        $this->registerRoute("PUT", $uri, $controller);
    }

    /**
     * Add a DELETE route
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function delete($uri, $controller)
    {
        $this->registerRoute("DELETE", $uri, $controller);
    }

    /**
     * Route the request
     * 
     * @param string $uri
     * @param string $method
     * @return void
     */

    function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route["method"] === $method && $route["uri"] === $uri) {
                // Extract controller and controller method

                // Using namespaces:
                // $controller = "App\\Controllers\\" . $route["controller"];

                // Not using namespaces:
                require basePath("App/controllers/" . $route["controller"] . ".php");
                $controller = new $route['controller']();

                $controllerMethod = $route["controllerMethod"];

                // Instatiate the controller and call the method
                $controllerInstance = new $controller();
                $controllerInstance->$controllerMethod();
                return;
            }
        }
        require basePath("App/controllers/ErrorController.php");
        ErrorController::notFound();
    }
}
