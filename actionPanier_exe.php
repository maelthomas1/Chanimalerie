<?php
session_start();

require "./info_bdd.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=connexionClient&erreur=Veuillez vous connecter pour ajouter au panier");
    exit();
}

$idProduit = $_POST['idProduit'] ?? '';
$quantite = $_POST['quantite'] ?? '';
$idClient = $_SESSION['user']['idClient'];

if ($idProduit != '' && $quantite > 0) {
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

        $sqlAdd = "INSERT INTO contenir (noCommande, idProduit, quantite) 
                   VALUES (:noC, :idP, :qte)
                   ON DUPLICATE KEY UPDATE quantite = quantite + :qte";
        $pdo->prepare($sqlAdd)->execute(['noC' => $noCommande, 'idP' => $idProduit, 'qte' => $quantite]);

        header("Location: index.php?page=produits&info=Produit ajouté au panier !");
    } catch (Exception $e) {
        header("Location: index.php?page=detailProduit&idProduit=$idProduit&erreur=Erreur lors de l'ajout");
    }
} else {
    header("Location: index.php?page=produits&erreur=Données invalides");
}
?>