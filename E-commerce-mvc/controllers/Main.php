<?php

class Main extends Controller{

    public function index(){
        $this->loadModel('Produit');
        $produits = $this->Produit->getproduitWithCategorie();
        $this->render('index', compact('produits'));
    }

    public function cgv(){
        $this->render('cgv');
    }

    public function cgu(){
        $this->render('cgu');
    }

    public function about(){
        $this->render('about');
    }
}