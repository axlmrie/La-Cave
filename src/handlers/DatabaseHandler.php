<?php
namespace src\handlers;



class DatabaseHandler {

    public static function connexion(): \PDO
    {
        try {
            $dsn = $_ENV['DSN'];
            $username = $_ENV['USERNAME'];
            $password = $_ENV['PASSWORD'];

            $database = new \PDO($dsn, $username, $password);
        } catch (\Exception $e) {

            die('Erreur : ' . $e->getMessage());
        }
        return $database ;
    }
}

