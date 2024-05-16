<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\models\AdresseModels;

class AdresseController {
    public static function updateAdresse(Request $request, Response $response, $args)
    {
        AdresseModels::updateAdresse($request, $response, $args);
        return $response;
    }

}