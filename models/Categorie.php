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
        $stmt = $this->_connexion->prepare("SELECT p.slug_produit, p.nom_produit, p.prix, p.stock, p.marque, p.description, p.slug_categorie, p.image FROM produit as p INNER JOIN categorie as c ON p.slug_categorie = c.slug_categorie WHERE c.slug_categorie = :slug_categorie");
        $stmt->bindValue(':slug_categorie', $categories, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

  
      //var_dump(getProduitFromCategorie); 
      
    }
}
