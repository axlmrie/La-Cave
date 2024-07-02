package com.apirest.apiRest.service;

import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.model.Articles;
import com.apirest.apiRest.model.Utilisateurs;

import java.util.List;
import java.time.LocalDate;

public interface UtilisateursService {

    List<Utilisateurs> getAll();
    Utilisateurs findByIdUtilisateurs(Long idUtilisateurs);
    Utilisateurs createUtilisateurs(Utilisateurs utilisateurs);



}
