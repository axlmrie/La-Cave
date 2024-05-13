<?php

namespace src\handlers;

use Exception;
use PDO;

class DatabaseHandler {

    public static function connexion(): void
    {
        try
        {
            $database = new PDO('mysql:host=localhost; dbname=test', 'root', '');
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }


    }



}

