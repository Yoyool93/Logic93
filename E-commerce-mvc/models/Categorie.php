<?php
class Categorie extends Model{

    public function __construct()
    {
        $this->table = "categorie";
        $this->getConnection();
    }

    public function findBySlug(string $categorie){
        $this->getConnection();
        $stmt = $this->_connexion->prepare("SELECT nom_categorie FROM " . $this->table ." WHERE slug_categorie = :slug");
        $stmt->bindValue(':slug', $categorie, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProduitFromCategorie(string $categories){
        $this->getConnection();   
        $stmt = $this->_connexion->prepare("SELECT a.slug_produit, a.nom_produit, a.prix, a.stock, a.marque, a.description, a.slug_categorie, c.image as categorie FROM  produit as a INNER JOIN categorie as c ON a.nom_produit = c.slug_produit  WHERE c.categorie = :slug_categorie");
        $stmt->bindValue(':slug_categorie', $categories, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

  
      //var_dump(getProduitFromCategorie); 
      
    }
}
