s3_bucket = getenv('S3_BUCKET'):
secret_key = getenv('SECRET_KEY'):

function hasher_mdp (string $mdp): string {
        <!-- PASSWORD_DEFAULT utilise l'algorithme bcrypt par défaut -->
    $mdphash = password_hash($mdp . getenv('SECRET_KEY'), PASSWORD_DEFAULT);
	return $mdphash;
}
