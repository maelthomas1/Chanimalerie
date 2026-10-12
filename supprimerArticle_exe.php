<?php

$tmpPath = __DIR__ . "/tmp";
if (is_dir($tmpPath)) {
    session_save_path($tmpPath);
}
session_start();

require "./info_bdd.php";

$idClient = $_SESSION['user']['idClient'];
$numProduit = $_GET['numProduit'] ?? '';

if ($numProduit != '') {
    // 1. Récupérer le numéro du panier en cours
    $requetePanier = "SELECT noCommande FROM commande WHERE idClient = :idC AND idStatut = 'PAN'";
    $stmt = $pdo->prepare($requetePanier);
    $stmt->execute(['idC' => $idClient]);
    $panier = $stmt->fetch();

    if ($panier) {
        // 2. Supprimer la ligne dans la table 'contenir'[cite: 2]
        $requeteSupp = "DELETE FROM contenir WHERE noCommande = :noC AND numProduit = :numP";
        $pdo->prepare($requeteSupp)->execute([
            'noC' => $panier['noCommande'],
            'numP' => $numProduit
        ]);
    }
}

header("Location: index.php?page=panier&info=Article supprimé");