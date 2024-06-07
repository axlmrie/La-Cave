<?php

namespace src\entities;

/**
 * @OA\Schema(
 *     schema="Commande",
 *     type="object",
 *     title="Commande",
 *     properties={
 *         @OA\Property(property="id_commande", type="integer", description="ID de la commande"),
 *         @OA\Property(property="article", type="integer", description="ID de l'article"),
 *         @OA\Property(property="quantite", type="integer", description="Quantité de l'article"),
 *         @OA\Property(property="fournisseur", type="integer", description="ID du fournisseur"),
 *         @OA\Property(property="date_commande", type="string", format="date-time", description="Date de la commande"),
 *         @OA\Property(property="date_suppression", type="string", format="date-time", description="Date de suppression de la commande"),
 *         @OA\Property(property="client", type="integer", description="ID du client")
 *     }
 * )
 */
class CommandeEntities {
    public $id_commande;
    public $article;
    public $quantite;
    public $fournisseur;
    public $date_commande;
    public $date_suppression;
    public $client;

    public function __construct($data = []) {
        $this->id_commande = $data['id_commande'] ?? null;
        $this->article = $data['article'] ?? '';
        $this->quantite = $data['quantite'] ?? '';
        $this->fournisseur = $data['fournisseur'] ?? '';
        $this->date_commande = $data['date_commande'] ?? '';
        $this->date_suppression = $data['date_suppression'] ?? '';
        $this->client = $data['client'] ?? null;
    }

    public function getIdCommande() {
        return $this->id_commande;
    }

    public function setIdCommande($id_commande): void {
        $this->id_commande = $id_commande;
    }

    public function getArticle() {
        return $this->article;
    }

    public function setArticle($article): void {
        $this->article = $article;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function setQuantite($quantite): void {
        $this->quantite = $quantite;
    }

    public function getFournisseur() {
        return $this->fournisseur;
    }

    public function setFournisseur($fournisseur): void {
        $this->fournisseur = $fournisseur;
    }

    public function getDateCommande() {
        return $this->date_commande;
    }

    public function setDateCommande($date_commande): void {
        $this->date_commande = $date_commande;
    }

    public function getDateSuppression() {
        return $this->date_suppression;
    }

    public function setDateSuppression($date_suppression): void {
        $this->date_suppression = $date_suppression;
    }

    public function getClient() {
        return $this->client;
    }

    public function setClient($client): void {
        $this->client = $client;
    }

    public static function readCommandes($database) {
        $req = $database->prepare('SELECT * FROM commandes');
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function affichageCommandes($database) {
        $req = $database->prepare('SELECT commandes.quantite, commandes.date_commande, clients.nom AS nom_client, fournisseurs.nom AS nom_fournisseur, articles.designation 
            FROM commandes 
            INNER JOIN clients ON commandes.client = clients.id_client 
            INNER JOIN articles ON commandes.article = articles.id_article 
            INNER JOIN fournisseurs ON commandes.fournisseur = fournisseurs.id_fournisseurs');
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteCommande($database) {
        $req = $database->prepare("
        UPDATE commandes
        SET date_suppression = :date_suppression
        WHERE id_commande = :id_commande");

        $req->bindParam(":date_suppression", $this->date_suppression);
        $req->bindParam(":id_commande", $this->id_commande);

        $req->execute();

        return $req;
    }

    public function createCommande($database) {
        $req = $database->prepare("
        INSERT INTO commandes (article, quantite, fournisseur, date_commande, date_suppression, client)
        VALUES (:article, :quantite, :fournisseur, :date_commande, :date_suppression, :client)");

        $req->bindParam(':article', $this->article);
        $req->bindParam(':quantite', $this->quantite);
        $req->bindParam(':fournisseur', $this->fournisseur);
        $req->bindParam(':date_commande', $this->date_commande);
        $req->bindParam(':date_suppression', $this->date_suppression);
        $req->bindParam(':client', $this->client);

        $req->execute();

        return $req;
    }
}