<?php

class Produits extends Controller{
    /**
     * Méthode permettant d'afficher la liste des produits
     *
     * @return void
     */
    public function index(){
        $this->loadModel('Produit');
        $this->loadModel('Categorie');

        $produits = $this->Produit->getProduitWithCategorie();
        $categories = $this->Categorie->getAll();

        $this->render('index', compact('produits', 'categories'));
    }

    /**
     * Méthode permettant d'afficher un produit à partir de son slug
     *
     * @param string $slug
     * @return void
     */
    public function details(string $slug){
        $this->loadModel('Produit');
        $produit = $this->Produit->findBySlug($slug);
        $this->render('details', compact('produit'));
    }

    /**
     * Méthode permettant d'afficher la page d'ajout d'un produit
     *
     * @return void
     */
    public function ajouter_article(){
        $this->forAdmin();
        $this->loadModel("Produit");
        $this->loadModel("Categorie");

        $categories = $this->Categorie->getAll();

        if (isset($_POST['nomproduit']) && isset($_POST['prixproduit']) && isset($_POST['stockproduit']) && isset($_POST['marqueproduit']) && isset($_POST['descproduit']) && isset($_POST['slug_categorie'])&& isset($_POST['imageproduit'])) {
            // Tous les champs ont été remplis
            $nom = $_POST['nomproduit'];
            $prix = $_POST['prixproduit'];
            $stock = $_POST['stockproduit'];
            $marque = $_POST['marqueproduit'];
            $description = $_POST['descproduit'];
            $slug_categorie = $_POST['slug_categorie'];
            $image = $_POST['imageproduit'];
            $this->Produit->addNewProduit($nom, $prix, $stock, $marque, $description, $slug_categorie, $image);
            header("location:". BASE_DIR ."/produits/back_office");
        } else {
            $this->render('add_article', compact('categories'));
        }
    }

    /**
     * Méthode permettant d'afficher un produit pour le modifier à partir de son slug
     *
     * @param string $slug
     * @return void
     */
    public function modifier_article($slug){
        $this->forAdmin();
        $this->loadModel("Produit");
        $this->loadModel("Categorie");

        $categories = $this->Categorie->getAll();
        $produit = $this->Produit->findBySlug($slug);

        if (isset($_POST['nomproduit']) && isset($_POST['marqueproduit']) && isset($_POST['descproduit']) && isset($_POST['imageproduit']) && isset($_POST['prixproduit']) && isset($_POST['slug_categorie'])) {
            // Tous les champs ont été remplis
            $nom = $_POST['nomproduit'];
            $marque = $_POST['marqueproduit'];
            $description = $_POST['descproduit'];
            $image = $_POST['imageproduit'];
            $prix = $_POST['prixproduit'];
            $stock = $_POST['stockproduit'];
            $slug_categorie = $_POST['slug_categorie'];
            $slug_produit = $slug;

            $this->Produit->updateProduit($slug_produit, $nom, $marque, $description, $image, $prix, $stock, $slug_categorie);
            header("location:". BASE_DIR ."/produits/back_office");
        } else {
            $this->render('modifier_article', compact('categories', 'produit'));
        }
    }

    /**
     * Méthode permettant d'afficher la page de back office
     *
     * @return void
     */
    public function back_office(){
        $this->forAdmin();
        $this->loadModel("Produit");

        $produits = $this->Produit->getProduitWithCategorie();

        $this->render('back_office', compact('produits'));
    }

    /**
     * Méthode permettant de supprimer un produit
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id){
        $this->forAdmin();
        $this->loadModel("Produit");

        $deleteSuccess = $this->Produit->deleteArticle($id);
        if ($deleteSuccess) {
            $_SESSION['success'] = "Le produit a été supprimé avec succès.";
        } else {
            $_SESSION['error'] = "Une erreur s'est produite lors de la suppression du produit.";
        }

        header("location:". BASE_DIR ."/produits/back_office");
    }
}