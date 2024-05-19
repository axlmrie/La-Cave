<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\ClientEntities;
use src\handlers\DatabaseHandler;

class ClientModels {
    public static function readClient(Request $request, Response $response, $args)
    {
        try {
            $database = DatabaseHandler::connexion();
            $req = $database->prepare("SELECT * FROM clients");
            $req->execute();

            if ($req->rowCount() > 0) {
                $clients = $req->fetchAll(\PDO::FETCH_ASSOC);
                $response->getBody()->write(json_encode(["clients" => $clients]));
            } else {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(["message" => "Aucun client trouvé"]));
            }
        } catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la récupération des clients: " . $e->getMessage()]));
        }
        $database = null;
        $response->getBody()->write(json_encode($req));
        return $response;

    }

}
