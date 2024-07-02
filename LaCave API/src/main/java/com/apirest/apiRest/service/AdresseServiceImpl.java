package com.apirest.apiRest.service;

import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.repositorie.AdresseRepository;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;

import java.time.LocalDate;
import java.util.List;
import java.util.Optional;


@Service
@AllArgsConstructor
public class AdresseServiceImpl implements AdresseService {

    private final AdresseRepository adresseRepository;




    @Override
    public Adresse findByIdAdresse(Long idAdresse) {
        Optional<Adresse> optionalAdresse = adresseRepository.findById(idAdresse);
        return optionalAdresse.orElse(null); // Vous pouvez gérer le cas où l'adresse n'est pas trouvée ici
    }




    @Override
    public Adresse modifyAdresse(int id, Adresse adresse) {
        return adresseRepository.findById((long) id)
                .map(p -> {
                    p.setCode_postal(adresse.getCode_postal());
                    p.setPays(adresse.getPays());
                    p.setVille(adresse.getVille());
                    p.setFacturation(adresse.getFacturation());
                    p.setNumero_rue(adresse.getNumero_rue());
                    p.setNom_rue(adresse.getNom_rue());
                    return adresseRepository.save(p);
                }).orElseThrow(()-> new RuntimeException("Adresse introuvable"));
    }

    @Override
    public Adresse createAdresse(Adresse adresse) {
        return adresseRepository.save(adresse);
    }

//    @Override
//    public String deleteDate(int id, LocalDate date) {
//        adresseRepository.deleteDate(id, date);
//        return "salarié supprimé";
//    }








//    @Override
//    public List<Salaries> createSalaries(List<Salaries> salariesList) {
//        for (Salaries salaries : salariesList) {
//            createSalarie(salaries); // Appel à la méthode createSalarie pour chaque salarié
//        }
//        return salariesList; // Vous pouvez retourner la liste créée si nécessaire
//    }


//    @Override
//    public Iterable<Salaries> findByAllFiltre(int id_site, int id_service, String text) {
//        return salarieRepository.findByAllFiltre(id_site, id_service, text);
//    }

}
