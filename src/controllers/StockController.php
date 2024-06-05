<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\AdresseModels;
use src\models\StockModels;

class StockController {

    public function updateStock(Request $request, Response $response, $args)
    {
        $results = StockModels::updateStock($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }
}
