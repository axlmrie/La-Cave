<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;

class FournisseurModels {
    public static function readFournisseurs(Request $request, Response $response, $args)
    {
        try {
            $database = DatabaseHandler::connexion();
            $req = $database->prepare("SELECT * FROM fournisseurs");
            $req->execute();

            if ($req->rowCount() > 0) {
                $fournisseurs = $req->fetchAll(\PDO::FETCH_ASSOC);
                $response->getBody()->write(json_encode(["fournisseurs" => $fournisseurs]));
            } else {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(["message" => "Aucun fournisseur trouvée"]));
            }
        } catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la récupération des fournisseurs: " . $e->getMessage()]));
        }
        $database = null;
        $response->getBody()->write(json_encode($req));
        return $response;

    }

    public static function createFournisseurs(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $numero_tel = $data['numero_tel'] ?? null;
        $nom = $data['nom'] ?? null;
        $adresse = $data['adresse'] ?? null;



        try{
            $database = DatabaseHandler::connexion();
            $req = "INSERT INTO famille (numero_tel, nom, adresse) VALUES ('$numero_tel', '$nom', '$adresse')";
            $result = $database->query($req);


            if ($result->rowCount() == 1) {
                $response->getBody()->write(json_encode(["message" => "fournisseur enregistrée avec succes"]));
            } else {
                $response = $response->withStatus(401);
                $response->getBody()->write(json_encode(["message" => "Échec de la création de la fournisseur. Veuillez vérifier vos informations."]));
            }
        }catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la création du fournisseur: " . $e->getMessage()]));
        }
        $database = null;
        $response->getBody()->write(json_encode($req));
        return $response;
    }

    public static function updateFournisseurs(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $numero_tel = $data['numero_tel'] ?? null;
        $nom = $data['nom'] ?? null;
        $adresse = $data['adresse'] ?? null;
        $id_fournisseur = $data['id_fournisseur'] ?? null;


        try {
            $database = DatabaseHandler::connexion();
            $req = " UPDATE adresse set numero_tel = '$numero_tel', nom = '$nom', adresse ='$adresse'  WHERE id_fournisseur = '$id_fournisseur'";
            $req = $database->query($req);

            if ($req->rowCount() == 1) {
                $response->getBody()->write(json_encode(["message" => "Fournisseur numero, $id_fournisseur a bien été modifier"]));
            } else {
                $response = $response->withStatus(401);
                $response->getBody()->write(json_encode(["message" => "Échec de la modification."]));
            }
        }catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la récupération des fournisseurs: " . $e->getMessage()]));
        } finally {
            $database = null;
        }
        $response->getBody()->write(json_encode($req));
        return $response;
    }
}
