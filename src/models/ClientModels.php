<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\ClientEntities;
use src\handlers\DatabaseHandler;

class ClientModels {
    public static function readClient(Request $request, Response $response, $args)
    {
        $database = DatabaseHandler::connexion();
        ClientEntities::readClient($database);
        return $response;

    }

}
