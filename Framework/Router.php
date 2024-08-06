<?php

namespace Framework;

class Router
{
    protected $routes = [];

    /**
     * Add a new route (pushed the route into the routes array)
     *
     * @param string $method
     * @param string $uri
     * @param string $controller
     * @return void
     */
    function registerRoute(string $method, string $uri, string $controller): void
    {
        $this->routes[] = [
            "method" => $method,
            "uri" => $uri,
            "controller" => $controller,
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
     * Load Error Page
     *
     * @param integer $httpCode
     * @return void
     */
    public function error(int $httpCode = 404)
    {
        http_response_code($httpCode);
        loadView("error/$httpCode");
        exit;
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
                require basePath("App/" . $route["controller"]);
                return;
            }
        }
        $this->error(404);
    }
}
