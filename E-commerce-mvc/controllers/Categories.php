<?php

class Categories extends Controller{
    /**
     * Cette méthode affiche la liste des categories
     *
     * @return void
     */
    public function index(){
        $this->loadModel('Categorie');

       // $categories = $this->Categorie->getAll();

        $this->render('index', compact('Categorie'));
    }

    /**
     * Méthode permettant d'afficher la page d'une categorie
     *
     * @param str $categorie
     * @return void
     */
    public function boutique(string $slug_categorie){
        $this->loadModel('Categorie');
        
        $categories = $this->Categorie->getProduitFromCategorie($slug_categorie);
        $nameCategorie = $this->Categorie->getAll();
        $laCategorie = $this->Categorie->findBySlug($slug_categorie);

        $this->render('boutique', compact("categories","nameCategorie","slug_categorie",'laCategorie'));
    }
}