<?php

class Panier extends Model{

    public function __construct(){
        $this->table = "panier";
        $this->getConnection();
    }

    public function getCartproduit(){
        $slugs = array_keys($_SESSION['cart']);
        $slugs = array_map(function($slug) {
            return '"' . str_replace('"', '\"', $slug) . '"';
        }, $slugs);
        $slugsString = implode(',', $slugs);
        
        $this->getConnection();
        $stmt = $this->_connexion->prepare("SELECT * FROM produit WHERE slug_produit IN (". $slugsString .")");
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function ajouterPanier(string $email , int $quantite , string $slug_produit){
        
        $stmt = $this->_connexion->prepare("INSERT INTO ". $this->table ."( `email_utilisateur`, `quantite`, `slug_produit`) VALUES (:email , :quantite , :slug_produit)");
        $stmt->bindValue(':email', $email , PDO::PARAM_STR);
        $stmt->bindValue(':quantite', $quantite , PDO::PARAM_INT);
        $stmt->bindValue(':slug_produit', $slug_produit , PDO::PARAM_STR);
        
        $stmt->execute();


    }

    public function getProduitPanier(string $slug_produit,string $email){
           
        $stmt = $this->_connexion->prepare("SELECT * FROM " . $this->table ." WHERE slug_produit = :slug  AND email_utilisateur = :email ");
        $stmt->bindValue(':slug', $slug_produit, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function updatePanier(string $slug_produit, string $email,INT $quantite){
      
        $stmt = $this->_connexion->prepare("UPDATE ". $this->table ." SET `quantite`= quantite + :quantite WHERE `email_utilisateur` = :email AND `slug_produit` = :slug");
        $stmt->bindValue(':slug', $slug_produit, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':quantite', $quantite, PDO::PARAM_INT);
        $stmt->execute();
    }
}







