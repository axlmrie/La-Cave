<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;

class AdresseModels {

    /**
     * Met à jour une adresse dans la base de données.
     *
     * @param Request $request Requête HTTP contenant les données à mettre à jour.
     * @param Response $response Réponse HTTP retournée.
     * @param array $args Arguments de la requête.
     * @return Response Réponse HTTP contenant un message JSON indiquant le succès ou l'échec de la mise à jour.
     *
     * @OA\Post(
     *     path="/adresse/update",
     *     tags={"Adresse"},
     *     summary="Met à jour une adresse",
     *     description="Cette route permet de mettre à jour une adresse dans la base de données.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AdresseUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Adresse mise à jour avec succès.",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Adresse mise à jour avec succès.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Échec de la mise à jour de l'adresse.",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Échec de la modification.")
     *         )
     *     )
     * )
     */
    public static function updateAdresse(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id_adresse = $data['id_adresse'] ?? null;
        $pays = $data['pays'] ?? null;
        $code_postal = $data['code_postal'] ?? null;
        $numero_rue = $data['numero_rue'] ?? null;
        $ville = $data['ville'] ?? null;
        $nom_rue = $data['nom_rue'] ?? null;

        try {
            $database = DatabaseHandler::connexion();
            $req = " UPDATE adresse set nom_rue = '$nom_rue', ville = '$ville', numero_rue ='$numero_rue', code_postal ='$code_postal', pays = '$pays'  WHERE id_adresse = '$id_adresse'";
            $req = $database->query($req);

            if ($req->rowCount() == 1) {
                $response->getBody()->write(json_encode(["message" => "Adresse numero, $id_adresse a bien été modifier"]));
            } else {
                $response = $response->withStatus(401);
                $response->getBody()->write(json_encode(["message" => "Échec de la modification."]));
            }
        }catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la récupération des articles: " . $e->getMessage()]));
        } finally {
            $database = null;
        }

        $response->getBody()->write(json_encode($req));
        return $response;
    }

    public static function createAdresse(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();

        $pays = $data['pays'] ?? null;
        $code_postal = $data['code_postal'] ?? null;
        $numero_rue = $data['numero_rue'] ?? null;
        $ville = $data['ville'] ?? null;
        $nom_rue = $data['nom_rue'] ?? null;

        try{
            $database = DatabaseHandler::connexion();
            $req = "INSERT INTO adresse (pays, code_postal, numero_rue, ville, nom_rue) VALUES ('$pays', '$code_postal', '$numero_rue', '$ville', '$nom_rue')";
            $result = $database->query($req);


            if ($result->rowCount() == 1) {
                $response->getBody()->write(json_encode(["message" => "Adresse enregistré avec succes"]));
            } else {
                $response = $response->withStatus(401);
                $response->getBody()->write(json_encode(["message" => "Échec de la création d'adresse. Veuillez vérifier vos informations."]));
            }
        }catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la création de l'adresse: " . $e->getMessage()]));
        }
        $database = null;
        $response->getBody()->write(json_encode($req));
        return $response;
    }



}

