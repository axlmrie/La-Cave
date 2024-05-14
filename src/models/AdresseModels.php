<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;

class AdresseModels {
    public static function updateAdresse(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id_adresse = $data['id_adresse'];
        $pays = $data['pays'];
        $code_postal = $data['code_postal'];
        $numero_rue = $data['numero_rue'];
        $ville = $data['ville'];
        $nom_rue = $data['nom_rue'];

        $database = DatabaseHandler::connexion();

        if ($database->connect_error) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur de connexion à la base de données"]));
            return $response->withHeader('Content-Type', 'application/json');
        }

        $req = " UPDATE adresse set nom_rue = '$nom_rue', ville = '$ville', numero_rue '$numero_rue', code_postal ='$code_postal', pays = '$pays'  WHERE id_adresse = '$id_adresse'";

        $result = $database->query($req);


        if ($result->num_rows == 1) {
            $response->getBody()->write(json_encode(["message" => "Adresse numero, $id_adresse a bien été modifier"]));
        } else {
            $response = $response->withStatus(401);
            $response->getBody()->write(json_encode(["message" => "Échec de la modification."]));
        }
        $database->close();

        return $response->withHeader('Content-Type', 'application/json');
    }

}
