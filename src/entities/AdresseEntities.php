<?php

namespace src\entities;

/**
 * @OA\Schema(
 *     schema="Adresse",
 *     type="object",
 *     title="Adresse",
 *     properties={
 *         @OA\Property(property="id_adresse", type="integer", description="ID de l'adresse"),
 *         @OA\Property(property="nom_rue", type="string", description="Nom de la rue"),
 *         @OA\Property(property="numero_rue", type="string", description="Numéro de la rue"),
 *         @OA\Property(property="ville", type="string", description="Ville"),
 *         @OA\Property(property="code_postal", type="string", description="Code postal"),
 *         @OA\Property(property="pays", type="string", description="Pays"),
 *         @OA\Property(property="facturation", type="boolean", description="Facturation")
 *     }
 * )
 */
class AdresseEntities {
    private $id_adresse;
    private $nom_rue;
    private $numero_rue;
    private $ville;
    private $code_postal;
    private $pays;
    private $facturation;

    // Constructeur avec paramètre par défaut
    public function __construct($data = []) {
        $this->id_adresse = $data['id_adresse'] ?? null;
        $this->nom_rue = $data['nom_rue'] ?? '';
        $this->numero_rue = $data['numero_rue'] ?? '';
        $this->ville = $data['ville'] ?? '';
        $this->code_postal = $data['code_postal'] ?? '';
        $this->pays = $data['pays'] ?? '';
        $this->facturation = $data['facturation'] ?? false;
    }

    // Getters
    public function getIdAdresse() {
        return $this->id_adresse;
    }

    public function getNomRue() {
        return $this->nom_rue;
    }

    public function getNumeroRue() {
        return $this->numero_rue;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getCodePostal() {
        return $this->code_postal;
    }

    public function getPays() {
        return $this->pays;
    }

    public function getFacturation() {
        return $this->facturation;
    }

    // Setters
    public function setIdAdresse($id_adresse): void {
        $this->id_adresse = $id_adresse;
    }

    public function setNomRue($nom_rue): void {
        $this->nom_rue = $nom_rue;
    }

    public function setNumeroRue($numero_rue): void {
        $this->numero_rue = $numero_rue;
    }

    public function setVille($ville): void {
        $this->ville = $ville;
    }

    public function setCodePostal($code_postal): void {
        $this->code_postal = $code_postal;
    }

    public function setPays($pays): void {
        $this->pays = $pays;
    }

    public function setFacturation($facturation): void {
        $this->facturation = filter_var($facturation, FILTER_VALIDATE_BOOLEAN);
    }

    // Méthode pour mettre à jour l'adresse dans la base de données
    public function updateAdresse($database) {
        $req = $database->prepare("
            UPDATE adresse 
            SET nom_rue = :nom_rue,
                ville = :ville,
                numero_rue = :numero_rue,
                code_postal = :code_postal,
                pays = :pays,
                facturation = :facturation
            WHERE id_adresse = :id_adresse
        ");

        $req->bindParam(':nom_rue', $this->nom_rue);
        $req->bindParam(':ville', $this->ville);
        $req->bindParam(':numero_rue', $this->numero_rue);
        $req->bindParam(':code_postal', $this->code_postal);
        $req->bindParam(':pays', $this->pays);
        $req->bindParam(':facturation', $this->facturation, \PDO::PARAM_BOOL);
        $req->bindParam(':id_adresse', $this->id_adresse);

        $req->execute();

        return $req->rowCount() == 1;
    }

    public function createAdresse($database) {
        $req = $database->prepare("
            INSERT INTO adresse 
            (nom_rue, ville, numero_rue, code_postal, pays, facturation)
            VALUES (:nom_rue, :ville, :numero_rue, :code_postal, :pays, :facturation)
        ");

        $req->bindParam(':nom_rue', $this->nom_rue);
        $req->bindParam(':ville', $this->ville);
        $req->bindParam(':numero_rue', $this->numero_rue);
        $req->bindParam(':code_postal', $this->code_postal);
        $req->bindParam(':pays', $this->pays);
        $req->bindParam(':facturation', $this->facturation, \PDO::PARAM_BOOL);

        $req->execute();

        return $req->rowCount() == 1;
    }
}