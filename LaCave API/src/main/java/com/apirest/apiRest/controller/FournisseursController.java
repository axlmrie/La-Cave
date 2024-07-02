package com.apirest.apiRest.controller;

import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.model.Famille;
import com.apirest.apiRest.model.Fournisseurs;
import com.apirest.apiRest.service.AdresseService;
import com.apirest.apiRest.service.FamilleService;
import com.apirest.apiRest.service.FournisseursService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/fournisseurs")
@AllArgsConstructor
public class FournisseursController {
    private final FournisseursService fournisseursService;



    @GetMapping("/findById/{id}")
    public ResponseEntity<Fournisseurs> getFournisseursById(@PathVariable Long id) {
        Fournisseurs fournisseurs = fournisseursService.findByIdFournisseurs(id);
        if (fournisseurs != null) {
            return ResponseEntity.ok(fournisseurs);
        } else {
            return ResponseEntity.notFound().build();
        }
    }

    @PutMapping("/update/{id}")
    public Fournisseurs update (@PathVariable int id, @RequestBody Fournisseurs fournisseurs) {
        return fournisseursService.modifyFournisseurs(id, fournisseurs);
    }

    @PostMapping("/create")
    public Fournisseurs create(@RequestBody Fournisseurs fournisseurs) {
        return fournisseursService.createFournisseurs(fournisseurs);
    }

}
