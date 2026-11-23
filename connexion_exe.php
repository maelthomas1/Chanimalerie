<?php
session_start();

$login = $_POST["login"] ?? '';
$mdp = $_POST["mdp"] ?? '';

require "./info_bdd.php";
require_once "./gestion_secret.php";

try {
    // Utilisation d'une requête préparée pour récupérer l'utilisateur par son login
    $statement = $pdo->prepare("SELECT login, mdp, nom, prenom, role FROM utilisateur WHERE login = :login");
    $statement->execute([
        'login' => $login
    ]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Vérification si l'utilisateur existe ET si le mot de passe correspond au hash stocké
    if ($user && verifier_mdp($mdp, $user['mdp'])) {
        // Connexion OK
        $_SESSION['user'] = $user;
        $_SESSION['roleUser'] = $user['role'];

        header('location:index.php?page=admin');
        exit();
    } else {
        // Connexion KO
        header("location:index.php?page=connexion&erreur=Problème de connexion (identifiant ou mot de passe incorrect)");
        exit();
    }
} catch (PDOException $monException) {
    echo "Erreur SQL : " . $monException->getMessage();
}
