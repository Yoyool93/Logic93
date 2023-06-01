<?php

class Produit_commandes extends Controller {
    /**

     *
     * @return void
     */
    public function index(){
        if(isset($_SESSION['user'])){
            $this->loadModel("Produit_commande");
            $this->loadModel("Panier");
            $this->loadModel("Produit");
            $user = $_SESSION['user']["email"];

            $produitDansPanier =$this->Panier->getAllProduitsPanier($user);
            $maxRefCommande = $this->Produit_commande->getMaxRefCommande($user);
            $refCommande = $maxRefCommande + 1;

            
            foreach($produitDansPanier as $produit) {
                $produitSlug= $produit["slug_produit"];
                $prix=$produit["prix"];
                $quantite=$produit["quantite"];
               
                $this->Produit_commande->SauvegardePanier($produitSlug,$prix,$quantite,$user,$refCommande);
                $this->Produit->updateStockProduit($produitSlug,$quantite);
                echo $produitSlug;
                
            }
            $produit_commande =$this->Produit_commande->getAllProduitsCommande($user, $refCommande);
            $this->Panier->deletePanier($user);
            

           $this->render('index', compact("produit_commande"));
        }
    } 

   

}