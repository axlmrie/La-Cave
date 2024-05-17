<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;

class StockModels {


    public static function updateStock(Request $request, Response $response, $args)
    {
        $body = $request->getBody()->getContents();
        $data = json_decode($body, true);

        $stock = $data['stock'] ?? null;
        $id_article = $data['id_article'] ?? null;

        try {
            $database = DatabaseHandler::connexion();
            $req = $database->prepare("UPDATE articles SET stock = ? WHERE id_article = ?");
            $result = $req->execute([$stock, $id_article]);

            if ($result) {
                $response->getBody()->write(json_encode(["message" => "Stock mis à jour avec succès pour l'article $id_article"]));
            } else {
                $response = $response->withStatus(401);
                $response->getBody()->write(json_encode(["message" => "Échec de la mise à jour du stock."]));
            }
        } catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la mise à jour du stock : " . $e->getMessage()]));
        } finally {
            $database = null;
        }

        return $response;
    }


}
