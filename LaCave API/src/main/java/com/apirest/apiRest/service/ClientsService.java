package com.apirest.apiRest.service;

import com.apirest.apiRest.model.Clients;


import java.util.List;
import java.time.LocalDate;

public interface ClientsService {

    Clients login(String email, String password);
    Clients createClients(Clients clients);

}
