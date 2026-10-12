<?php

$tmpPath = __DIR__ . "/tmp";
if (is_dir($tmpPath)) {
    session_save_path($tmpPath);
}
session_start();

require "./info_bdd.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=connexionClient&erreur=Veuillez vous connecter pour ajouter au panier");
    exit();
}

$numProduit = $_POST['numProduit'] ?? '';
$quantite = $_POST['quantite'] ?? '';
$idClient = $_SESSION['user']['idClient'];

if ($numProduit != '' && $quantite > 0) {
    try {
        $requete = "SELECT noCommande FROM commande WHERE idClient = :idC AND idStatut = 'PAN'";
        $stmt = $pdo->prepare($requete);
        $stmt->execute(['idC' => $idClient]);
        $panier = $stmt->fetch();

        if ($panier) {
            $noCommande = $panier['noCommande'];
        } else {
            $sqlCreate = "INSERT INTO commande (idClient, idStatut, dateCommande) VALUES (:idC, 'PAN', CURDATE())";
            $pdo->prepare($sqlCreate)->execute(['idC' => $idClient]);
            $noCommande = $pdo->lastInsertId();
        }

        $sqlAdd = "INSERT INTO contenir (noCommande, numProduit, quantite) 
                   VALUES (:noC, :numP, :qte)
                   ON DUPLICATE KEY UPDATE quantite = quantite + :qte";
        $pdo->prepare($sqlAdd)->execute(['noC' => $noCommande, 'numP' => $numProduit, 'qte' => $quantite]);

        header("Location: index.php?page=produits&info=Produit ajouté au panier !");
    } catch (Exception $e) {
        header("Location: index.php?page=detailProduit&numProduit=$numProduit&erreur=Erreur lors de l'ajout");
    }
} else {
    header("Location: index.php?page=produits&erreur=Données invalides");
}
?>