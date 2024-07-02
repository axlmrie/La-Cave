package com.apirest.apiRest.controller;

import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.service.AdresseService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/adresse")
@AllArgsConstructor
public class AdresseController {
    private final AdresseService adresseService;




//    @PutMapping("/deleteDate/{id}")
//    public String deleteDate(@PathVariable int id, @RequestParam("date") @DateTimeFormat(iso = DateTimeFormat.ISO.DATE) LocalDate date) {
//        return salarieService.deleteDate(id, date);
//    }



    @GetMapping("/findById/{id}")
    public ResponseEntity<Adresse> getAdresseById(@PathVariable Long id) {
        Adresse adresse = adresseService.findByIdAdresse(id);
        if (adresse != null) {
            return ResponseEntity.ok(adresse);
        } else {
            return ResponseEntity.notFound().build();
        }
    }

    @PutMapping("/update/{id}")
    public Adresse update (@PathVariable int id, @RequestBody Adresse adresse) {
        return adresseService.modifyAdresse(id, adresse);
    }

    @PostMapping("/create")
    public Adresse create(@RequestBody Adresse adresse) {
        return adresseService.createAdresse(adresse);
    }

}
