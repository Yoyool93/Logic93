<div class="content">
    <div class="video-container">
        <video id="video_bg" class="video-player img-fluid" autoplay disableremoteplayback="" style="width: 100%; height: 100%;" spellcheck="false" muted>
            <source src="<?= BASE_DIR ?>/staticfiles/medias/image_fond_flip.webm" type="video/mp4">
        </video>

        <h1 class="video-overlay h1-lst_produits"><strong>Liste des <br> produits</strong></h1>

    </div>

    <div class="container">
        <div class="text-center m-4">
            <?php foreach($categories as $categorie): ?>
                <a href="<?= BASE_DIR ?>/categories/boutique/<?= $categorie['slug_categorie'] ?>" type="button" class="btn btn-primary category-button">
                <?= $categorie['nom_categorie'] ?></a>
            <?php endforeach ?>
        </div>

        <div id="list-of-produit" class="row row-cols-auto" style="justify-content: center;">
            <!--      Liste des produits selon les catégories      -->
            <?php foreach($produits as $produit): ?>
                <div class="col">
                    <a href="<?= BASE_DIR ?>/produits/details/<?= $produit['slug_produit'] ?>" style="text-decoration: none; color: black">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="<?= $produit['image'] ?>" alt="<?= $produit['nom_produit'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $produit['nom_produit'] ?></h5>
                                <p class="card-text content-shortDesc">
                                    <?php
                                    $maxLength = 60;
                                    if (strlen($produit['description']) > $maxLength) {
                                        $lastSpace = strrpos(substr($produit['description'], 0, $maxLength), ' ');
                                        $truncatedString = substr($produit['description'], 0, $lastSpace);
                                        echo $truncatedString . '...';
                                    } else {
                                        echo $produit['description'];
                                    }
                                    ?>
                                </p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item h6"><?= $produit['prix'] ?>,00 €</li>
                            </ul>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>