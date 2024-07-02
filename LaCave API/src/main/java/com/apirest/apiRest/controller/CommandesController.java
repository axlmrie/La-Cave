package com.apirest.apiRest.controller;


import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.model.Articles;
import com.apirest.apiRest.model.Clients;
import com.apirest.apiRest.model.Commandes;
import com.apirest.apiRest.service.CommandesService;
import lombok.AllArgsConstructor;
import org.springframework.format.annotation.DateTimeFormat;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.time.LocalDate;
import java.util.List;

@RestController
@RequestMapping("/commandes")
@AllArgsConstructor
public class CommandesController {
    private final CommandesService commandesService;

    @GetMapping("/findById/{id}")
    public ResponseEntity<Commandes> getCommandesById(@PathVariable Long id) {
        Commandes commandes = commandesService.findByIdCommande(id);
        if (commandes != null) {
            return ResponseEntity.ok(commandes);
        } else {
            return ResponseEntity.notFound().build();
        }
    }

    @GetMapping("/FindAll")
    public List<Commandes> getAll() {
        return commandesService.getAll();
    }

    @PostMapping("/create")
    public Commandes create(@RequestBody Commandes commandes) {
        return commandesService.createCommandes(commandes);
    }

    @PutMapping("/deleteDate/{id}")
    public String deleteDate(@PathVariable int id, @RequestParam("date") @DateTimeFormat(iso = DateTimeFormat.ISO.DATE) LocalDate date) {
        return commandesService.deleteDate(id, date);
    }

    @PutMapping("/update/{id}")
    public Commandes update (@PathVariable int id, @RequestBody Commandes commandes) {
        return commandesService.modifyCommandes(id, commandes);
    }
    @GetMapping("/findSiteByClient")
    public Iterable<Commandes> findSiteByClient(@RequestParam int client) {
        return commandesService.findByClient(client);
    }


}
