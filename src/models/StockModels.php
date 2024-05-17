<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;

class StockModels {

    public static function updateStock(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $stock = $data['stock'] ?? null;
        $id_article = $data['id_article'] ?? null;

        try {
            $database = DatabaseHandler::connexion();
            $stmt = $database->prepare("UPDATE articles SET stock = '$stock' WHERE id_article = '$id_article'");
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $response->getBody()->write(json_encode(["message" => "L'article numéro $id_article a bien été modifié"]));
            } else {
                $response = $response->withStatus(401);
                $response->getBody()->write(json_encode(["message" => "Échec de la modification."]));
            }
        } catch (\PDOException $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la mise à jour du stock : " . $e->getMessage()]));
        } finally {
            $database = null;
        }

        return $response;
    }




}
