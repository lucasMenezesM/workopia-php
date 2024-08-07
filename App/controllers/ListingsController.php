<?php

// Not using namespaces
// namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

require basePath("App/controllers/ErrorController.php");

class ListingsController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath("config/db.php");
        $this->db = new DataBase($config);
    }

    /**
     * Loads the view of all job listings
     *
     * @return void
     */
    public function index(): void
    {
        $listings = $this->db->query("SELECT * FROM listings")->fetchAll();
        loadView("listings/index", ["listings" => $listings]);
    }

    /**
     * Loads the page to create a new listing
     *
     * @return void
     */
    public function getCreate(): void
    {
        loadView("listings/create");
    }

    /**
     * Loads the details of a specific job listing
     * @param array $params
     * @return void
     */
    public function show(array $params): void
    {
        $requestedId = $params["id"] ?? '';
        $params = ["id" => $requestedId];
        $data = $this->db->query("SELECT * FROM listings WHERE id = :id", $params)->fetch();

        if (!$data) {
            ErrorController::notFound("Listing not found");
            return;
        }

        loadView("listings/show", [
            "listing" => $data
        ]);
    }
}
