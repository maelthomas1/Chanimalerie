<?php
session_start();

$login = $_POST["login"] ?? '';
$mdp = $_POST["mdp"] ?? '';

require "./info_bdd.php";
require_once "./gestion_secret.php";

try {
    // On récupère le client et son mot de passe haché grâce à son pseudo
    $statement = $pdo->prepare(
        "SELECT idClient, nom, prenom, pseudo, mdp FROM client
         WHERE pseudo = :loginRequete"
    );
    $statement->execute([
        'loginRequete' => $login
    ]);
    $client = $statement->fetch(PDO::FETCH_ASSOC);

    // Vérification si le client existe ET si le mot de passe correspond au hash
    if ($client && verifier_mdp($mdp, $client['mdp'])) {
        // Connexion OK
        $_SESSION['user'] = $client;
        $_SESSION['prenom'] = $client['prenom'];

        header('location:index.php?page=produits');
        exit();
    } else {
        // Connexion KO
        header("location:index.php?page=connexionClient&&erreur=Problème de connexion (identifiant ou mot de passe incorrect)");
        exit();
    }
} catch (PDOException $monException) {
    echo "Erreur SQL : " . $monException->getMessage();
}
