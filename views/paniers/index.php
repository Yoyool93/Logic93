<?php
$prixTotal = 0;

//var_dump($_SESSION["cart"]);
?>

<main class="content">
    <h1 class="display-1 h1 text-center">Panier</h1>
    <hr class="mb-5">
    <?php if (isset($panier)): ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Nom</th>
            <th scope="col">Quantité</th>
            <th scope="col">Prix</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            <? //php // var_dump($panier) ; ?>
        <?php foreach($panier as $produit): ?>
            <?php $quantite = empty($_SESSION['user']) ? $_SESSION['cart'][$produit['slug_produit']]["quantite"] : $produit["quantite"] ?>

            <tr>
                <th scope="row"><a href="<?= BASE_DIR ?>/produits/details/<?= $produit['slug_produit'] ?>" style="text-decoration: none; color: #00002d"><img src="<?= $produit['image'] ?>" style="height:150px" alt="<?= $produit['nom_produit'] ?>"></a></th>
                <th scope="row"><a href="<?= BASE_DIR ?>/produits/details/<?= $produit['slug_produit'] ?>" style="text-decoration: none; color: #00002d"><?= $produit['nom_produit'] ?></a></th>

                <td><p><?= $quantite ?></p></td>
                <td>
                    <p><?= $produit['prix'] ?>,00€ x <?= $quantite ?></p>
                    <br>
                    <p class="fw-bolder"><?= $produit['prix'] * $quantite ?>,00€</p>

                </td>
                <td>
                    <button id="<?= $produit['slug_produit'] ?>" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#idConfirmDelete<?= $produit['slug_produit'] ?>"><i class="fa-solid fa-trash"></i></button>

                    <button id="up-<?= $produit['slug_produit'] ?>"
                    onclick="location.href='<?= BASE_DIR ?>/paniers/UpToCart/<?= $produit['slug_produit'] ?>'"
                    type="button" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></button>

                    <button id="down-<?= $produit['slug_produit'] ?>" onclick="location.href='<?= BASE_DIR ?>/paniers/RemoveFromCart/<?= $produit['slug_produit'] ?>'" 
                    type="button" class="btn btn-warning"><i class="fa-solid fa-cart-arrow-down"></i></button>
                </td>
            </tr>
            <?php $prixTotal +=  $produit['prix'] * $quantite ?>
            <!-- Confirmation -->
            <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="idConfirmDelete<?= $produit['slug_produit'] ?>" tabindex="-1" aria-labelledby="confirmDelete" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="confirmDelete">Confirmer la suppression ?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <img class="img-fluid" src="<?= $produit['image'] ?>" alt="image produit <?= $produit['nom_produit'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <h2 class="h2"><?= $produit['nom_produit'] ?></h2>
                                    <h5>Quantité : <?= $quantite ?></h5>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="button" class="btn btn-danger" onclick="location.href='<?= BASE_DIR ?>/paniers/delete/<?= $produit['slug_produit'] ?>'">Confirmer <i class="fa-regular fa-trash-can"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
        </tbody>
    </table>

    <div class="d-flex">
        <button onclick="location.href='<?= BASE_DIR ?>/produit_commandes'" type="button" class="btn btn-primary" style="max-height: 45px">Confirmer le panier</button>
        
        <div class="prix ms-auto">
            <h4 class="h4 text-right" style="text-align: right"><?= $prixTotal ?> € (HT)</h4>
            <h4 class="h4 text-right"><?= $prixTotal * 1.2 ?> € (TTC)</h4>
        </div>
    </div>
    <?php else: ?>
        <div class="text-center">
            <h5 class="h5 text-center">Le panier est vide.</h5>
            <a href="<?= BASE_DIR ?>/produits" type="button" class="btn btn-primary m-5">Retourner à la boutique</a>
        </div>
    <?php endif; ?>
</main>