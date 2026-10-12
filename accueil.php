<?php
require "./info_bdd.php";

// Récupérer 3 produits aléatoires pour la section "Coup de coeur"
// On utilise ORDER BY RAND() pour que l'accueil change à chaque visite
$requeteTop = "SELECT numProduit, nomProduit, prixUnitaire, nomImage FROM produit ORDER BY RAND() LIMIT 3";
$reponseTop = $pdo->query($requeteTop);
$coupsDeCoeur = $reponseTop->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Section Hero -->
<div class="text-center p-5 mb-4 bg-light rounded-3 shadow-sm border-start border-pink border-5">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold text-pink">
            Bienvenue chez Chanimalerie <?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['prenom']) : ''; ?> !
        </h1>
        <!-- Ajout de mx-auto pour centrer le bloc de 8 colonnes -->
        <p class="col-md-8 fs-4 text-muted mx-auto">
            Le paradis des chats et de leurs humains. Découvrez nos accessoires, 
            mobiliers et gourmandises sélectionnés avec amour.
        </p>
        <a href="index.php?page=produits" class="btn btn-pink btn-lg shadow mt-3">
            <i class="bi bi-shop"></i> Voir la boutique
        </a>
    </div>
</div>

<!-- Section Coups de Coeur -->
<div class="container my-5">
    <h2 class="text-center mb-4 fw-bold"><i class="bi bi-heart-fill text-pink"></i> Nos coups de coeur du moment <i
            class="bi bi-heart-fill text-pink"></i></h2>

    <div class="row g-4">
        <?php foreach ($coupsDeCoeur as $unProduit): ?>
            <div class="col-md-4 col-sm-6">
                <a href="index.php?page=detailProduit&numProduit=<?php echo $unProduit['numProduit']; ?>"
                    style="text-decoration: none">
                    <div class="card h-100 shadow-sm">
                        <img src="./Images/<?php echo $unProduit['nomImage']; ?>" class="card-img-top"
                            style="height: 300px; object-fit: cover;" alt="<?php echo $unProduit['nomProduit']; ?>">

                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title text-dark"><?php echo $unProduit['nomProduit']; ?></h5>
                            <p class="card-text text-muted"><?php echo $unProduit['prixUnitaire']; ?>€</p>

                            <div class="btn btn-pink w-100 mt-auto">
                                <i class="bi bi-eye-fill"></i> Voir le détail
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>