<?php

// namespace App\Controllers;

use Framework\DataBase;

require basePath("Framework/Database.php");
require basePath("Framework/Validation.php");

class UserController

{
    protected $db;
    public function __construct()
    {
        $config = require basePath("config/db.php");
        $this->db = new DataBase($config);
    }

    /**
     * Show the login page
     *
     * @return void
     */
    public function login(): void
    {
        loadView("users/login");
    }

    /**
     * Show the register page
     *
     * @return void
     */
    public function create(): void
    {
        loadView("users/create");
    }
}
