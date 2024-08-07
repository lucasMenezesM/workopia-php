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

    /**
     * Store the listing into the database.
     *
     * @return void
     */
    public function store(): void
    {
        $allowedFields = ["title", "description", "salary", "tags", "company", "address", "city", "state", "phone", "email", "requirements", "benefits"];

        $newListingData = array_intersect_key($_POST, array_flip($allowedFields));
        $newListingData["user_id"] = 1;

        // calling the sanitize function to sanitize each item in newListingData
        $newListingData = array_map("sanitize", $newListingData);

        $requiredFields = ["title", "description", "email", "city", "state"];

        $erros = [];

        foreach ($requiredFields as $field) {
            if (empty($newListingData[$field]) || !Validation::string($newListingData[$field])) {
                $erros[] = ["message" => "The field $field should not be empty"];
            }
        }

        if (!empty($erros)) {
            inspect($erros);
            // realod the same view with errros
            loadView("/listings/create", [
                "erros" => $erros,
                "listingData" => $newListingData
            ]);
        } else {

            // Turning all the form fields into a string
            $fields = [];

            foreach ($newListingData as $field => $value) {
                $fields[] = $field;
            }

            $fields = implode(", ", $fields);

            // Turning all the form values into a string
            $values = [];

            foreach ($newListingData as $field => $value) {
                if (empty($value)) {
                    $newListingData[$field];
                }
                $values[] = ":" . $field;
            }

            $values = implode(", ", $values);
            $this->db->query("INSERT INTO listings($fields) VALUES($values)", $newListingData);

            redirect("/listings");
        }
    }
}
