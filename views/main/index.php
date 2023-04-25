<div class="carousel-content">
    <div id="carouselPresentation" class="carousel slide" data-bs-ride="carousel" >
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselPresentation" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselPresentation" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselPresentation" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselPresentation" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselPresentation" data-bs-slide-to="4" aria-label="Slide 5"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= BASE_DIR ?>/staticfiles/medias/A53.jpg" class="d-block w-100" alt="image de présentation Logic 93">
<!--                <div class="carousel-caption d-none d-md-block">-->
<!--                    <h5>First slide label</h5>-->
<!--                    <p>Some representative placeholder content for the first slide.</p>-->
<!--                </div>-->
            </div>
            <div class="carousel-item">
                <img src="<?= BASE_DIR ?>/staticfiles/medias/S21.jpg" class="d-block w-100" alt="...">
<!--                <div class="carousel-caption d-none d-md-block">-->
<!--                    <h5>Second slide label</h5>-->
<!--                    <p>Some representative placeholder content for the second slide.</p>-->
<!--                </div>-->
            </div>
            <div class="carousel-item">
                <img src="<?= BASE_DIR ?>/staticfiles/medias/Triplette.jpg" class="d-block w-100" alt="...">
<!--                <div class="carousel-caption d-none d-md-block">-->
<!--                    <h5>Third slide label</h5>-->
<!--                    <p>Some representative placeholder content for the third slide.</p>-->
<!--                </div>-->
            </div>
            <div class="carousel-item">
                <img src="<?= BASE_DIR ?>/staticfiles/medias/Casque_Beats.jpg" class="d-block w-100" alt="...">
<!--                <div class="carousel-caption d-none d-md-block">-->
<!--                    <h5>Fourth slide label</h5>-->
<!--                    <p>Some representative placeholder content for the fourth slide.</p>-->
<!--                </div>-->
            </div>
            <div class="carousel-item">
                <img src="<?= BASE_DIR ?>/staticfiles/medias/galaxybook_pro.jpg" class="d-block w-100" alt="...">
<!--                <div class="carousel-caption d-none d-md-block">-->
<!--                    <h5>Fifth slide label</h5>-->
<!--                    <p>Some representative placeholder content for the fifth slide.</p>-->
<!--                </div>-->
        </div>
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselPresentation" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselPresentation" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<main class="content">
    <div class="video-container">
        <video id="video_bg" class="video-player img-fluid" autoplay disableremoteplayback="" style="width: 100%; height: 100%;" spellcheck="false" muted>
            <source src="<?= BASE_DIR ?>/staticfiles/medias/image_fond_fold.webm" type="video/mp4">
        </video>
        <h3 class="video-overlay h3-lst_produits">Découvrez nos produits <br> directement dans <br> notre boutique</h3>
    </div>

    <div class="container">
        <div class="row row-cols-auto" style="justify-content: center;">
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
                                    if (strlen($produit['marque']) > $maxLength) {
                                        $lastSpace = strrpos(substr($produit['marque'], 0, $maxLength), ' ');
                                        $truncatedString = substr($produit['marque'], 0, $lastSpace);
                                        echo $truncatedString . '...';
                                    } else {
                                        echo $produit['marque'];
                                    }
                                    ?>
                                </p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <a href="<?= BASE_DIR ?>/categories/boutique/<?= $laCategorie["nom_categorie"] ?>" style="text-decoration: none;"><li class="list-group-item affiche-categorie"><?= $produit['slug_produit'] ?></li></a>
                                <li class="list-group-item h6"><?= $produit['prix'] ?>,00 €</li>
                            </ul>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</main>