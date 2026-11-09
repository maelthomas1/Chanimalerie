<?php
// Chargement du .env si ce n'est pas déjà fait globalement
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Récupération des paramètres de connexion depuis les variables d'environnement
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');

// Création d'une connexion PDO
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password); 
?>