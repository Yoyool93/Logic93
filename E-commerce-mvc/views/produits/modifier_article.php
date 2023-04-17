<div class="content p-5">
    <h1 class="h1 text-center">Modifier <?= $produit["nom_produit"] ?></h1>

    <?php if (isset($error)): ?>
        <p class="p text-danger text-center"><?= $error ?></p>
    <?php endif; ?>

    <form class="form mt-4" method="POST" action="<?= BASE_DIR ?>/produits/modifier_article/<?= $produit["slug_produit"] ?>">
        <div class="form-group mb-4">
            <label for="inputNom" class="text-right">Nom du produit</label>
            <input value="<?= $produit["nomproduit"] ?>" required maxlength="250" type="text" class="form-control mt-2" id="inputNom" name="nomproduit" placeholder="Entrez le nom du produit">
        </div>
        <div class="form-group mb-4">
            <label for="inputstock" class="text-right">Stock du produit</label>
            <input value="<?= $produit["stockproduit"] ?>" required maxlength="250" type="text" class="form-control mt-2" id="inputstock" name="stockproduit" placeholder="Entrez le stock du produit">
        </div>
        <div class="form-group mb-4">
            <label for="inputmarque" class="text-right">Marque du produit</label>
            <input value="<?= $produit["marqueproduit"] ?>" required maxlength="250" type="text" class="form-control mt-2" id="inputmarque" name="marqueproduit" placeholder="Entrez la marque du produit">
        </div>
        <div class="form-group mb-4">
            <label for="inputDescription" class="text-right">Description du produit</label>
            <textarea required maxlength="500" class="form-control" id="inputDescription" name="descproduit" rows="3" placeholder="Entrez la description du produit"><?= $produit["descproduit"] ?></textarea>
        </div>
        
       
        <div class="form-group mb-4">
            <label for="inputImage" class="text-right">Image du produit</label>
            <img src="<?= BASE_DIR . "/". $produit["imageproduit"] ?>" alt="">
            <input value="<?= $produit["imageproduit"] ?>" required maxlength="250" type="text" class="form-control" id="inputImage" name="imageproduit" placeholder="Entrez l'URL de l'image du produit">
        </div>
        <div class="form-group mb-4">
            <label for="inputPrix" class="text-right">Prix du produit</label>
            <input value="<?= $produit["prixproduit"] ?>" required maxlength="11" type="number" class="form-control" id="inputPrix" name="prixproduit" placeholder="Entrez le prix du produit">
        </div>
        <div class="form-group mb-4">
            <label for="inputCategorie" class="text-right">Catégorie du produit</label>
            <select class="form-control" id="inputCategorie" name="slug_categorie">
                <?php foreach ($categories as $categorie): ?>
                    <option <?php if ($categorie["id"] == $produit["slug_categorie"]) echo "selected" ; ?> value="<?= $categorie["id"] ?>"><?= $categorie["nom"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="d-flex">
            <button type="button" data-bs-toggle="modal" data-bs-target="#idUpdateArticle" class="btn btn-primary mt-4 ms-auto">Modifier le produit</button>
        </div>

    <!-- Confirmation -->
    <div class="modal fade" id="idUpdateArticle" tabindex="-1" aria-labelledby="updateBdd" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addToCart">Confirmer la modification du produit ?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Confirmer <i class="fa-solid fa-circle-plus"></i></button>
                </div>
            </div>
        </div>
    </div>

    </form>
</div>

