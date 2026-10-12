<?php

// 1. Whitelist des pages autorisées
$pages_autorisees = ['accueil', 'produits', 'connexion', 'connexionClient', 'inscriptionClient', 'admin', 'deconnexion', 'apropos', 'mentionsLegales', 'detailProduit', 'panier', 'gestionCommandes'];

// 2. Redirection vers l'accueil si aucune page n'est spécifiée
$page = $_GET["page"] ?? 'accueil';

// 3. Vérification que la page demandée est bien dans la whitelist, sinon redirection vers l'accueil
if (!in_array($page, $pages_autorisees)) {
    $page = 'accueil';
}

// 4. Vérification que le fichier correspondant existe, sinon redirection vers l'accueil
if (!file_exists($page . ".php")) {
    $page = 'accueil';
}

include("header.php");

include($page . ".php");

include("footer.php");
?>