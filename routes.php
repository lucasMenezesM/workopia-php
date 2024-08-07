<?php

// return [
//     "/" => "controllers/home.php",
//     "/listings" => "controllers/listings/index.php",
//     "/listings/create" => "controllers/listings/create.php",
//     "404" => "controllers/error/404.php"
// ];


// $router->get("/", "controllers/home.php");
// $router->get("/listings", "controllers/listings/index.php");
// $router->get("/listings/create", "controllers/listings/create.php");
// $router->get("/listing", "controllers/listings/show.php");


$router->get("/", "HomeController@index");
$router->get("/listings", "ListingsController@index");
$router->get("/listings/create", "ListingsController@getCreate");
$router->get("/listing/{id}", "ListingsController@show");
