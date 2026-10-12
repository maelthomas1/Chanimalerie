<?php
session_save_path(__DIR__ . "/tmp");
session_start();
require "./info_bdd.php";

// Vérification des droits admin (très important ici !)
if (!isset($_SESSION['user']) || $_SESSION['roleUser'] != 'adm') {
    header("Location: index.php?page=connexion&erreur=Accès refusé");
    exit();
}

$noCommande = $_POST['noCommande'] ?? '';
$nouveauStatut = $_POST['nouveauStatut'] ?? '';

if ($noCommande != '' && $nouveauStatut != '') {
    // Mise à jour du statut dans la table commande[cite: 2]
    $sql = "UPDATE commande SET idStatut = :statut WHERE noCommande = :no";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'statut' => $nouveauStatut,
        'no' => $noCommande
    ]);

    header("Location: index.php?page=gestionCommandes&info=Statut mis à jour avec succès");
} else {
    header("Location: index.php?page=gestionCommandes&erreur=Données manquantes");
}
?>