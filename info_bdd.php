<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'chanimalerie';
// BDD proxmox
// $dbname = 'chanimalerie';

// Connexion maison/lycée
$username = 'root';
$password = '';

// Connexion Proxmox
// $username = 'adminer';
// $password = 'Poireau1';

// Création d'une connexion PDO
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password); 