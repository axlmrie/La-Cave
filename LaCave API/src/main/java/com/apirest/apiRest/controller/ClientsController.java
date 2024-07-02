package com.apirest.apiRest.controller;

import com.apirest.apiRest.model.Clients;
import com.apirest.apiRest.service.ClientsService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

        import java.util.List;
import java.util.Map;

@RestController
@RequestMapping("/clients")
@AllArgsConstructor
public class ClientsController {
    private final ClientsService clientsService;

    @PostMapping("/login")
    public ResponseEntity<Object> login(@RequestBody Map<String, String> payload) {
        String email = payload.get("email");
        String password = payload.get("password");

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
