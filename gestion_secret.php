s3_bucket = getenv('S3_BUCKET'):
secret_key = getenv('SECRET_KEY'):


/**
 * Hash le mot de passe en utilisant le secret key
 * @param string $mdp
 * @return string
 */
function hasher_mdp (string $mdp): string {
        <!-- PASSWORD_DEFAULT utilise l'algorithme bcrypt par défaut -->
    $mdphash = password_hash($mdp . getenv('SECRET_KEY'), PASSWORD_DEFAULT);
	return $mdphash;
}

/**
 * Vérifie si le mot de passe correspond au hash
 * @param string $mdp
 * @param string $hash
 * @return bool
 */
function verifier_mdp(string $mdp, string $hash): bool {
    return password_verify($mdp . getenv('SECRET_KEY'), $hash);
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
    $donnee_chiffree = base64_decode($donnee_chiffree);
    $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($donnee_chiffree, 0, $iv_length);
	return openssl_decrypt(substr($donnee_chiffree, $iv_length), 'aes-256-cbc', $cle_chiffrement, 0, $iv);
}