<?php

namespace src\entities;

/**
 * @OA\Schema(
 *     description="Adresse entity",
 *     title="Adresse",
 *     required={"nom_rue", "numero_rue", "ville", "code_postal", "pays"}
 * )
 */
class AdresseEntities {
    /**
     * @OA\Property(
     *     description="ID de l'adresse",
     *     example="1"
     * )
     * @var int
     */
    public $id_adresse;

    /**
     * @OA\Property(
     *     description="Nom de la rue",
     *     example="Rue de la Liberté"
     * )
     * @var string
     */
    public $nom_rue;
    /**
     * @OA\Property(
     *     description="Numéro de la rue",
     *     example="42"
     * )
     * @var string
     */
    public $numero_rue;
    /**
     * @OA\Property(
     *     description="Ville",
     *     example="Paris"
     * )
     * @var string
     */
    public $ville;

    /**
     * @OA\Property(
     *     description="Code postal",
     *     example="75001"
     * )
     * @var string
     */
    public $code_postal;

    /**
     * @OA\Property(
     *     description="Pays",
     *     example="France"
     * )
     * @var string
     */
    public $pays;

    /**
     * @OA\Property(
     *     description="Type de facturation",
     *     example="Facturation"
     * )
     * @var string
     */
    public $facturation;

    public function __construct(){
        $this->id_adresse = "";
        $this->nom_rue = "";
        $this->numero_rue = "";
        $this->ville = "";
        $this->code_postal = "";
        $this->pays = "";
        $this->facturation = "";
    }


    public function getIdAdresse()
    {
        return $this->id_adresse;
    }


    public function setIdAdresse($id_adresse): void
    {
        $this->id_adresse = $id_adresse;
    }


    public function getNomRue()
    {
        return $this->nom_rue;
    }


    public function setNomRue($nom_rue): void
    {
        $this->nom_rue = $nom_rue;
    }


    public function getNumeroRue()
    {
        return $this->numero_rue;
    }


    public function setNumeroRue($numero_rue): void
    {
        $this->numero_rue = $numero_rue;
    }

    public function getVille()
    {
        return $this->ville;
    }


    public function setVille($ville): void
    {
        $this->ville = $ville;
    }


    public function getCodePostal()
    {
        return $this->code_postal;
    }


    public function setCodePostal($code_postal): void
    {
        $this->code_postal = $code_postal;
    }


    public function getPays()
    {
        return $this->pays;
    }


    public function setPays($pays): void
    {
        $this->pays = $pays;
    }


    public function getFacturation()
    {
        return $this->facturation;
    }


    public function setFacturation($facturation): void
    {
        $this->facturation = $facturation;
    }


}