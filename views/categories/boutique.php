<div class="content">

   
<?php //$slug_categorie = $nameCategorie[str_replace("categories/boutique/", "", $_GET["p"])];
 //var_dump($slug_categorie) ;
// var_dump($laCategorie);
 ?>


    <h1 class="h1 text-center"><?= $laCategorie["nom_categorie"] ?></h1>

    <hr>

    <div class="text-center m-4">
        <a href="<?= BASE_DIR ?>/produits" type="button" class="btn btn-primary category-button">Liste des produits</a>
        <?php foreach( $nameCategorie as $nameCategorie): ?>
            <button <?php if ($slug_categorie == $nameCategorie["slug_categorie"]) echo "disabled"; ?> onclick="location.href='<?= BASE_DIR ?>/categories/boutique/<?= $nameCategorie['slug_categorie'] ?>'" type="button" class="btn btn-primary category-button"><?= $nameCategorie['nom_categorie'] ?></button>
        <?php endforeach ?>
        
        </div>

    <div class="container">
        <div class="row row-cols-auto" style="justify-content: center;">
            <?php 
              if ($categories != array()): ?>
           
                <?php foreach($categories as $produit): ?>
                    <div class="col">
                        <a href="<?= BASE_DIR ?>/produits/details/<?= $produit['nom_produit'] ?>" style="text-decoration: none; color: black">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="<?= BASE_DIR ?>/<?= $produit['image'] ?>" alt="<?= $produit['nom'] ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $produit['nom'] ?></h5>
                                        // <p class="card-text content-shortDesc">
                                        // <?php
                                         //  $maxLength = 60;
                                         //  if (strlen($produit['marque']) > $maxLength) {
                                          //     $lastSpace = strrpos(substr($produit['description'], 0, $maxLength), ' ');
                                         //    $truncatedString = substr($produit['decription'], 0, $lastSpace);
                                         //    echo $truncatedString . '...';
                                        // } else {
                                        //      echo $produit['description'];
                                         // }
                                         // ?>
                                        //  </p>

                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><?= $produit['prix'] ?>,00 €</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <h5 class="h4 text-center">Pas de produit dans cette catégorie.
                   <br > Cherchez ailleurs ! <br
                </h5>
            <?php endif; ?>
        </div>
    </div>
</div>