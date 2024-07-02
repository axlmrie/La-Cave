package com.apirest.apiRest.controller;

import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.model.Clients;
import com.apirest.apiRest.model.Utilisateurs;
import com.apirest.apiRest.service.ClientsService;
import com.apirest.apiRest.service.UtilisateursService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

        import java.util.List;

@RestController
@RequestMapping("/clients")
@AllArgsConstructor
public class ClientsController {
    private final ClientsService clientsService;

    @GetMapping("/login")
    public ResponseEntity<Object> login(@RequestParam String email, @RequestParam String password) {
        Clients clients = clientsService.login(email, password);
        if (clients == null) {
            return ResponseEntity.ok().body(false);
        }
        return ResponseEntity.ok().body(clients);
    }
    @PostMapping("/create")
    public Clients create(@RequestBody Clients clients) {
        return clientsService.createClients(clients);
    }


}
