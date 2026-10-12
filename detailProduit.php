<?php
require "./info_bdd.php"; 

if (isset($_GET['numProduit'])) {
    $numProduit = $_GET['numProduit'];

    $requete = $pdo->prepare("SELECT * FROM produit WHERE numProduit = :num");
    $requete->execute(['num' => $numProduit]);
    $leProduit = $requete->fetch(PDO::FETCH_ASSOC);

    if (!$leProduit) {
        header("Location: index.php?page=produits&erreur=Produit introuvable");
        exit();
    }
} else {
    header("Location: index.php?page=produits");
    exit();
}
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="./Images/<?php echo $leProduit['nomImage']; ?>" class="img-fluid rounded shadow" alt="Image produit">
        </div>

        <div class="col-md-6">
            <h1 class="display-5 fw-bold"><?php echo $leProduit['nomProduit']; ?></h1>
            <p class="lead my-4"><?php echo $leProduit['descriptif']; ?></p>
            <h3 class="text-pink mb-4"><?php echo $leProduit['prixUnitaire']; ?> €</h3>
            
            <form action="actionPanier_exe.php" method="POST" class="mt-4 p-4 border rounded bg-light">
                <input type="hidden" name="numProduit" value="<?php echo $leProduit['numProduit']; ?>">
                
                <div class="mb-3">
                    <label for="quantite" class="form-label fw-bold">Quantité souhaitée :</label>
                    <input type="number" name="quantite" id="quantite" class="form-control w-25" value="1" min="1" max="<?php echo $leProduit['stock']; ?>">
                    <small class="text-muted">Stock disponible : <?php echo $leProduit['stock']; ?></small>
                </div>

                <button type="submit" class="btn btn-pink btn-lg w-100 shadow-sm">
                    <i class="bi bi-cart-plus-fill"></i> Ajouter au panier
                </button>
            </form>
        </div>
    </div>
</div>