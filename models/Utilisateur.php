<?php

class Utilisateur extends Model{
    public function __construct()
    {
        $this->table = "utilisateur";
        $this->getConnection();
    }

    public function getConnect(string $email, string $pwd){
        $this->getConnection();
        $stmt = $this->_connexion->prepare("SELECT * FROM ". $this->table ." where email = :email and mdp = :pwd");
        $stmt->BindValue(":email", $email, PDO::PARAM_STR);
        $stmt->BindValue(":pwd", $pwd, PDO::PARAM_STR);
        $stmt->execute();

        // Si la requête a renvoyé au moins un résultat, on renvoie les informations de l'utilisateur
        // Sinon, on renvoie null
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function createUser(string $name, string $email, string $prenom , string $adresse ,string  $ville, int $cp, string $mdp){
        $this->getConnection();
        $stmt = $this->_connexion->prepare("INSERT INTO ". $this->table ." ( email,nom,prenom,adresse,ville,code_postal,mdp,admin) VALUES (:email, :nom, :prenom, :adresse, :ville , :cp , :mdp , 1)");
        $stmt->BindValue(":email", $email, PDO::PARAM_STR);
        $stmt->BindValue(":nom", $name, PDO::PARAM_STR);
        $stmt->BindValue(":prenom", $prenom, PDO::PARAM_STR);
        $stmt->BindValue(":adresse", $adresse, PDO::PARAM_STR);
        $stmt->BindValue(":ville", $ville, PDO::PARAM_STR);
        $stmt->BindValue(":cp", $cp, PDO::PARAM_INT);
        $stmt->BindValue(":mdp", $mdp, PDO::PARAM_STR);
    
        $stmt->execute();
    }

    public function ifEmailExist(string $email){
        $this->getConnection();
        $stmt = $this->_connexion->prepare("SELECT email FROM ". $this->table ." where email = :email");
        $stmt->BindValue(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        // ?si  :sinon ternaire
        // return null si pas deja inscrit
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

}