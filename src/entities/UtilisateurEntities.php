<?php

namespace src\entities;

/**
 * @OA\Schema(
 *     schema="Utilisateur",
 *     type="object",
 *     title="Utilisateur",
 *     properties={
 *         @OA\Property(property="id_utilisateur", type="integer", description="ID de l'utilisateur"),
 *         @OA\Property(property="prenom", type="string", description="Prénom de l'utilisateur"),
 *         @OA\Property(property="nom", type="string", description="Nom de l'utilisateur"),
 *         @OA\Property(property="matricule", type="string", description="Matricule de l'utilisateur"),
 *         @OA\Property(property="date_suppression", type="string", format="date-time", description="Date de suppression de l'utilisateur")
 *     }
 * )
 */
class UtilisateurEntities {

    public $id_utilisateur;
    public $prenom;
    public $nom;
    public $matricule;
    public $date_suppression;

    public function __construct($data = []){
        $this->id_utilisateur = $data['id_utilisateur'] ?? null;
        $this->prenom = $data['prenom'] ?? '';
        $this->nom = $data['nom'] ?? '';
        $this->matricule = $data['matricule'] ?? '';
        $this->date_suppression = $data['date_suppression'] ?? null;
    }

    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur($id_utilisateur): void
    {
        $this->id_utilisateur = $id_utilisateur;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    public function getMatricule()
    {
        return $this->matricule;
    }

    public function setMatricule($matricule): void
    {
        $this->matricule = $matricule;
    }

    public function getDateSuppression()
    {
        return $this->date_suppression;
    }

    public function setDateSuppression($date_suppression): void
    {
        $this->date_suppression = $date_suppression;
    }

    public static function readUtilisateur($database)
    {
        $req = $database->prepare("SELECT * FROM utilisateurs");
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createUtilisateur($database)
    {
        $req = $database->prepare("
        INSERT INTO utilisateurs (nom, prenom, matricule, date_suppression) VALUES (:nom, :prenom, :matricule, :date_suppression)");

        $req->bindParam(":nom", $this->nom);
        $req->bindParam(":prenom", $this->prenom);
        $req->bindParam(":matricule", $this->matricule);
        $req->bindParam(":date_suppression", $this->date_suppression);

        $req->execute();

        return $req;
    }

    public function updateUtilisateur($database)
    {
        $req = $database->prepare("
        UPDATE utilisateurs 
        SET nom = :nom,
            prenom = :prenom,
            matricule = :matricule,
            date_suppression = :date_suppression
        WHERE id_utilisateur = :id_utilisateur");

        $req->bindParam(":nom", $this->nom);
        $req->bindParam(":prenom", $this->prenom);
        $req->bindParam(":matricule", $this->matricule);
        $req->bindParam(":date_suppression", $this->date_suppression);
        $req->bindParam(":id_utilisateur", $this->id_utilisateur);

        $req->execute();

        return $req;
    }
}