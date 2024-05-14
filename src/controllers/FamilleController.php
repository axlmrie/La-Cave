<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\models\FamilleModels;

class FamilleController {
    public static function NOMDELAFONCTION(Request $request, Response $response, $args)
    {
        FamilleModels::NOMDELAFONCTION();
    }

}
