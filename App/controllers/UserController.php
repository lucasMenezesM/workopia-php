<?php

// namespace App\Controllers;

use Framework\DataBase;
use Framework\Validation;

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

    /**
     * Store user in database
     *
     * @return void
     */
    public function store(): void
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $password = $_POST["password"];
        $passwordConfirmation = $_POST["password_confirmation"];

        $errors = [];

        // Validation
        if (!Validation::email($email)) {
            $errors[] = ["message" => "Please enter a valid email"];
        }

        if (!Validation::string($name, 2, 50)) {
            $errors[] = ["message" => "Name must be between 2 and 50 characters"];
        }

        if (!Validation::string($password, 6, 50)) {
            $errors[] = ["message" => "Password must be at least 6 characters"];
        }

        if (!Validation::matchPassword($password, $passwordConfirmation)) {
            $errors[] = ["message" => "Passwords do not match"];
        }

        if (!empty($errors)) {
            loadView("users/create", [
                "errors" => $errors,
                "user" => [
                    "name" => $name,
                    "email" => $email,
                    "city" => $city,
                    "state" => $state,
                ]
            ]);
            exit;
        }

        // Check if email exists

        $params = ["email" => $email];

        $user = $this->db->query("SELECT * FROM users WHERE email = :email", $params)->fetch();

        if ($user) {
            echo "email exists";
            $errors[] = ["message" => "That email already exists"];
            loadView("users/create", ["errors" => $errors, "user" => [
                "name" => $name,
                "email" => $email,
                "city" => $city,
                "state" => $state,
            ]]);
            exit;
        }

        // Create user account

        $params = [
            "name" => $name,
            "email" => $email,
            "city" => $city,
            "state" => $state,
            "password" => password_hash($password, PASSWORD_DEFAULT),
        ];

        $this->db->query("INSERT INTO users(name, email, city, state, password) VALUES(:name, :email, :city, :state, :password)", $params);

        redirect("/");
    }
}
