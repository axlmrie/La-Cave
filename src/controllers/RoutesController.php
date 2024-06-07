<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;

class RoutesController {

    /**
     * @OA\Get(
     *     path="/",
     *     tags={"Routes"},
     *     summary="Retourne un message 'Hello world!'",
     *     @OA\Response(
     *         response=200,
     *         description="Message 'Hello world!'",
     *         @OA\JsonContent(
     *             type="string",
     *             example="Hello world!"
     *         )
     *     )
     * )
     */
    public static function world(Request $request, Response $response, $args)
    {
        $response->getBody()->write("Hello world!");
        return $response;
    }

    /**
     * @OA\Get(
     *     path="/testLogin",
     *     tags={"Routes"},
     *     summary="Teste la connexion à la base de données",
     *     @OA\Response(
     *         response=200,
     *         description="Connexion à la base de données réussie",
     *         @OA\JsonContent(
     *             type="string",
     *             example="Connexion à la base de données réussie."
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erreur de connexion à la base de données",
     *         @OA\JsonContent(
     *             type="string",
     *             example="Erreur de connexion à la base de données : {message d'erreur}"
     *         )
     *     )
     * )
     */
    public static function testLogin(Request $request, Response $response, $args)
    {
        try {
            $database = DatabaseHandler::connexion();
            $req = $database->query("SHOW TABLES");
            $tables = $req->fetchAll(\PDO::FETCH_ASSOC);
            var_dump($tables);
            // Si la connexion est établie, renvoyer une réponse de réussite
            $response->getBody()->write("Connexion à la base de données réussie.");
            return $response->withStatus(200);
        } catch (\Exception $e) {
            $response->getBody()->write("Erreur de connexion à la base de données : " . $e->getMessage());
            return $response->withStatus(500);
        }
    }
}