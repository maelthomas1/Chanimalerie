<?php

$tmpPath = __DIR__ . "/tmp";
if (is_dir($tmpPath)) {
    session_save_path($tmpPath);
}
session_start();

// 1. Récupération sécurisée des saisies
$loginSaisi = htmlspecialchars($_POST['login'] ?? '');
$mdpSaisi = htmlspecialchars($_POST['mdp'] ?? '');
$mdpConfirmSaisi = htmlspecialchars($_POST['mdpConfirm'] ?? '');
$nomSaisi = htmlspecialchars($_POST['nom'] ?? '');
$prenomSaisi = htmlspecialchars($_POST['prenom'] ?? '');
$mailSaisi = htmlspecialchars($_POST['mail'] ?? '');
$telephoneSaisi = htmlspecialchars($_POST['telephone'] ?? '');

// 2. Vérifications
if ($mdpSaisi !== $mdpConfirmSaisi) {
    header("location:index.php?page=inscriptionClient&&erreur=Les 2 mots de passe doivent être identiques");
    exit;
}

if (strlen($loginSaisi) < 1 || strlen($mdpSaisi) < 1 || strlen($nomSaisi) < 1 || strlen($prenomSaisi) < 1) {
    header("location:index.php?page=inscriptionClient&&erreur=Veuillez renseigner tous les champs obligatoires");
    exit;
}

require "./info_bdd.php";

// 3. Insertion en base de données avec une requête préparée
$resultat = false;
try {
    $requeteInsertion = "INSERT INTO client (nom, prenom, pseudo, mdp, mail, telephone) 
                         VALUES (:nom, :prenom, :pseudo, :mdp, :mail, :telephone)";
    $statement = $pdo->prepare($requeteInsertion);
    $resultat = $statement->execute([
        ':nom' => $nomSaisi,
        ':prenom' => $prenomSaisi,
        ':pseudo' => $loginSaisi,
        ':mdp' => $mdpSaisi,
        ':mail' => $mailSaisi,
        ':telephone' => $telephoneSaisi
    ]);
} catch (PDOException $monException) {
    echo "Erreur SQL : " . $monException->getMessage();
    exit;
}

// 4. Redirection
if ($resultat) {
    header('location:index.php?page=connexionClient&&info=Inscription réussie. Veuillez vous authentifier');
} else {
    header("location:index.php?page=inscriptionClient&&erreur=Un problème est survenu lors de l'inscription");
}
?>