<?php
session_start();

// Récupération et nettoyage des saisies
$loginSaisi = trim($_POST['login'] ?? '');
$mdpSaisi = $_POST['mdp'] ?? '';
$mdpConfirmSaisi = $_POST['mdpConfirm'] ?? '';
$nomSaisi = trim($_POST['nom'] ?? '');
$prenomSaisi = trim($_POST['prenom'] ?? '');
$mailSaisi = trim($_POST['mail'] ?? '');
$telephoneSaisi = trim($_POST['telephone'] ?? '');

// Stockage des saisies dans la session pour pré-remplir le formulaire en cas d'erreur
$_SESSION['saisie'] = [
    'login'     => $loginSaisi,
    'nom'       => $nomSaisi,
    'prenom'    => $prenomSaisi,
    'mail'      => $mailSaisi,
    'telephone' => $telephoneSaisi,
];

// Vérifications de cohérence
if ($mdpSaisi !== $mdpConfirmSaisi) {
    header("location:index.php?page=inscriptionClient&&erreur=Les 2 mots de passe doivent être identiques");
    exit;
}

// Vérification de la complexité du mot de passe (au moins 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial et au moins 12 caractères)
if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{12,}$/', $mdpSaisi)) {
    header("location:index.php?page=inscriptionClient&&erreur=Le mot de passe doit contenir au moins 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial et au moins 12 caractères");
    exit;
}

// Vérification de la longueur des champs obligatoires
if (strlen($loginSaisi) < 1 || strlen($mdpSaisi) < 1 || strlen($nomSaisi) < 1 || strlen($prenomSaisi) < 1) {
    header("location:index.php?page=inscriptionClient&&erreur=Veuillez renseigner tous les champs obligatoires");
    exit;
}

// Vérification du format de l'adresse email
if (!filter_var($mailSaisi, FILTER_VALIDATE_EMAIL)) {
    header("location:index.php?page=inscriptionClient&&erreur=L'adresse email est invalide");
    exit;
}

// Vérification du format du numéro de téléphone
if (!empty($telephoneSaisi) && !preg_match('/^(?:0|\+33[\s.-]?)[1-9](?:[\s.-]?\d{2}){4}$/', $telephoneSaisi)) {
    header("location:index.php?page=inscriptionClient&&erreur=Le numéro de téléphone doit être au format français (ex: 06 12 34 56 78)");
    exit;
}

// Inclusion de la connexion BDD et du gestionnaire de secrets
require "./info_bdd.php";
require_once "./gestion_secret.php";

// Sécurisation des données sensibles (Hachage et Chiffrement)
$mdpHashe = hasher_mdp($mdpSaisi);

$cleChiffrement = getenv('cle_chiffrement');
$telChiffre = !empty($telephoneSaisi) ? chiffrer_donnee($telephoneSaisi, $cleChiffrement) : null;
$mailChiffre = !empty($mailSaisi) ? chiffrer_donnee($mailSaisi, $cleChiffrement) : null;
$prenomChiffre = !empty($prenomSaisi) ? chiffrer_donnee($prenomSaisi, $cleChiffrement) : null;
$nomChiffre = !empty($nomSaisi) ? chiffrer_donnee($nomSaisi, $cleChiffrement) : null;

// Insertion en base de données avec la requête préparée
$resultat = false;
try {
    $requeteInsertion = "INSERT INTO client (nom, prenom, pseudo, mdp, mail, telephone) 
                         VALUES (:nom, :prenom, :pseudo, :mdp, :mail, :telephone)";
    $statement = $pdo->prepare($requeteInsertion);
    $resultat = $statement->execute([
        ':nom'       => $nomChiffre,
        ':prenom'    => $prenomChiffre,
        ':pseudo'    => $loginSaisi,
        ':mdp'       => $mdpHashe,
        ':mail'      => $mailChiffre,
        ':telephone' => $telChiffre,
    ]);
} catch (PDOException $monException) {
    echo "Erreur SQL : " . $monException->getMessage();
    exit;
}

// Redirection et nettoyage de la session en cas de succès
if ($resultat) {
    unset($_SESSION['saisie']);
    header('location:index.php?page=connexionClient&&info=Inscription réussie. Veuillez vous authentifier');
    exit;
} else {
    header("location:index.php?page=inscriptionClient&&erreur=Un problème est survenu lors de l'inscription");
    exit;
}
?>