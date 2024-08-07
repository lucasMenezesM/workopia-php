<?php
require __DIR__ . '/../vendor/autoload.php';
require '../helpers.php';

use Framework\Router;

// require basePath("Framework/Router.php");
// require basePath("Framework/DataBase.php");

// spl_autoload_register(function ($class) {
//     $path = basePath("Framework/" . $class . ".php");

//     if (file_exists($path)) {
//         require $path;
//     }
// });

$router = new Router();

// Registering all the routes
require basePath("routes.php");

// Get current uri and Method used by user at the moment
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// Route the request and calling the controller
$router->route($uri);

// inspect($uri);
// inspect($method);
