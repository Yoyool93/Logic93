<?php

class Paniers extends Controller {
    /**
     * Cette méthode affiche la liste des produits dans le panier
     *
     * @return void
     */
    public function index(){
        if (!empty($_SESSION['cart'])){
            $this->loadModel('Panier');
            $panier = $this->Panier->getCartproduit();
            $this->render('index', compact("panier"));
        } else {
            $this->render('index');
        }
    }

    public function checkout(){
        $this->loadModel('Panier');

        $check = $this->Panier->getCartproduit();

        $this->render('checkout', compact("check"));
    }

    public function delete(string $produitSlug){
        $this->render('delete', compact("produitSlug"));
    }

    public function addToCart(){
        if(isset($_SESSION['user'])){
            $this->loadModel("Panier");
            $user = $_SESSION['user']["email"];
            $quantite = $_POST['quantite'];
            $produit = $_POST['produitSlug'];

            $check_produit= $this->Panier->getProduitPanier($produit,$user);
            if($check_produit != Null){
                $this->Panier->updatePanier($produit,$user,$quantite);
            }else{
                $this->Panier->ajouterPanier($user, $quantite, $produit);
            }
        }

        if(isset($_POST['produitSlug']) && isset($_POST['quantite'])){
            $produitSlug = $_POST['produitSlug'];
            $quantite = $_POST['quantite'];
    
            $this->loadModel('Panier');
            if(!isset($_SESSION['cart'][$produitSlug])){
                $_SESSION['cart'][$produitSlug] = ['quantite' => $quantite];
            } else {
                $_SESSION['cart'][$produitSlug]['quantite'] += $quantite;
            }
        }

}
}