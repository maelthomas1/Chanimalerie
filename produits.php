<?php
require "./info_bdd.php";

if (isset($_GET["erreur"])) {
    ?>
    <div class="mt-2 p-3 w-75 mx-auto alert alert-danger" role="alert">
        <?php echo htmlspecialchars($_GET["erreur"]); ?>
    </div>
    <?php
}
if (isset($_GET["info"])) {
    ?>
    <div class="mt-2 p-3 w-75 mx-auto alert alert-pink" role="alert">
        <h4 class="text-center"><?php echo htmlspecialchars($_GET["info"]); ?></h4>
    </div>
    <?php
}

$requete = "SELECT numProduit, nomProduit, prixUnitaire, nomImage FROM produit";
$reponse = $pdo->query($requete);
$lesProduits = $reponse->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container my-5">
    <div class="bg-pink bg-gradient text-white text-center rounded-3 p-5 mb-5 shadow">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi bi-bag-heart-fill"></i> Nos produits <i class="bi bi-bag-heart-fill"></i>
        </h1>
    </div>

    <div class="row g-4">
        <?php foreach ($lesProduits as $unProduit): ?>
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