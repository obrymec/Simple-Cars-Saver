<?php
    /*
    * Ce script php gère les demandes (requêtes) éffectuées à partir de la page "ajoutVehiPropri.html".
    * Ainsi l'objectif de cet script est de satisfaire les quatres opérations suivantes:
    *   -> Récupérer la liste de toutes les marques de voiture de la table Marque.
    *   -> Récupérer la liste de toutes les modèles associés à la marque de voiture choisie.
    *   -> Insérer un propriétaire et son véhicule dans la base de données.
    *   -> Récupérer l'identifiant du dernier propriétaire inscrit.
    */

    // La ligne de code ci-dessous accomplie les objectifs de ce script.
    try {
        // Création d'une connexion vers la base de données "cars_saver" en mode "root" sans mot de passe particulier.
        $db = new PDO ("mysql:host=localhost;dbname=cars_saver;charset=utf8", "root", '');
        // Si l'opération à effectuée vaut: "recuperer_marques".
        if ($_POST ["operation"] == "recuperer_marques") {
            // Préparation de la requête de récupération des marques de voiture.
            $marques = $db->prepare ("SELECT DISTINCT * FROM Marque;");
            // Exécutons la requête ainsi préparée.
            $marques->execute ();
            // Récupération des résultats de la requête SQL.
            $resultats = $marques->fetchAll ();
            // Envoie des données à la surface.
            echo json_encode (array ("marques" => $resultats));
        // Si l'opération à effectuée vaut: "recuperer_modeles".
        } elseif ($_POST ["operation"] == "recuperer_modeles") {
            // Préparation de la requête de récupération des modèles de voiture.
            $modeles = $db->prepare ("SELECT DISTINCT Modele.idmod, Modele.nommod FROM Modele INNER JOIN Marque ON Modele.codmarq = :codmarq;");
            // Exécutons la requête ainsi préparée.
            $modeles->execute (array ("codmarq" => $_POST ["code_marque"]));
            // Récupération des résultats de la requête SQL.
            $resultats = $modeles->fetchAll ();
            // Envoie des données à la surface.
            echo json_encode (array ("modeles" => $resultats));
        // Si l'opération à effectuée vaut: "ajouter_proprietaire_et_vehicule".
        } elseif ($_POST ["operation"] == "ajouter_proprietaire_et_vehicule") {
            // Préparation de la requête d'ajout d'un véhicule.
            $req1 = $db->prepare ("INSERT INTO Vehicule (numImmat, couleur, puissance, type, idprop, idmod)
                VALUES (:numImmat, :couleur, :puissance, :type, :idprop, :idmod);");
            // Préparation de la requête d'ajout d'un propriétaire.
            $req2 = $db->prepare ("INSERT INTO Proprietaire (nomprop, preprop, sexe, ville) VALUES (:nomprop, :preprop, :sexe, :ville);");
            // Préparation de la requête de récupération de l'identifiant du dernier propriétaire ajouté.
            $req3 = $db->prepare ("SELECT idprop FROM Proprietaire ORDER BY idprop DESC LIMIT 1;");
            // Exécutons la requête ainsi préparée pour l'ajout d'un propriétaire avec les données requises.
            $req2->execute (array ("nomprop" => $_POST ["nom"], "preprop" => $_POST ["prenom"], "sexe" => $_POST ["sexe"], "ville" => $_POST ["ville"]));
            // Exécutons la requête pour la récupération de l'identifiant du propriétaire.
            $req3->execute ();
            // Récupération de l'identifiant du propriétaire.
            $code_proprietaire = $req3->fetch ();
            // Exécutons la requête ainsi préparée pour l'ajout d'un véhicule avec les données requises.
            $req1->execute (array (
                "numImmat" => $_POST ["immatriculation"], "couleur" => $_POST ["couleur"], "puissance" => $_POST ["puissance"],
                "idprop" => $code_proprietaire ["idprop"], "idmod" => $_POST ["code_modele"], "type" => $_POST ["type"]
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
