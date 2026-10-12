<?php

$tmpPath = __DIR__ . "/tmp";
if (is_dir($tmpPath)) {
    session_save_path($tmpPath);
}
session_start();
// On vide les variables de session
unset($_SESSION['user']);
unset($_SESSION['roleUser']);

// On détruit la session sur le serveur
session_destroy();

// Redirection vers la page de connexion avec un petit message d'info
header("location:index.php?page=connexion&info=Déconnexion réussie");
exit(); // On arrête l'exécution du script après la redirection
?>