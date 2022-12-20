/*
*   Ce script représente le gestionnaire des requêtes AJAX qui se fera à travers l'application.
*   Ici nous présentons la manipulation de AJAX sur (02) façon différentes.
*/

/*
*   Cette fonction satisfait une requête AJAX en utilisant la librairie jquery.
*   Donc avant d'utiliser cette fonction, assurez-vous d'avoir d'abord
*   correctement importer cette bibliothèque javascript avant de l'utiliser.
*   La méthode prend les paramètres suivants:
*
*       -> lien_vers_un_script_php: Contient le chemin vers votre fichier (.php).
*       -> donnees_a_envoyees_a_php: Contient un objet représentant les données de votre formulaire.
*       -> success: Fonction appelé automatiquement lorsque php renvoyera les informations de la base de données.
*       -> echec: Fonction appelé automatiquement lorsqu'une erreur se produit au cours de la requête.
*/
function ajax_avec_jquery (lien_vers_un_script_php, donnees_a_envoyees_a_php, succes, echec) {
    // Utilisation de la méthode "POST" pour éffectuer n'importe quelle requête.
    $.post (lien_vers_un_script_php, donnees_a_envoyees_a_php, function (resultats_de_php, status_de_la_requete) {
        // Lorsque tout ce passe sans erreur, appele la méthode "succes ()".
        if (status_de_la_requete === "success") succes (JSON.parse (resultats_de_php), status_de_la_requete);
        // Dans le cas contraire, appele la méthode "echec ()".
        else echec (status_de_la_requete);
    });
}

/*
*   Cette fonction satisfait une requête AJAX en utilisant la classe XMLHttpRequest.
*   La méthode prend les paramètres suivants:
*
*       -> lien_vers_un_script_php: Contient le chemin vers votre fichier (.php).
*       -> donnees_a_envoyees_a_php: Contient un objet représentant les données de votre formulaire.
*       -> success: Fonction appelé automatiquement lorsque php renvoyera les informations de la base de données.
*       -> echec: Fonction appelé automatiquement lorsqu'une erreur se produit au cours de la requête.
*/
function ajax_avec_XMLHttpRequest (lien_vers_un_script_php, donnees_a_envoyees_a_php, succes, echec) {
    // Création d'une nouvelle instance de la classe XMLHttpRequest.
    let xhr = new XMLHttpRequest ();
    // Lorsque le serveur donnera un retour.
    xhr.onload = function () {
        // Si tout s'est passé au cours de la requête, alors appele la méthode "succes ()".
        if (xhr.status === 200) succes (JSON.parse (xhr.responseText), xhr.status);
        // Si jamais une erreur se produit au cours de la requête, alors appele la méthode "echec ()".
        else echec (xhr.status);
    }
    // Ouverture d'une connexion http avec la méthode POST.
    xhr.open ("POST", lien_vers_un_script_php, true);
    // Modification du type de donnée pour les communications AJAX.
    xhr.setRequestHeader ("content-type", "application/x-www-form-urlencoded");
    // Définissons les variables néccessaires pour l'envoie des données.
    let donnees = '', cles = Object.keys (donnees_a_envoyees_a_php);
    // Génération des données.
    for (let i = 0; i < cles.length; i++) donnees = `${donnees}${cles [i]}=${donnees_a_envoyees_a_php [cles [i]]}${(i < (cles.length - 1) ? '&' : '')}`;
    // Envoie de la requête de l'utilisateur vers le serveur.
    xhr.send (donnees);
}
