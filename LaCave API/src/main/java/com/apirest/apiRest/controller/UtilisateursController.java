
package com.apirest.apiRest.controller;

import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.model.Utilisateurs;
import com.apirest.apiRest.service.UtilisateursService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/utilisateurs")
@AllArgsConstructor
public class UtilisateursController {
    private final UtilisateursService utilisateursService;


    @GetMapping("/FindAll")
    public List<Utilisateurs> getAll() {
        return utilisateursService.getAll();
    }

    @GetMapping("/findById/{id}")
    public ResponseEntity<Utilisateurs> getUtilisateursById(@PathVariable Long id) {
        Utilisateurs utilisateurs = utilisateursService.findByIdUtilisateurs(id);
        if (utilisateurs != null) {
            return ResponseEntity.ok(utilisateurs);
        } else {
            return ResponseEntity.notFound().build();
        }
    }
    @PostMapping("/create")
    public Utilisateurs create(@RequestBody Utilisateurs utilisateurs) {
        return utilisateursService.createUtilisateurs(utilisateurs);
    }




}
