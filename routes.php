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
$router->get("/listings/edit/{id}", "ListingsController@edit");
$router->get("/listings/{id}", "ListingsController@show");

$router->post("/listings", "ListingsController@store");
$router->put("/listings/{id}", "ListingsController@update");

$router->delete("/listings/{id}", "ListingsController@destroy");
