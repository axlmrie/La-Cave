<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;

class UtilisateurModels
{
    public static function readUtilisateurs(Request $request, Response $response, $args)
    {
        try {
            $database = DatabaseHandler::connexion();
            $req = $database->prepare("SELECT * FROM clients");
            $req->execute();

            if ($req->rowCount() > 0) {
                $utilisateurs = $req->fetchAll(\PDO::FETCH_ASSOC);
                $response->getBody()->write(json_encode(["Utilisateurs" => $utilisateurs]));
            } else {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(["message" => "Aucun utilisateur trouvé"]));
            }
        } catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la récupération des utilisateurs: " . $e->getMessage()]));
        }
        $database = null;
        $response->getBody()->write(json_encode($req));
        return $response;
    }

    public static function createUtilisateur(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $nom = $data['username'] ?? null;
        $prenom = $data['password'] ?? null;
        $matricule = $data['matricule'] ?? null;
        $date_suppression = $data['date_suppression'] ?? null;


        try{
            $database = DatabaseHandler::connexion();
            $req = "INSERT INTO utilisateurs (nom, prenom, matricule, date_suppression) VALUES ('$nom', '$prenom', '$matricule', '$date_suppression')";
            $result = $database->query($req);


            if ($result->rowCount() == 1) {
                $response->getBody()->write(json_encode(["message" => "Utilisateur enregistré avec succes"]));
            } else {
                $response = $response->withStatus(401);
                $response->getBody()->write(json_encode(["message" => "Échec de la création d'utilisateur. Veuillez vérifier vos informations."]));
            }
        }catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la création de l'utilisateur: " . $e->getMessage()]));
        }
        $database = null;
        $response->getBody()->write(json_encode($req));
        return $response;
    }


}
