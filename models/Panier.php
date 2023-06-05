<?php

class Panier extends Model{

    public function __construct(){
        $this->table = "panier";
        $this->getConnection();
    }

    public function getCartproduit(){
        //Recupere toutes les clés de la variable de session
        $slugs = array_keys($_SESSION['cart']);
        //Recupere tout les slugs a partir de l'array 
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


    public function deleteProduitPanier(string $slug_produit, string $email){
      
        $stmt = $this->_connexion->prepare("DELETE from ". $this->table ." WHERE `email_utilisateur` = :email AND `slug_produit` = :slug");
        $stmt->bindValue(':slug', $slug_produit, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function addCartSessionToCartBdd(string $email) {
        foreach ($_SESSION['cart'] as $slug => $values) {
            $quantite = $values['quantite'];

            $check_produit= $this->getProduitPanier($slug,$email);
            if($check_produit != Null){
                $this->updatePanier($slug,$email,$quantite);
            }else{
                $this->ajouterPanier($email, $quantite, $slug);
            }
        }
    }


    public function getAllProduitsPanier(string $email){
           
        $stmt = $this->_connexion->prepare("SELECT pr.slug_produit, pr.nom_produit, pr.prix, pr.stock, pr.marque, pr.description, pr.slug_categorie, pr.image,pa.quantite FROM PRODUIT AS pr inner join panier AS pa on pr.slug_produit = pa.slug_produit where pa.email_utilisateur= :email ");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();



        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: null;
    }
    
      
        public function deletePanier(string $email){
            $stmt = $this->_connexion->prepare("DELETE from ". $this->table ." WHERE `email_utilisateur` = :email");
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
        }
        
    
}

