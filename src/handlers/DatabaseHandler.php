<?php

namespace src\handlers;

use Exception;
use PDO;

class DatabaseHandler {

    public static function connexion(): void
    {
        try
        {
            $database = new PDO(dsn: [DSN], username: [USERNAME], password: [PASSWORD]);
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }


    }



}

