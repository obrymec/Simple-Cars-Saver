<?php
    /*
    * Ce script php gère les demandes (requêtes) éffectuées à partir de la page "_listeProprietaire.html".
    * Ainsi l'objectif de cet script est de satisfaire les trois opérations suivantes:
    *   -> Récupérer la liste de toutes les marques de voiture de la table Marque.
    *   -> Récupérer la liste de toutes les modèles associés à la marque de voiture choisie.
    *   -> Rechercher un propriétaire possédant le véhicule ayant les caractéristiques soulignées.
    */

    // La ligne de code ci-dessous accomplie les objectifs de ce script.
    try {
        // Création d'une connexion vers la base de données "cars_saver" en mode "root" sans mot de passe particulier.
        $db = new PDO ("mysql:host=localhost;dbname=cars_saver;charset=utf8", "root", '');
        // Si l'opération à effectuée vaut: "recuperer_marques".
        if ($_POST ["operation"] == "recuperer_marques") {
            // Préparation de la requête de récupération des marques de voiture.
            $marques = $db->prepare ("SELECT DISTINCT codmarq, nommarq FROM Marque;");
            // Exécutons la requête ainsi préparée.
            $marques->execute ();
            // Récupération des résultats de la requête SQL.
            $resultats = $marques->fetchAll ();
            // Envoie des données à la surface.
            echo json_encode (array ("marques" => $resultats));
        // Si l'opération à effectuée vaut: "recuperer_modeles".
        } elseif ($_POST ["operation"] == "recuperer_modeles") {
            // Préparation de la requête de récupération des modèles de voiture.
            $modeles = $db->prepare ("SELECT DISTINCT Modele.nommod FROM Modele INNER JOIN Marque ON Modele.codmarq = :codmarq;");
            // Exécutons la requête ainsi préparée.
            $modeles->execute (array ("codmarq" => $_POST ["code_marque"]));
            // Récupération des résultats de la requête SQL.
            $resultats = $modeles->fetchAll ();
            // Envoie des données à la surface.
            echo json_encode (array ("modeles" => $resultats));
        // Si l'opération à effectuée vaut: "rechercher_un_proprietaire".
        } elseif ($_POST ["operation"] == "rechercher_un_proprietaire") {
            // Préparation de la requête de récupération des propriétaires.
            $proprietaires = $db->prepare ("SELECT DISTINCT Proprietaire.nomprop, Proprietaire.preprop, Proprietaire.sexe, Proprietaire.ville
                FROM Proprietaire, modele, marque, vehicule WHERE proprietaire.idprop = vehicule.idprop AND vehicule.type = :type AND
                modele.nommod = :nommod AND marque.nommarq = :nommarq;");
            // Exécutons la requête ainsi préparée.
            $proprietaires->execute (array ("type" => $_POST ["type"], "nommarq" => $_POST ["nom_marque"], "nommod" => $_POST ["nom_modele"]));
            // Récupération des résultats de la requête SQL.
            $resultats = $proprietaires->fetchAll ();
            // Envoie des données à la surface.
            echo json_encode (array ("proprietaires" => $resultats));
        }
    // Gestion de l'erreur.
    } catch (PDOException $exp) {
        // Affichons le méssage d'erreur détecté.
        echo ("Erreur de connexion à la base de données: " . $exp->getMessage ());
    }
?>
