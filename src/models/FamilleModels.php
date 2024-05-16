<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;

class FamilleModels {
    public static function readFamille(Request $request, Response $response, $args)
    {
        try {
            $database = DatabaseHandler::connexion();
            $req = $database->prepare("SELECT * FROM famille");
            $req->execute();

            if ($req->rowCount() > 0) {
                $famille = $req->fetchAll(\PDO::FETCH_ASSOC);
                $response->getBody()->write(json_encode(["famille" => $famille]));
            } else {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(["message" => "Aucune famille trouvée"]));
            }
        } catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la récupération des familles: " . $e->getMessage()]));
        }
        $database = null;
        $response->getBody()->write(json_encode($req));
        return $response;

    }

    public static function createFamille(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $cepage = $data['cepage'] ?? null;
        $annee = $data['annee'] ?? null;
        $vignoble = $data['vignoble'] ?? null;



        try{
            $database = DatabaseHandler::connexion();
            $req = "INSERT INTO famille (cepage, annee, vignoble) VALUES ('$cepage', '$annee', '$vignoble')";
            $result = $database->query($req);


            if ($result->rowCount() == 1) {
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
        $response->getBody()->write(json_encode($req));
        return $response;
    }

    public static function updateFamille(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $cepage = $data['cepage'] ?? null;
        $annee = $data['annee'] ?? null;
        $vignoble = $data['vignoble'] ?? null;
        $id_famille = $data['id_famille'] ?? null;

        try {
            $database = DatabaseHandler::connexion();
            $req = " UPDATE adresse set cepage = '$cepage', annee = '$annee', vignoble ='$vignoble'  WHERE id_famille = '$id_famille'";
            $req = $database->query($req);

            if ($req->rowCount() == 1) {
                $response->getBody()->write(json_encode(["message" => "Famille numero, $id_famille a bien été modifier"]));
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

        $response->getBody()->write(json_encode($req));
        return $response;
    }

}
