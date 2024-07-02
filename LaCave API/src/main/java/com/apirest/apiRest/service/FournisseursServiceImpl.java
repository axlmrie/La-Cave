package com.apirest.apiRest.service;

import com.apirest.apiRest.model.Famille;
import com.apirest.apiRest.model.Fournisseurs;
import com.apirest.apiRest.repositorie.FournisseursRepository;
import com.apirest.apiRest.service.FournisseursService;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;

import java.util.Optional;

@Service
@AllArgsConstructor
public class FournisseursServiceImpl implements FournisseursService {

    private final FournisseursRepository fournisseursRepository;



    @Override
    public Fournisseurs findByIdFournisseurs(Long idFournisseurs) {
        Optional<Fournisseurs> optionalFournisseurs = fournisseursRepository.findById(idFournisseurs);
        return optionalFournisseurs.orElse(null);
    }




    @Override
    public Fournisseurs modifyFournisseurs(int id, Fournisseurs fournisseurs) {
        return fournisseursRepository.findById((long) id)
                .map(p -> {
                    p.setAdresse(fournisseurs.getAdresse());
                    p.setNom(fournisseurs.getNom());
                    p.setDate_suppression(fournisseurs.getDate_suppression());
                    p.setNumero_tel(fournisseurs.getNumero_tel());
                    return fournisseursRepository.save(p);
                }).orElseThrow(()-> new RuntimeException("fournisseurs introuvable"));
    }

    @Override
    public Fournisseurs createFournisseurs(Fournisseurs fournisseurs) {
        return fournisseursRepository.save(fournisseurs);
    }










}