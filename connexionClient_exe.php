<?php

$tmpPath = __DIR__ . "/tmp";
if (is_dir($tmpPath)) {
    session_save_path($tmpPath);
}
session_start();

$login = $_POST["login"] ?? '';
$mdp = $_POST["mdp"] ?? '';

require "./info_bdd.php";

try {
    $statement = $pdo->prepare(
    "SELECT idClient, nom, prenom, pseudo FROM client
    WHERE pseudo = :loginRequete
    AND mdp = :mdpRequete"
    );
    $statement->execute([
        'loginRequete' => $login,
        'mdpRequete' => $mdp
    ]);
} catch (PDOException $monException) {
    echo "Erreur SQL : " . $monException->getMessage();
}

$client = $statement->fetch(PDO::FETCH_ASSOC);

if ($client == false) {
    // Connexion KO
    header("location:index.php?page=connexionClient&&erreur=Problème de connexion");
} else {
    // Connexion OK
    $_SESSION['user'] = $client;
    $_SESSION['prenom'] = $client['prenom'];

    header('location:index.php?page=produits');
}
?>