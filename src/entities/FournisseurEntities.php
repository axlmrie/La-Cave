<?php

namespace src\entities;


class FournisseurEntities {
    public $id_fournisseur;
    public $nom;
    public $adresse;
    public $date_suppression;
    public $numero_telephone;

    public function __construct($data = []){
        $this->id_fournisseur = $data['id_fournisseur'] ?? null;
        $this->nom = $data['nom'] ?? '';
        $this->adresse = $data['adresse'] ?? '';
        $this->date_suppression = $data['date_suppression'] ?? '';
        $this->numero_telephone = $data['numero_telephone'] ?? '';
    }

    public function getIdFournisseur()
    {
        return $this->id_fournisseur;
    }

    public function setIdFournisseur($id_fournisseur): void
    {
        $this->id_fournisseur = $id_fournisseur;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse): void
    {
        $this->adresse = $adresse;
    }

    public function getDateSuppression()
    {
        return $this->date_suppression;
    }

    public function setDateSuppression($date_suppression): void
    {
        $this->date_suppression = $date_suppression;
    }

    public function getNumeroTelephone()
    {
        return $this->numero_telephone;
    }

    public function setNumeroTelephone($numero_telephone): void
    {
        $this->numero_telephone = $numero_telephone;
    }

    public static function readFournisseurs($database)
    {
        $req = $database->prepare('SELECT * FROM fournisseurs');
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createFournisseur($database)
    {
        $req = $database->prepare("
        INSERT INTO fournisseurs (nom, adresse, date_suppression, numero_telephone) 
        VALUES (:nom, :adresse, :date_suppression, :numero_telephone)");

        $req->bindParam(":nom", $this->nom);
        $req->bindParam(":adresse", $this->adresse);
        $req->bindParam(":date_suppression", $this->date_suppression);
        $req->bindParam(":numero_telephone", $this->numero_telephone);

        $req->execute();

        return $req;
    }

    public function updateFournisseur($database)
    {
        $req = $database->prepare("
        UPDATE fournisseurs 
        SET nom = :nom,
            adresse = :adresse,
            date_suppression = :date_suppression,
            numero_telephone = :numero_telephone
        WHERE id_fournisseur = :id_fournisseur");

        $req->bindParam(":nom", $this->nom);
        $req->bindParam(":adresse", $this->adresse);
        $req->bindParam(":date_suppression", $this->date_suppression);
        $req->bindParam(":numero_telephone", $this->numero_telephone);
        $req->bindParam(":id_fournisseur", $this->id_fournisseur);

        $req->execute();

        return $req;
    }
}
