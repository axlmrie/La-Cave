

package com.apirest.apiRest.controller;

import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.model.Famille;
import com.apirest.apiRest.service.AdresseService;
import com.apirest.apiRest.service.FamilleService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/famille")
@AllArgsConstructor
public class FamilleController {
    private final FamilleService familleService;



    @GetMapping("/findById/{id}")
    public ResponseEntity<Famille> getFamilleById(@PathVariable Long id) {
        Famille famille = familleService.findByIdFamille(id);
        if (famille != null) {
            return ResponseEntity.ok(famille);
        } else {
            return ResponseEntity.notFound().build();
        }
    }

    @PutMapping("/update/{id}")
    public Famille update (@PathVariable int id, @RequestBody Famille famille) {
        return familleService.modifyFamille(id, famille);
    }

    @PostMapping("/create")
    public Famille create(@RequestBody Famille famille) {
        return familleService.createFamille(famille);
    }

}
