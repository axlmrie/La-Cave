package com.apirest.apiRest.service;

import com.apirest.apiRest.model.Clients;
import com.apirest.apiRest.repositorie.ClientsRepository;
import com.apirest.apiRest.service.ClientsService;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;

@Service
@AllArgsConstructor
public class ClientsServiceImpl implements ClientsService {

    private final ClientsRepository clientsRepository;

    @Override
    public Clients login(String email, String password) {
        Clients clients = clientsRepository.login(email, password);
        if (clients == null) {
            return null; // Retourne null si aucun utilisateur correspondant n'est trouvé
        }
        return clients;
    }
    @Override
    public Clients createClients(Clients clients) {
        return clientsRepository.save(clients);
    }

}