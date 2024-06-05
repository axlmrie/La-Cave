<?php

namespace src\config;

use Slim\Routing\RouteCollectorProxy;
use src\controllers\AdresseController;
use src\controllers\CommandeController;
use src\controllers\FamilleController;
use src\controllers\FournisseurController;
use src\controllers\LogController;
use src\Controllers\RoutesController;
use src\controllers\ArticleController;
use src\controllers\RegisterController;
use src\controllers\ClientController;
use src\controllers\StockController;
use src\controllers\UtilisateurController;
use src\middlewares\ResponseMiddleware;

class Routes{

    public static function loadRoutes($app): void
    {
        $app->group('', function (RouteCollectorProxy $group) {
            $group->get('/', RoutesController::class . ':world');
            $group->get('/testLogin', RoutesController::class . ':testLogin');
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
        $app->group('/stock', function (RouteCollectorProxy $group) {
            $group->post('/updateStock', StockController::class . ':updateStock');
        });
    }

    public static function fournisseursRoutes($app): void
    {
        $app->group('fournisseurs', function (RouteCollectorProxy $group) {
            $group->get('/readFournisseurs', FournisseurController::class . ':readFournisseurs');
            $group->post('/createFournisseur', FournisseurController::class . ':createFournisseur');
            $group->put('/updateFournisseur/{id}', FournisseurController::class . ':updateFournisseur');
        })->add(new ResponseMiddleware());
    }

    public static function familleRoutes($app): void
    {
        $app->group('/famille', function (RouteCollectorProxy $group) {
            $group->get('/readFamille', FamilleController::class . ':readFamille');
            $group->post('/createFamille', FamilleController::class . ':createFamille');
            $group->put('/updateFamille/{id}', FamilleController::class . ':updateFamille');
        })->add(new ResponseMiddleware());
    }

    public static function commandesRoutes($app): void
    {
        $app->group('/commandes', function (RouteCollectorProxy $group) {
            $group->get('/affichageCommandes', CommandeController::class . ':affichageCommandes');
            $group->get('/readCommandes', CommandeController::class . ':readCommandes');
            $group->post('/createCommandes', CommandeController::class . ':createCommandes');
            $group->put('/deleteCommande/{id}', CommandeController::class . ':deleteCommandes');
            $group->post('/updateCommande/{id}', CommandeController::class . ':updateCommandes');
        })->add(new ResponseMiddleware());
    }

    public static function clientsRoutes($app): void
    {

        $app->group('/clients', function (RouteCollectorProxy $group) {
            $group->post('/register', RegisterController::class . ':register');
            $group->get('/readClient', ClientController::class . ':readClient');
        })->add(new ResponseMiddleware());
    }

    public static function articlesRoutes($app): void
    {
        $app->group('/articles', function (RouteCollectorProxy $group) {
            $group->get('/readArticle', ArticleController::class . ':readArticle');
            $group->get('/stockArticleNeg', ArticleController::class . ':stockArticleNeg');
            $group->get('/articleFamille', ArticleController::class . ':articleFamille');
            $group->post('/createArticle', ArticleController::class . ':createArticle');
            $group->put('/updateArticle/{id}', ArticleController::class . ':updateArticle');
        })->add(new ResponseMiddleware());
    }

    public static function utilisateursRoutes($app): void
    {
        $app->group('/utilisateurs', function (RouteCollectorProxy $group) {
            $group->get('/readUtilisateurs', UtilisateurController::class . ':readUtilisateurs');
            $group->post('/createUtilisateur', UtilisateurController::class . ':createUtilisateur');
            $group->put('/updateUtilisateur/{id}', AdresseController::class . ':updateUtilisateur');
        })->add(new ResponseMiddleware());
    }

    public static function adressesRoutes($app): void
    {
        $app->group('/adresses', function (RouteCollectorProxy $group) {
            $group->put('/updateAdresse/{id}', AdresseController::class . ':updateAdresse');
            $group ->post('/createAdresse', AdresseController::class . ':createAdresse');

        })->add(new ResponseMiddleware());
    }



}








