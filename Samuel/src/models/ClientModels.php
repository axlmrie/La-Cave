<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\ClientEntities;
use src\handlers\DatabaseHandler;

class ClientModels {

    public static function readClient()
    {
        $database = DatabaseHandler::connexion();
        return ClientEntities::readClient($database);
    }
}