/*Requête de création de la table marque*/
CREATE TABLE Marque (
    codmarq INTEGER PRIMARY KEY AUTO_INCREMENT,
    nommarq VARCHAR (32) NOT NULL
) Engine = InnoDB;

/*Requête de création de la table propriétaire*/
CREATE TABLE Proprietaire (
    idprop INTEGER PRIMARY KEY AUTO_INCREMENT,
    nomprop VARCHAR (32) NOT NULL,
    preprop VARCHAR (32) NOT NULL,
    ville VARCHAR (32) NOT NULL,
    sexe INTEGER NOT NULL
) Engine = InnoDB;

/*Requête de création de la table modèle*/
CREATE TABLE Modele (
    idmod INTEGER PRIMARY KEY AUTO_INCREMENT,
    nommod VARCHAR (16) NOT NULL,
    codmarq INTEGER NOT NULL,
    annee INTEGER NOT NULL,
    FOREIGN KEY (codmarq) REFERENCES Marque (codmarq) ON DELETE CASCADE
) Engine = InnoDB;

/*Requête de création de la table véhicule*/
CREATE TABLE Vehicule (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    numImmat VARCHAR (64) NOT NULL,
    couleur VARCHAR (16) NOT NULL,
    puissance FLOAT DEFAULT 0.0,
    type VARCHAR (64) NOT NULL,
    idprop INTEGER NOT NULL,
    idmod INTEGER NOT NULL,
    FOREIGN KEY (idprop) REFERENCES Proprietaire (idprop) ON DELETE CASCADE,
    FOREIGN KEY (idmod) REFERENCES Modele (idmod) ON DELETE CASCADE
) Engine = InnoDB;
