<?php
session_start();

require "./info_bdd.php";

$idClient = $_SESSION['utilisateur']['idClient'];
$idProduit = $_GET['idProduit'] ?? '';

if ($idProduit != '') {
    // 1. Récupérer le numéro du panier en cours
    $requetePanier = "SELECT idCommande FROM commande WHERE idClient = :idC AND idStatut = 'PAN'";
    $stmt = $pdo->prepare($requetePanier);
    $stmt->execute(['idC' => $idClient]);
    $panier = $stmt->fetch();

    if ($panier) {
        // 2. Supprimer la ligne dans la table 'contenir'[cite: 2]
        $requeteSupp = "DELETE FROM contenir WHERE idCommande = :idC AND idProduit = :idP";
        $pdo->prepare($requeteSupp)->execute([
            'idC' => $panier['idCommande'],
            'idP' => $idProduit
        ]);
    }
}

header("Location: index.php?page=panier&info=Article supprimé");