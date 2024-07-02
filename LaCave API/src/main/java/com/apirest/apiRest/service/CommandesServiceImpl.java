package com.apirest.apiRest.service;

import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.model.Articles;
import com.apirest.apiRest.model.Clients;
import com.apirest.apiRest.model.Commandes;
import com.apirest.apiRest.repositorie.CommandesRepository;
import com.apirest.apiRest.service.CommandesService;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;

import java.time.LocalDate;
import java.util.List;
import java.util.Optional;

@Service
@AllArgsConstructor
public class CommandesServiceImpl implements CommandesService {

    private final CommandesRepository commandesRepository;

    @Override
    public Commandes findByIdCommande(Long idCommande) {
        Optional<Commandes> optionalCommandes = commandesRepository.findById(idCommande);
        return optionalCommandes.orElse(null);
    }

    @Override
    public List<Commandes> getAll() {
        return commandesRepository.findAll();
    }

    @Override
    public Commandes createCommandes(Commandes commandes) {
        return commandesRepository.save(commandes);
    }

    @Override
    public String deleteDate(int id, LocalDate date) {
        commandesRepository.deleteDate(id, date);
        return "Commandes supprimé";
    }

    @Override
    public Commandes modifyCommandes(int id, Commandes commandes) {
        return commandesRepository.findById((long) id)
                .map(p -> {
                    p.setDate_commande(commandes.getDate_commande());
                    p.setClient(commandes.getClient());
                    p.setArticle(commandes.getArticle());
                    p.setFournisseur(commandes.getFournisseur());
                    p.setQuantite(commandes.getQuantite());
                    p.setDate_suppression(commandes.getDate_suppression());
                    return commandesRepository.save(p);
                }).orElseThrow(()-> new RuntimeException("Commandes introuvable"));
    }
    @Override
    public Iterable<Commandes> findByClient(int client) {
        return commandesRepository.findByClient(client);
    }


}