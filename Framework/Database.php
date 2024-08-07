<?php

namespace Framework;

use PDO;
use PDOException;
use PDOStatement;
use Exception;

class DataBase
{
    public $conn;

    /**
     * Constructor for Database class
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => pdo::FETCH_ASSOC
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e);
        }
    }

    /**
     * Query the database
     *
     * @param string $string
     * @param array $params
     * @return PDOStatement
     * @throws PDOExpetion
     */
    public function query(string $query, $params = []): PDOStatement
    {
        try {
            $sth = $this->conn->prepare($query);

            //  bind named params

            foreach ($params as $param => $value) {
                $sth->bindValue(":" . $param, $value);
            }

            $sth->execute();
            return $sth;
        } catch (PDOException $e) {
            throw new Exception("Query failed to execute: " . $e->getMessage());
        }
    }
}
