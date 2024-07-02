package com.apirest.apiRest.service;

import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.model.Articles;
import com.apirest.apiRest.model.Clients;
import com.apirest.apiRest.model.Commandes;

import java.util.List;
import java.time.LocalDate;

public interface CommandesService {

    Commandes findByIdCommande(Long idCommande);
    List<Commandes> getAll();
    Commandes createCommandes(Commandes commandes);
    String deleteDate(int id, LocalDate date);
    Commandes modifyCommandes(int id, Commandes commandes);
    Iterable<Commandes> findByClient(int client);








}
