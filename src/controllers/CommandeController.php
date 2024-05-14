<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\models\CommandeModels;

class CommandeController {
    public static function NOMDELAFONCTION(Request $request, Response $response, $args)
    {
        CommandeModels::NOMDELAFONCTION();

    }

}
