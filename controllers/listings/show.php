<?php

$config = require basePath("config/db.php");
$db = new DataBase($config);

$requestedId = $_GET["id"] ?? '';

$params = ["id" => $requestedId];
$data = $db->query("SELECT * FROM listings WHERE id = :id", $params)->fetch();

loadView("listings/show", [
    "listing" => $data
]);
