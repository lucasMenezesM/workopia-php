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
$router->get("/listings/create", "ListingsController@getCreate", ["auth"]);
$router->get("/listings/edit/{id}", "ListingsController@edit", ["auth"]);
$router->get("/listings/{id}", "ListingsController@show");

$router->post("/listings", "ListingsController@store", ["auth"]);
$router->put("/listings/{id}", "ListingsController@update", ["auth"]);

$router->delete("/listings/{id}", "ListingsController@destroy", ["auth"]);

// USER ROUTES
$router->get("/auth/register", "UserController@create", ["guest"]);
$router->get("/auth/login", "UserController@login", ["guest"]);

$router->post("/auth/register", "UserController@store", ["guest"]);
$router->get("/auth/logout", "UserController@logout", ["auth"]);
$router->post("/auth/login", "UserController@authenticate", ["guest"]);
