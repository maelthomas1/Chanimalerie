<?php
session_save_path(__DIR__ . "/tmp");
session_start();
require "./info_bdd.php";

// 1. Vérification de la connexion
if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=connexionClient&erreur=Veuillez vous connecter");
    exit();
}

$idClient = $_SESSION['user']['idClient'];

try {
    // 2. On cherche le panier en cours ('PAN') pour ce client[cite: 2]
    $sqlSearch = "SELECT noCommande FROM commande WHERE idClient = :idC AND idStatut = 'PAN'";
    $stmt = $pdo->prepare($sqlSearch);
    $stmt->execute(['idC' => $idClient]);
    $panier = $stmt->fetch();

    if ($panier) {
        // 3. Mise à jour du statut de 'PAN' vers 'VAL' (Validée)
        $sqlUpdate = "UPDATE commande SET idStatut = 'VAL', dateCommande = CURDATE() 
                      WHERE noCommande = :noC";
        $pdo->prepare($sqlUpdate)->execute(['noC' => $panier['noCommande']]);

        // 4. Redirection avec message de succès vers l'accueil ou les produits
        header("Location: index.php?page=produits&info=Félicitations ! Votre commande est validée.");
    } else {
        header("Location: index.php?page=panier&erreur=Votre panier est vide.");
    }
} catch (Exception $e) {
    header("Location: index.php?page=panier&erreur=Erreur lors de la validation.");
}
?>