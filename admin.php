<?php
if (isset($_SESSION['user'])) {
    $connecte = true;
} else {
    $connecte = false;
    header("location:index.php?page=connexion&erreur=Il faut être authentifié pour accéder à la partie administration"); // TODO : afficher que après première connexion
    exit();
}
require "./info_bdd.php";
require_once "./gestion_secret.php";

$loginClair = dechiffrer_donnee($_SESSION['user']['login'], getenv('cle_chiffrement'));
$prenomClair = dechiffrer_donnee($_SESSION['user']['prenom'], getenv('cle_chiffrement'));
$nomClair = dechiffrer_donnee($_SESSION['user']['nom'], getenv('cle_chiffrement'));
$roleClair = dechiffrer_donnee($_SESSION['user']['role'], getenv('cle_chiffrement'));



$requeteSQL = "SELECT idUtilisateur, login, mdp, nom, prenom, role FROM utilisateur";

// Exécution de la requête
$reponse = $pdo->query($requeteSQL);
$liste_utilisateurs = $reponse->fetchall(PDO::FETCH_ASSOC);

?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">

            <h2 class="mb-4">Administration <i class="bi bi-person-fill-gear"></i></h2>

            <div class="alert alert-pink shadow-sm mb-5">
                <h4>Bienvenue <?= $prenomClair ?> - Rôle : <?= $roleClair ?>
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Login</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Rôle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($liste_utilisateurs as $user): ?>
                            <tr>
                                <td><?php echo $loginClair ?></td>
                                <td><?php echo $nomClair ?></td>
                                <td><?php echo $prenomClair ?></td>
                                <td>
                                    <span class="badge bg-secondary"><?php echo $roleClair ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="container my-5">
                <h2 class="mb-4">Tableau de bord administration</h2>
                <div class="row">
                    <div class="">
                        <a href="index.php?page=gestionCommandes" class="btn btn-pink btn-lg w-100 p-4 shadow">
                            <i class="bi bi-truck"></i><br>Gestion des commandes
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>