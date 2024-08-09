<?php

require __DIR__ . '/../vendor/autoload.php';
require '../helpers.php';

use Framework\Router;

require basePath("Framework/Session.php");

Session::start();

// require basePath("Framework/Router.php");
// require basePath("Framework/DataBase.php");
$router = new Router();

// Registering all the routes
require basePath("routes.php");

// Get current uri
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// Route the request and calling the controller
$router->route($uri);

// inspect($uri);
// inspect($method);
