# La-Cave


Tables mysql :

 <pre>
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
