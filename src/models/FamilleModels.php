<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\FamilleEntities;
use src\handlers\DatabaseHandler;

class FamilleModels {
    public static function readFamille(Request $request, Response $response, array $args)
    {
        try {
            $database = DatabaseHandler::connexion();
            $famille = FamilleEntities::readFamille($database);
            $response->getBody()->write(json_encode($famille));
        } catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la récupération des familles: " . $e->getMessage()]));
        } finally {
            $database = null;
        }

        return $response->withHeader('Content-Type', 'application/json');
    }

    public static function createFamille(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();


        try{
            $database = DatabaseHandler::connexion();
            $famille = new FamilleEntities($data);


            if ($famille->createFamille($database) == 1) {
                $response->getBody()->write(json_encode(["message" => "famille enregistrée avec succes"]));
            } else {
                $response = $response->withStatus(401);
                $response->getBody()->write(json_encode(["message" => "Échec de la création de la famille. Veuillez vérifier vos informations."]));
            }
        }catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la création de l'utilisateur: " . $e->getMessage()]));
        }
        $database = null;

        return $response;
    }

    public static function updateFamille(Request $request, Response $response, $args)
    {
        $id_famille = $args['id'];
        $data = $request->getParsedBody();

        try {
            $database = DatabaseHandler::connexion();
            $famille = new FamilleEntities($data);
            $famille->setIdFamille($id_famille);


            if ($famille->updateFamille($database)) {
                $response->getBody()->write(json_encode(["message" => "Famille numero".$famille->getIdFamille() ." a bien été modifier"]));
            } else {
                $response = $response->withStatus(401);
                $response->getBody()->write(json_encode(["message" => "Échec de la modification."]));
            }
        }catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la récupération des familles: " . $e->getMessage()]));
        } finally {
            $database = null;
        }

        return $response;
    }

}
