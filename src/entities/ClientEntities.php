<?php

namespace src\entities;

/**
 * @OA\Schema(
 *     schema="Client",
 *     type="object",
 *     title="Client",
 *     properties={
 *         @OA\Property(property="id_client", type="integer", description="ID du client"),
 *         @OA\Property(property="prenom", type="string", description="Prénom du client"),
 *         @OA\Property(property="nom", type="string", description="Nom du client"),
 *         @OA\Property(property="password", type="string", description="Mot de passe du client"),
 *         @OA\Property(property="date_suppression", type="string", format="date-time", description="Date de suppression du client"),
 *         @OA\Property(property="adresse_livraison", type="integer", description="Adresse de livraison du client"),
 *         @OA\Property(property="adresse_facturation", type="integer", description="Adresse de facturation du client"),
 *         @OA\Property(property="numero_tel", type="string", description="Numéro de téléphone du client"),
 *         @OA\Property(property="mail", type="string", description="Email du client")
 *     }
 * )
 */
class ClientEntities {
    public $id_client;
    public $nom;
    public $prenom;
    public $mot_de_passe;
    public $numero_telephone;
    public $adresse_facturation;
    public $adresse_livraison;
    public $date_suppression;
    public $mail;

    public function __construct($data = []) {
        $this->id_client = $data['id_client'] ?? null;
        $this->prenom = $data['prenom'] ?? '';
        $this->nom = $data['nom'] ?? '';
        $this->mot_de_passe = $data['password'] ?? '';
        $this->date_suppression = $data['date_suppression'] ?? null;
        $this->adresse_livraison = $data['adresse_livraison'] ?? '';
        $this->adresse_facturation = $data['adresse_facturation'] ?? '';
        $this->numero_telephone = $data['numero_tel'] ?? '';
        $this->mail = $data['mail'] ?? '';
    }

    public function getIdClient() {
        return $this->id_client;
    }

    public function setIdClient($id_client): void {
        $this->id_client = $id_client;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom): void {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom): void {
        $this->prenom = $prenom;
    }

    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail): void {
        $this->mail = $mail;
    }

    public function getMotDePasse() {
        return $this->mot_de_passe;
    }

    public function setMotDePasse($mot_de_passe): void {
        $this->mot_de_passe = $mot_de_passe;
    }

    public function getNumeroTelephone() {
        return $this->numero_telephone;
    }

    public function setNumeroTelephone($numero_telephone): void {
        $this->numero_telephone = $numero_telephone;
    }

    public function getAdresseFacturation() {
        return $this->adresse_facturation;
    }

    public function setAdresseFacturation($adresse_facturation): void {
        $this->adresse_facturation = $adresse_facturation;
    }

    public function getAdresseLivraison() {
        return $this->adresse_livraison;
    }

    public function setAdresseLivraison($adresse_livraison): void {
        $this->adresse_livraison = $adresse_livraison;
    }

    public function getDateSuppression() {
        return $this->date_suppression;
    }

    public function setDateSuppression($date_suppression): void {
        $this->date_suppression = $date_suppression;
    }

    public function login($database)
    {

        $req = $database->prepare("SELECT * FROM clients WHERE mail = :mail AND password = :password");
        $req->bindParam(':mail', $this->mail);
        $req->bindParam(':password', $this->mot_de_passe);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function register($database) {
        $req = $database->prepare("INSERT INTO clients (prenom, nom, password, date_suppression, adresse_livraison, adresse_facturation, numero_tel, mail) 
                VALUES (:prenom, :nom, :password, :date_suppression, :adresse_livraison, :adresse_facturation, :numero_tel, :mail)");

        $req->bindParam(":prenom", $this->prenom);
        $req->bindParam(":nom", $this->nom);
        $req->bindParam(":password", $this->mot_de_passe);
        $req->bindParam(":date_suppression", $this->date_suppression);
        $req->bindParam(":adresse_livraison", $this->adresse_livraison);
        $req->bindParam(":adresse_facturation", $this->adresse_facturation);
        $req->bindParam(":numero_tel", $this->numero_telephone);
        $req->bindParam(":mail", $this->mail);

        $req->execute();

        return $req->rowCount() == 1;
    }

    public static function readClient($database) {
        $req = $database->prepare('SELECT * FROM clients');
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }
}