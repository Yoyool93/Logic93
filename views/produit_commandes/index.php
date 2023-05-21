<?php
$prixTotal = 0;
?>

<main class="content">
    <h1 class="display-1 h1 text-center">Checkout</h1>
    <hr class="mb-5">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Quantité</th>
                <th scope="col">Prix</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($produit_commande as $produit): ?>
                <tr>
                    <th scope="row"><a href="<?= BASE_DIR ?>/produits/details/<?= $produit['slug_produit'] ?>" style="text-decoration: none; color: #00002d"><?= $produit['slug_produit'] ?></a></th>
                    <td><p><?= $produit["quantite"] ?></p></td>
                    <td><p class="fw-bolder"><?= $produit['prix'] * $produit["quantite"] ?>,00€</p></td>
                </tr>
                <?php $prixTotal += $produit['prix'] * $produit["quantite"] ?>
            <?php endforeach ?>
            </tbody>
        </table>

        <div class="d-flex">
            <div class="prix ms-auto">
                <h4 class="h4 text-right" style="text-align: right"><?= $prixTotal ?>€ (HT)</h4>
                <h4 class="h4 text-right"><?= $prixTotal * 1.2 ?> € (TTC)</h4>
            </div>
        </div>
   
</main>