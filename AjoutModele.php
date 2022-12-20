<?php
    /*
    * Ce script php gère les demandes (requêtes) éffectuées à partir de la page "AjoutModele.html".
    * Ainsi l'objectif de cet script est de satisfaire les deux opérations suivantes:   
    *   -> Récupérer la liste de toutes les marques de voiture de la table Marque.
    *   -> Insérer un modèle de voiture préalablement donné par l'utilisateur via la page "AjoutModele.html".
    */

    // La ligne de code ci-dessous accomplie les objectifs de ce script.
    try {
        // Création d'une connexion vers la base de données "cars_saver" en mode "root" sans mot de passe particulier.
        $db = new PDO ("mysql:host=localhost;dbname=cars_saver;charset=utf8", "root", '');
        // Si l'opération à effectuée vaut: "recuperer_marques".
        if ($_POST ["operation"] == "recuperer_marques") {
            // Préparation de la requête de récupération des marques de voiture.
            $marques = $db->prepare ("SELECT * FROM Marque;");
            // Exécutons la requête ainsi préparée.
            $marques->execute ();
            // Récupération des résultats de la requête SQL.
            $resultats = $marques->fetchAll ();
            // Envoie des données à la surface.
            echo json_encode (array ("marques" => $resultats));
        // Si l'opération à effectuée vaut: "ajouter_un_modele".
        } elseif ($_POST ["operation"] == "ajouter_un_modele") {
            // Préparation de la requête d'ajout de modèle.
            $ajouter_un_modele = $db->prepare ("INSERT INTO Modele (codmarq, nommod, annee) VALUES (:codmarq, :nommod, :annee);");
            // Exécutons la requête ainsi préparée avec les données requises.
            $ajouter_un_modele->execute (array (
                "codmarq" => $_POST ["code_marque"], "nommod" => $_POST ["modele_de_voiture"], "annee" => $_POST ["annee_de_fabrication"]
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
