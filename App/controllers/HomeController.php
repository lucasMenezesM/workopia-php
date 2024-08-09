<?php

// namespace App\Controllers;

use Framework\Database;

class HomeController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath("config/db.php");
        $this->db = new DataBase($config);
    }

    /**
     * Loads the home page.
     *
     * @return void
     */
    public function index(): void
    {
        $listings = $this->db->query("SELECT * FROM listings ORDER BY created_at DESC LIMIT 6")->fetchAll();

        loadView("home", ["listings" => $listings]);
    }
}
