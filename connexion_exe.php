<?php

$tmpPath = __DIR__ . "/tmp";
if (is_dir($tmpPath)) {
    session_save_path($tmpPath);
}
session_start();

$login = $_POST["login"] ?? '';
$mdp = $_POST["mdp"] ?? '';

require "./info_bdd.php";

// Requête pour vérifier si le couple login/mdp est bon
$requeteSQL = "SELECT login, mdp, nom, prenom, role FROM users WHERE login = '$login'
AND mdp = '$mdp';";

// echo $requeteSQL; // test de la requête
$reponse = $pdo->query($requeteSQL);
$user = $reponse->fetch(PDO::FETCH_ASSOC);

if ($user == false) {
    // Connexion KO
    header("location:index.php?page=connexion&&erreur=Problème de connexion");
} else {
    // Connexion OK
    $_SESSION['user'] = $user;
    $_SESSION['roleUser'] = $user['role'];
    header('location:index.php?page=admin');
}
?>