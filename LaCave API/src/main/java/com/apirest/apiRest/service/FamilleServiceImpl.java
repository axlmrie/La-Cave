package com.apirest.apiRest.service;

import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.model.Famille;
import com.apirest.apiRest.repositorie.FamilleRepository;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;

import java.util.Optional;

@Service
@AllArgsConstructor
public class FamilleServiceImpl implements FamilleService {

    private final FamilleRepository familleRepository;


    @Override
    public Famille findByIdFamille(Long idFamille) {
        Optional<Famille> optionalFamille = familleRepository.findById(idFamille);
        return optionalFamille.orElse(null);
    }




    @Override
    public Famille modifyFamille(int id, Famille famille) {
        return familleRepository.findById((long) id)
                .map(p -> {
                    p.setAnnee(famille.getAnnee());
                    p.setCepage(famille.getCepage());
                    p.setVignoble(famille.getVignoble());
                    return familleRepository.save(p);
                }).orElseThrow(()-> new RuntimeException("Adresse introuvable"));
    }

    @Override
    public Famille createFamille(Famille famille) {
        return familleRepository.save(famille);
    }

}
