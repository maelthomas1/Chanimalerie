<?php
session_start();
require "./info_bdd.php";

// Vérification des droits admin (très important ici !)
if (!isset($_SESSION['utilisateur']) || $_SESSION['roleUtilisateur'] != 'adm') {
    header("Location: index.php?page=connexion&erreur=Accès refusé");
    exit();
}

$idCommande = $_POST['idCommande'] ?? '';
$nouveauStatut = $_POST['nouveauStatut'] ?? '';

if ($idCommande != '' && $nouveauStatut != '') {
    // Mise à jour du statut dans la table commande[cite: 2]
    $sql = "UPDATE commande SET idStatut = :statut WHERE idCommande = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'statut' => $nouveauStatut,
        'id' => $idCommande
    ]);

    header("Location: index.php?page=gestionCommandes&info=Statut mis à jour avec succès");
} else {
    header("Location: index.php?page=gestionCommandes&erreur=Données manquantes");
}
?>