<?php
require "./info_bdd.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=connexionClient&erreur=Connectez-vous pour voir votre panier");
    exit();
}

$idClient = $_SESSION['user']['idClient'];

$requete = "SELECT p.numProduit, p.nomProduit, p.prixUnitaire, c.quantite 
        FROM contenir c
        JOIN produit p ON c.numProduit = p.numProduit
        JOIN commande cmd ON c.noCommande = cmd.noCommande
        WHERE cmd.idClient = :idC AND cmd.idStatut = 'PAN'";

$stmt = $pdo->prepare($requete);
$stmt->execute(['idC' => $idClient]);
$lignesPanier = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalGeneral = 0;
?>

<div class="container my-5">
    <div class="bg-pink text-white text-center rounded-3 p-3 mb-5 shadow">
        <h1 class="display-5 fw-bold">Mon panier</h1>
    </div>

    <table class="table table-hover shadow-sm rounded">
        <thead class="table-dark">
            <tr>
                <th>Article</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lignesPanier as $ligne):
                $totalLigne = $ligne['prixUnitaire'] * $ligne['quantite'];
                $totalGeneral += $totalLigne;
                ?>
                <tr>
                    <td><?php echo $ligne['nomProduit']; ?></td>
                    <td><?php echo number_format($ligne['prixUnitaire'], 2); ?> €</td>
                    <td><?php echo $ligne['quantite']; ?></td>
                    <td><?php echo number_format($totalLigne, 2); ?> €</td>
                    <td>
                        <a href="supprimerArticle_exe.php?numProduit=<?php echo $ligne['numProduit']; ?>"
                            class="text-danger" onclick="return confirm('Supprimer cet article ?')">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <h3>Montant total : <?php echo number_format($totalGeneral, 2); ?> €</h3>
        <a href="validerPanier_exe.php" class="btn btn-pink btn-lg mt-3">
            <i class="bi bi-basket-fill"></i> Valider mon panier
        </a>
    </div>
</div>