package com.apirest.apiRest.service;

import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.model.Utilisateurs;
import com.apirest.apiRest.repositorie.UtilisateursRepository;
import com.apirest.apiRest.service.ArticlesService;
import com.apirest.apiRest.service.UtilisateursService;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
@AllArgsConstructor
public class UtilisateursServiceImpl implements UtilisateursService {

    private final UtilisateursRepository utilisateursRepository;


    @Override
    public List<Utilisateurs> getAll() {
        return utilisateursRepository.findAll();
    }

    @Override
    public Utilisateurs findByIdUtilisateurs(Long idUtilisateurs) {
        Optional<Utilisateurs> optionalUtilisateurs = utilisateursRepository.findById(idUtilisateurs);
        return optionalUtilisateurs.orElse(null);
    }

    @Override
    public Utilisateurs createUtilisateurs(Utilisateurs utilisateurs) {
        return utilisateursRepository.save(utilisateurs);
    }

}