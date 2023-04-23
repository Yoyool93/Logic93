<?php

class Panier extends Model{

    public function __construct(){
        $this->table = "produit";
        $this->getConnection();
    }

    public function getCartproduit(){
        $slugs = array_keys($_SESSION['cart']);
        $slugs = array_map(function($slug) {
            return '"' . str_replace('"', '\"', $slug) . '"';
        }, $slugs);
        $slugsString = implode(',', $slugs);
        
        $this->getConnection();
        $stmt = $this->_connexion->prepare("SELECT * FROM ". $this->table ." WHERE slug_produit IN (". $slugsString .")");
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}