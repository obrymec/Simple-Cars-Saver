<?php
    /*
    * Ce script php gère les demandes (requêtes) éffectuées à partir de la page "ModifVehicule.html".
    * Ainsi l'objectif de cet script est de satisfaire les deux opérations suivantes:   
    *   -> Récupérer la liste de tous les véhicules disponibles dans la base de données.
    *   -> Modifier les informations associées à un véhicule donné grâce à son immatriculation.
    */

    // La ligne de code ci-dessous accomplie les objectifs de ce script.
    try {
        // Création d'une connexion vers la base de données "cars_saver" en mode "root" sans mot de passe particulier.
        $db = new PDO ("mysql:host=localhost;dbname=cars_saver;charset=utf8", "root", '');
        // Si l'opération à effectuée vaut: "recuperer_vehicules".
        if ($_POST ["operation"] == "recuperer_vehicules") {
            // Préparation de la requête de récupération des véhicules.
            $vehicules = $db->prepare ("SELECT Modele.nommod, Vehicule.numImmat FROM Vehicule JOIN Modele ON Vehicule.idmod = Modele.idmod;");
            // Exécutons la requête ainsi préparée.
            $vehicules->execute ();
            // Récupération des résultats de la requête SQL.
            $resultats = $vehicules->fetchAll ();
            // Envoie des données à la surface.
            echo json_encode (array ("vehicules" => $resultats));
        // Si l'opération à effectuée vaut: "modifier_vehicule".
        } elseif ($_POST ["operation"] == "modifier_vehicule") {
            // Préparation de la requête de modification d'un véhicule.
            $modifier_un_vehicule = $db->prepare ("UPDATE Vehicule SET couleur = :couleur, type = :type, puissance = :puissance WHERE numImmat = :numImmat;");
            // Exécutons la requête ainsi préparée avec les données requises.
            $modifier_un_vehicule->execute (array (
                "couleur" => $_POST ["couleur"], "type" => $_POST ["type"], "puissance" => $_POST ["puissance"], "numImmat" => $_POST ["immatriculation"]
            ));
            // Envoie d'une réponse à la surface pour informer l'utilisateur de la réussite de l'opération.
            echo json_encode (array ("status" => 200));
        }
    // Gestion de l'erreur.
    } catch (PDOException $exp) {
        // Affichons le méssage d'erreur détecté.
        echo ("Erreur de connexion à la base de données: " . $exp->getMessage ());
    }
?>
