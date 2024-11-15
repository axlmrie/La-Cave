La Cave

Description du projet

La Cave est une solution de suivi de stock développée dans le cadre de ma première année au CESI. Ce projet avait pour objectif de créer une application permettant à une entreprise de gérer efficacement ses stocks de vin, en offrant des fonctionnalités adaptées aux besoins des utilisateurs.

Le projet a été réalisé en collaboration avec Maxence, mon camarade de classe. Nous avons utilisé des technologies modernes et des pratiques de développement collaboratif pour atteindre nos objectifs.

Fonctionnalités

Gestion des stocks : suivi des références, quantités et informations détaillées des produits.
Organisation des vins : par catégories (ex. cépages, types, millésimes).
Consultation et mise à jour des données : depuis une interface utilisateur intuitive.
Architecture back-end robuste : prise en charge des opérations CRUD via une API sécurisée.
Technologies utilisées

Front-end
React.js : pour construire une interface utilisateur réactive et moderne.
Back-end
Java Spring Boot : pour développer une API REST performante et scalable.
Base de données
MariaDB : pour stocker et gérer les données des vins.
Installation

Prérequis
Node.js (version 16+ recommandée)
Java 17 (JDK)
MariaDB (ou un serveur compatible avec les scripts SQL fournis)
Maven (pour la gestion des dépendances Java)

Auteurs

Axel M. (GitHub : axlmrie)
Maxence (GitHub : Tymacz)









Tables mysql :

 <pre>

Create Database lacave;

use lacave;
  
create table famille(
    id_famille INT AUTO_INCREMENT PRIMARY KEY,
    cepage varchar(255),
    annee YEAR ,
    vignoble varchar(255)
);


create table articles( 
    id_article INT AUTO_INCREMENT PRIMARY KEY, 
    reference varchar(255), 
    designation varchar(255), 
    famille INT ,
    FOREIGN KEY (famille) REFERENCES famille(id_famille) , 
    stock INT,
    prix INT, 
    conditionnement varchar(255) 
);


create table adresse(  
    id_adresse INT AUTO_INCREMENT PRIMARY KEY,  
    nom_rue varchar(255),  
    ville varchar(255),  
    numero_rue INT , 
    code_postal varchar(255), 
    pays varchar(255), 
    facturation tinyint
);


create table fournisseurs( 
    id_fournisseurs INT AUTO_INCREMENT PRIMARY KEY, 
    numero_tel varchar(255), 
    nom varchar(255),
    adresse int ,
    FOREIGN KEY (adresse) REFERENCES adresse(id_adresse) , 
    date_suppression TIMESTAMP );


CREATE TABLE clients (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    adresse_livraison INT,
    FOREIGN KEY (adresse_livraison) REFERENCES adresse(id_adresse),
    adresse_facturation INT,
    FOREIGN KEY (adresse_facturation) REFERENCES adresse(id_adresse),
    date_suppression TIMESTAMP,
    numero_tel VARCHAR(255),
    prenom VARCHAR(255),
    nom VARCHAR(255),
    password VARCHAR(255)
    );


create table commandes(  
    id_commande INT AUTO_INCREMENT PRIMARY KEY,  
    article INT , 
    FOREIGN KEY (article) REFERENCES articles(id_article) ,  
    quantite INT, 
    client INT,  
    FOREIGN KEY (client) REFERENCES clients(id_client) ,  
    fournisseur INT, 
    FOREIGN KEY (fournisseur) REFERENCES fournisseurs(id_fournisseurs) , 
    date_commande TIMESTAMP, 
    date_suppression DATE 
  );


Create table utilisateurs ( 
    id_user INT AUTO_INCREMENT PRIMARY KEY,  
    prenom varchar(255), 
    nom varchar(255), 
    matricule varchar(255), 
    date_suppression TIMESTAMP 
);
</pre>
