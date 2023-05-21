<?php

class Produit_commande extends Model{

    public function __construct(){
        $this->table = "produit_commande";
        $this->getConnection();
    }

    public function SauvegardePanier(string $produitSlug , int $prix , int $quantite, string $email,int $refCommande){
        $stmt = $this->_connexion->prepare("INSERT INTO ". $this->table ."( `email_utilisateur`, `quantite`, `slug_produit`, `prix`,ref_commande) VALUES (:email, :quantite ,:slug_produit , :prix,:ref_commande)");
        $stmt->bindValue(':email', $email , PDO::PARAM_STR);
        $stmt->bindValue(':quantite', $quantite , PDO::PARAM_INT);
        $stmt->bindValue(':slug_produit', $produitSlug , PDO::PARAM_STR);
        $stmt->bindValue(':prix', $prix , PDO::PARAM_INT);
        $stmt->bindValue(':ref_commande', $refCommande , PDO::PARAM_INT);

        $stmt->execute();

    }

    public function getAllProduitsCommande(string $email, int $refCommande){
           
        $stmt = $this->_connexion->prepare("SELECT *  FROM ". $this->table."  where email_utilisateur = :email and ref_commande = :ref_commande");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':ref_commande', $refCommande, PDO::PARAM_INT);
        $stmt->execute();



        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: null;
    }

    public function getMaxRefCommande(string $email){
        $stmt = $this->_connexion->prepare("SELECT MAX(ref_commande) as max_ref_commande FROM ". $this->table." WHERE email_utilisateur = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['max_ref_commande'] ?? null;
    }
    
}