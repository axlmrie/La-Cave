<?php
namespace src\handlers;



class DatabaseHandler {

public static function connexion(): \PDO
{
try {
// Charger les variables d'environnement depuis le fichier .env
$dsn = $_ENV['DSN'];
$username = $_ENV['USERNAME'];
$password = $_ENV['PASSWORD'];

// Établir la connexion à la base de données en utilisant les variables chargées
$database = new \PDO($dsn, $username, $password);
} catch (\Exception $e) {
// En cas d'erreur, afficher le message d'erreur
die('Erreur : ' . $e->getMessage());
}
return $database ;
}
}
