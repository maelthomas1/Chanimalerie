<?php

$tmpPath = __DIR__ . "/tmp";
if (is_dir($tmpPath)) {
    session_save_path($tmpPath);
}
session_start();

if (isset($_SESSION['user'])) {
    $connecte = true;
} else {
    $connecte = false;
}
?>


<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./Images/chanimalerieLogo1.png">
    <title>Chanimalerie</title>
    <!-- <link rel="stylesheet" href="mesStyles.css" type="text/css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="mesStyles.css">
</head>


<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-pink" href="index.php">
                <img src="./Images/chanimalerieLogo1.png" alt="Logo Chanimalerie" class="logo-nav">
                <span>Chanimalerie</span>
            </a>
            <button class="navbar-toggler">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?page=accueil">
                            <i class="bi bi-house-door-fill"></i> Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=produits">
                            <i class="bi bi-grid-fill"></i> Produits
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=admin">
                            <i class="bi bi-box-arrow-in-left"></i> Administration
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=apropos">
                            <i class="bi bi-info-circle"></i> MaNi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=panier">
                            <i class="bi bi-cart"></i> Panier
                        </a>
                    </li>
                </ul>
                <div class="d-flex ms-auto align-items-center">
                    <?php if ($connecte) { ?>
                        <span class="text-muted me-3"><?php echo $_SESSION['user']['prenom']; ?></span>

                        <form action="deconnexion.php" method="post" class="m-0">
                            <button type="submit" class="btn text-pink p-0">
                                <h4 class="m-0">
                                    <i class="bi bi-box-arrow-right"></i>&nbsp;Déconnexion
                                </h4>
                            </button>
                        </form>
                    <?php } else { ?>
                        <a href="index.php?page=connexionClient" class="text-decoration-none">
                            <button type="button" class="btn text-pink p-0">
                                <h4 class="m-0">
                                    <i class="bi bi-person-circle"></i>&nbsp;Connexion
                                </h4>
                            </button>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>