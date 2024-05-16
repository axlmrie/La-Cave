<?php

namespace src\config;

use Slim\Routing\RouteCollectorProxy;
use src\controllers\AdresseController;
use src\controllers\CommandeController;
use src\controllers\LogController;
use src\Controllers\RoutesController;
use src\controllers\ArticleController;
use src\controllers\RegisterController;
use src\controllers\ClientController;
use src\controllers\UtilisateurController;

class Routes{

    public static function loadRoutes($app): void
    {
        $app->group('', function (RouteCollectorProxy $group) {
            $group->get('/', RoutesController::class . ':world');
            $group->post('/register', RegisterController::class . ':register');
            //$group->post;
            //$group->delete;
            //$group->put;
        });
    }

    public static function logRoutes($app): void
    {
        $app->group('/log', function (RouteCollectorProxy $group) {
            $group->post('/login', LogController::class . ':login');
            $group->post('/logout', LogController::class . ':logout');
        });
    }


    public static function stockRoutes($app): void
    {
        $app->group('stock', function (RouteCollectorProxy $group) {
            $group->put();//modifier stock unitairement
            $group->put();//modif stock entreprise
            //$group->post;
            //$group->delete;
            //$group->put;
        });
    }

    public static function fournisseursRoutes($app): void
    {
        $app->group('fournisseurs', function (RouteCollectorProxy $group) {
            $group->get('/', FournisseurController::class . ':world');
            //$group->post;
            //$group->delete;
            //$group->put;

        });
    }

    public static function familleRoutes($app): void
    {
        $app->group('famille', function (RouteCollectorProxy $group) {
            $group->get('/', FamilleController::class . ':world');
            //$group->post;
            //$group->delete;
            //$group->put;

        });
    }

    public static function commandesRoutes($app): void
    {
        $app->group('/commandes', function (RouteCollectorProxy $group) {
            $group->get('/readCommandes', CommandeController::class . ':readCommandes');
            //$group->post;
            //$group->delete;
            //$group->put;

        });
    }

    public static function clientsRoutes($app): void
    {
        $app->group('/clients', function (RouteCollectorProxy $group) {
            $group->get('/readClient', ClientController::class . ':readClient');
            //$group->post;
            //$group->delete;
            //$group->put;

        });
    }

    public static function articlesRoutes($app): void
    {
        $app->group('/articles', function (RouteCollectorProxy $group) {
            $group->get('/readArticle', ArticleController::class . ':readArticle');
            //$group->post;
            //$group->delete;
            //$group->put;

        });
    }

    public static function utilisateursRoutes($app): void
    {
        $app->group('/utilisateurs', function (RouteCollectorProxy $group) {
            $group->get('/readUtilisateurs', UtilisateurController::class . ':readUtilisateurs');
            $group->post('/createUtilisateur', UtilisateurController::class . ':createUtilisateur');
            //$group->delete;
            //$group->put;

        });
    }

    public static function adressesRoutes($app): void
    {
        $app->group('/adresses', function (RouteCollectorProxy $group) {
            $group->put('/updateAdresse', AdresseController::class . ':updateAdresse');{}
            $group ->post('/createAdresse', AdresseController::class . ':createAdresse');

        });
    }



}








