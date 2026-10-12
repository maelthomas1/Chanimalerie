<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'chanimalerie';
// BDD proxmox
// $dbname = 'chanimalerie';

// Connexion maison
$username = 'root';
$password = '';

// // Connexion lycée
// $username = 'myroot';
// $password = 'root123*';

// Connexion Proxmox
// $username = 'adminer';
// $password = 'belbeoch11@';

// Création d'une connexion PDO
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password); 