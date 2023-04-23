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

}