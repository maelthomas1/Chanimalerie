<?php
require "./info_bdd.php";

$sql = "SELECT c.idCommande, c.dateCommande, cl.nom, cl.prenom, s.libelleStatut, c.idStatut,
        GROUP_CONCAT(CONCAT(p.nomProduit, ' (x', co.quantite, ')') SEPARATOR '<br>') as detailProduits
        FROM commande c
        JOIN client cl ON c.idClient = cl.idClient
        JOIN statut s ON c.idStatut = s.idStatut
        JOIN contenir co ON c.idCommande = co.idCommande
        JOIN produit p ON co.idProduit = p.idProduit
        GROUP BY c.idCommande
        ORDER BY c.dateCommande DESC";

$commandes = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$lesStatuts = $pdo->query("SELECT * FROM statut")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container my-5">
    <h1 class="mb-4">Gestion des commandes</h1>
    
    <table class="table table-striped shadow-sm">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Client</th>
            <th>Contenu de la commande</th>
            <th>Statut actuel</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($commandes as $cmd) : ?>
            <tr>
                <td><?php echo $cmd['idCommande']; ?></td>
                <td><?php echo $cmd['dateCommande']; ?></td>
                <td><?php echo htmlspecialchars($cmd['nom'] . " " . $cmd['prenom']); ?></td>
                
                <!-- Affichage du détail des produits -->
                <td class="small">
                    <?php echo $cmd['detailProduits']; ?>
                </td>

                <td>
                    <span class="badge bg-info"><?php echo $cmd['libelleStatut']; ?></span>
                </td>
                <td>
                    <form action="modifierStatut_exe.php" method="POST" class="d-flex gap-2">
                        <input type="hidden" name="idCommande" value="<?php echo $cmd['idCommande']; ?>">
                        <select name="nouveauStatut" class="form-select form-select-sm">
                            <?php foreach ($lesStatuts as $statut) : ?>
                                <option value="<?php echo $statut['idStatut']; ?>" 
                                    <?php echo ($statut['idStatut'] == $cmd['idStatut']) ? 'selected' : ''; ?>>
                                    <?php echo $statut['libelleStatut']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-pink btn-sm">OK</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>