<?php

class Paniers extends Controller {
    /**
     * Cette méthode affiche la liste des produits dans le panier
     *
     * @return void
     */
    public function index(){
        if(isset($_SESSION['user'])){
            $this->loadModel("Panier");
            $user = $_SESSION['user']["email"];
            $panier=$this->Panier->getAllProduitsPanier($user);
            $this->render('index', compact("panier"));
        }

        else{
            if (!empty($_SESSION['cart'])){
                $this->loadModel('Panier');
                $panier = $this->Panier->getCartproduit();
                $this->render('index', compact("panier"));
            } else {
                $this->render('index');
            }
        }
}

    public function checkout(){
        $this->loadModel('Panier');

        $check = $this->Panier->getCartproduit();

        $this->render('checkout', compact("check"));
    }

    public function delete(string $produitSlug){
        if(isset($_SESSION['user'])){
            $this->loadModel("Panier");
            $user = $_SESSION['user']["email"];
            $this->Panier->deleteProduitPanier($produitSlug,$user);
            $this->render('index');
        }
        else{
            $this->render('delete', compact("produitSlug"));
        }

        
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
        }else{
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

 public function RemoveFromCart (string $produitSlug){
    if(isset($_SESSION['user'])){
        $this->loadModel("Panier");
        $user = $_SESSION['user']["email"];
        
        $produit=$this->Panier->getProduitPanier($produitSlug,$user);
        $quantite=$produit['quantite'];
        if($quantite>1){
            $this->Panier->updatePanier($produitSlug,$user,-1);
        }
        else{
            $this->Panier->deleteProduitPanier($produitSlug,$user);

        }
    }else{
    if(!empty($_SESSION['cart'][$produitSlug])){
        if($_SESSION['cart'][$produitSlug]['quantite']>1){
            $_SESSION['cart'][$produitSlug]['quantite']--;
        }
        else{
            unset($_SESSION['cart'][$produitSlug]);
            
        }
    }
        
}
header("location:". BASE_DIR . "/paniers");
 }


public function UpToCart(string $produitSlug){
    if(isset($_SESSION['user'])){
        $this->loadModel("Panier");
        $user = $_SESSION['user']["email"];
        $this->Panier->updatePanier($produitSlug,$user,1);
    }
    else{
    if(!empty($_SESSION['cart'][$produitSlug])){
            $_SESSION['cart'][$produitSlug]['quantite']++;

    }
     
}
header("location:". BASE_DIR . "/paniers");

}





}
