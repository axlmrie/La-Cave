<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;
use src\entities\AdresseEntities;

class AdresseModels {


    public static function updateAdresse(Request $request, Response $response, $args)
    {

        $id_adresse = $args['id']; // Récupérer l'ID de l'URL
        $data = $request->getParsedBody(); // Récupérer les données de la requête PUT

        try {
            $database = DatabaseHandler::connexion();
            $adresse = new AdresseEntities($data);
            $adresse->setIdAdresse($id_adresse);

            if ($adresse->updateAdresse($database)){
                $response->getBody()->write(json_encode(["message" => "Adresse numéro " . $adresse->getIdAdresse() . " a bien été modifiée."]));
            }else {
                $response = $response->withStatus(401);
                $response->getBody()->write(json_encode(["message" => "Échec de la modification."]));
            }
        }catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la récupération des articles: " . $e->getMessage()]));
        } finally {
            $database = null;
        }
        return $response;
    }

    public static function createAdresse(Request $request, Response $response, $args)
    {

        $data = $request->getParsedBody();

        try {
            $database = DatabaseHandler::connexion();
            $adresse = new AdresseEntities($data);

            if ($adresse->createAdresse($database)){
                $response->getBody()->write(json_encode(["message" => "Adresse numéro " . $adresse->getIdAdresse() . " a bien été modifiée."]));
            }else {
                $response = $response->withStatus(401);
                $response->getBody()->write(json_encode(["message" => "Échec de la modification."]));
            }
        }catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la récupération des articles: " . $e->getMessage()]));
        } finally {
            $database = null;
        }
        return $response;
    }



}

