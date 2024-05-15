<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ClientModels {
    public static function readClient(Request $request, Response $response, $args)
    {

        if ($clients) {
            // Si des clients sont trouvés, retourner les données en tant que réponse JSON
            $response->getBody()->write(json_encode($clients));
            return $response->withHeader('Content-Type', 'application/json');
        } else {
            // Si aucun client n'est trouvé, retourner une réponse avec un code 404 (Not Found)
            $response = $response->withStatus(404);
            $response->getBody()->write(json_encode(["message" => "Aucun client trouvé"]));
            return $response->withHeader('Content-Type', 'application/json');
        }

    }

}
