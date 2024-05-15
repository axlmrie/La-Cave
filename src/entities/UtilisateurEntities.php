<?php

namespace src\entities;

class UtilisateurEntities {

    public $id_utilisateur;
    public $prenom;
    public $nom;
    public $matricule;
    public $date_suppression;

    public function __construct(){
        $this->id_utilisateur = "";
        $this->prenom = "";
        $this->nom = "";
        $this->matricule = "";
        $this->date_suppression = "";
    }

    /**
     * @return mixed
     */
    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * @param mixed $id_utilisateur
     */
    public function setIdUtilisateur($id_utilisateur): void
    {
        $this->id_utilisateur = $id_utilisateur;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * @param mixed $matricule
     */
    public function setMatricule($matricule): void
    {
        $this->matricule = $matricule;
    }

    /**
     * @return mixed
     */
    public function getDateSuppression()
    {
        return $this->date_suppression;
    }

    /**
     * @param mixed $date_suppression
     */
    public function setDateSuppression($date_suppression): void
    {
        $this->date_suppression = $date_suppression;
    }


}