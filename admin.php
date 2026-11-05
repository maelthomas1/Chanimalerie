<?php
if (isset($_SESSION['utilisateur'])) {              // TODO : vérifier si l'utilisateur est déjà connecté
    if ($_SESSION['utilisateur']['role'] === 'adm') {
        $connecte = true;
    } else {
        $connecte = false;
        header("location:index.php?page=connexion&erreur=Accès refusé. Vous devez être administrateur pour accéder à la partie administration");
        exit();
    }
} else {
    $connecte = false;
    header("location:index.php?page=connexion&erreur=Il faut être authentifié pour accéder à la partie administration");
    exit();
}
require "./info_bdd.php";


// Requête pour vérifier si le couple login/mdp est bon
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
                <h4>Bienvenue <?php echo $_SESSION['utilisateur']['prenom'] ?> - Rôle : <?php echo $_SESSION['roleUtilisateur'] ?>
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
                        <?php foreach ($liste_utilisateurs as $utilisateur): ?>
                            <tr>
                                <td><?php echo $utilisateur['login'] ?></td>
                                <td><?php echo $utilisateur['nom'] ?></td>
                                <td><?php echo $utilisateur['prenom'] ?></td>
                                <td>
                                    <span class="badge bg-secondary"><?php echo $utilisateur['role'] ?></span>
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