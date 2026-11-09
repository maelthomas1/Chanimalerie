<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$cle_hash = getenv('cle_hash');
$cle_chiffrement = getenv('cle_chiffrement');

/**
 * Hash le mot de passe en utilisant l'algorithme par défaut
 * @param string $mdp
 * @return string
 */
function hasher_mdp (string $mdp): string {
    return password_hash($mdp, PASSWORD_DEFAULT);
}

/**
 * Vérifie si le mot de passe correspond au hash
 * @param string $mdp
 * @param string $hash
 * @return bool
 */
function verifier_mdp(string $mdp, string $hash): bool {
    return password_verify($mdp, $hash);
} 

/**
 * Chiffre une donnée en utilisant la clé de chiffrement
 * @param string $donnee
 * @param string $cle_chiffrement
 * @return string
 */
function chiffrer_donnee (string $donnee, string $cle_chiffrement): string {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $donnee_chiffree = openssl_encrypt($donnee, 'aes-256-cbc', $cle_chiffrement, 0, $iv);
    return base64_encode($iv . $donnee_chiffree);
}

/**
 * Déchiffre une donnée en utilisant la clé de chiffrement
 * @param string $donnee_chiffree
 * @param string $cle_chiffrement
 * @return string
 */
function dechiffrer_donnee (string $donnee_chiffree, string $cle_chiffrement): string {
    $donnee_decodee = base64_decode($donnee_chiffree);
    $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($donnee_decodee, 0, $iv_length);
    return openssl_decrypt(substr($donnee_decodee, $iv_length), 'aes-256-cbc', $cle_chiffrement, 0, $iv);
}
?>