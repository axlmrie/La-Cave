<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;
use src\handlers\ResponseHandler;
use src\models\LogModels;

class LogController {

    /**
     * @OA\Get(
     *     path="/log/login",
     *     tags={"Log"},
     *     summary="Connexion d'un utilisateur",
     *     @OA\Response(
     *         response=200,
     *         description="Utilisateur connecté",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="datas", type="object")
     *         )
     *     )
     * )
     */
    public static function login(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $results = LogModels::login($data);
        return ResponseHandler::Response($request, $response,$results);
    }

    /**
     * @OA\Post(
     *     path="/log/logout",
     *     tags={"Log"},
     *     summary="Déconnexion d'un utilisateur",
     *     @OA\Response(
     *         response=200,
     *         description="Utilisateur déconnecté",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="datas", type="object")
     *         )
     *     )
     * )
     */
    public static function logout(Request $request, Response $response, $args)
    {
        $results = LogModels::logout();
        return ResponseHandler::Response($request, $response, $results);
    }
}