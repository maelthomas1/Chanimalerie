<?php
session_start();

// 1. Récupération et nettoyage de base des saisies
$loginSaisi = htmlspecialchars($_POST['login'] ?? '');
$mdpSaisi = htmlspecialchars($_POST['mdp'] ?? '');
$mdpConfirmSaisi = htmlspecialchars($_POST['mdpConfirm'] ?? '');
$nomSaisi = htmlspecialchars($_POST['nom'] ?? '');
$prenomSaisi = htmlspecialchars($_POST['prenom'] ?? '');
$mailSaisi = htmlspecialchars($_POST['mail'] ?? '');
$telephoneSaisi = htmlspecialchars($_POST['telephone'] ?? '');

// 2. Vérifications de cohérence
if ($mdpSaisi !== $mdpConfirmSaisi) {
    header("location:index.php?page=inscriptionClient&&erreur=Les 2 mots de passe doivent être identiques");
    exit;
}

if (strlen($loginSaisi) < 1 || strlen($mdpSaisi) < 1 || strlen($nomSaisi) < 1 || strlen($prenomSaisi) < 1) {
    header("location:index.php?page=inscriptionClient&&erreur=Veuillez renseigner tous les champs obligatoires");
    exit;
}

// Inclusion de la connexion BDD et du gestionnaire de secrets
require "./info_bdd.php";
require_once "./gestion_secret.php";

// 3. Sécurisation des données sensibles (Hachage et Chiffrement)
$mdpHashe = hasher_mdp($mdpSaisi);

// 4. Chiffrement des données personnelles (ex: téléphone ou mail) si souhaité
$cleChiffrement = getenv('cle_chiffrement');
$telChiffre = !empty($telephoneSaisi) ? chiffrer_donnee($telephoneSaisi, $cleChiffrement) : null;

// 5. Insertion en base de données avec la requête préparée
$resultat = false;
try {
    $requeteInsertion = "INSERT INTO client (nom, prenom, pseudo, mdp, mail, telephone) 
                         VALUES (:nom, :prenom, :pseudo, :mdp, :mail, :telephone)";
    $statement = $pdo->prepare($requeteInsertion);
    $resultat = $statement->execute([
        ':nom' => $nomSaisi,
        ':prenom' => $prenomSaisi,
        ':pseudo' => $loginSaisi,
        ':mdp' => $mdpHashe,
        ':mail' => $mailSaisi,
        ':telephone' => $telChiffre,
    ]);
} catch (PDOException $monException) {
    echo "Erreur SQL : " . $monException->getMessage();
    exit;
}

// 5. Redirection
if ($resultat) {
    header('location:index.php?page=connexionClient&&info=Inscription réussie. Veuillez vous authentifier');
} else {
    header("location:index.php?page=inscriptionClient&&erreur=Un problème est survenu lors de l'inscription");
}
?>