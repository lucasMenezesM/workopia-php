<?php

require "../helpers.php";
require basePath("Router.php");
require basePath("DataBase.php");

// Instatiating the router
$router = new Router();

// Registering all the routes
require basePath("routes.php");

// Get current uri and Method used by user at the moment
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$method = $_SERVER["REQUEST_METHOD"];

// Route the request and calling the controller
$router->route($uri, $method);

inspect($uri);
inspect($method);
