<?php
class Produit extends Model{

    public function __construct()
    {
        $this->table = "produit";
        $this->getConnection();
    }

    /**
     * Retourne un produit en fonction de son slug
     *
     * @param string $slug
     * @return Produit
     */
    public function findBySlug(string $slug){
        $this->getConnection();
        $stmt = $this->_connexion->prepare("SELECT * FROM " . $this->table ." WHERE slug_produit = :slug");
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProduitWithCategorie(){
        $this->getConnection();

        $stmt = $this->_connexion->prepare("SELECT p.slug_produit, p.nom_produit, p.marque, p.description, p.image, p.prix, c.nom_categorie as categorie, c.slug_categorie as slugCat FROM ".$this->table." as p INNER JOIN categorie as c ON p.slug_categorie = c.slug_categorie");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getThreeProduits(){
        $this->getConnection();
        $stmt = $this->_connexion->prepare("SELECT * FROM ". $this->table ." LIMIT 3");
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProduitsByCategoryId(int $categoryId) {
        $this->getConnection();
        $stmt = $this->_connexion->prepare("SELECT a.id, a.slug, a.nom, a.content, a.description, a.images, a.prix, c.nom as categorie, c.id as idCat FROM ". $this->table ." as a INNER JOIN categorie as c ON a.idCategorie = c.id WHERE c.id = :categoryId");
        $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addNewProduit(string $nom, string $prix, string $stock, string $marque,string $description, string $slug_categorie, string $image){
        $this->getConnection();
        $stmt = $this->_connexion->prepare("INSERT INTO ". $this->table ." (slug_produit,nom_produit,prix,stock,marque,description,slug_categorie,image) VALUES (:slug_produit, :nomproduit, :prixproduit ,:stockproduit , :marqueproduit , :descproduit , :slug_categorie,:imageproduit )");
        $stmt->bindValue(':slug_produit', $this->slugify($nom), PDO::PARAM_STR);
        $stmt->bindValue(':nomproduit', $nom, PDO::PARAM_STR);
        $stmt->bindValue(':prixproduit', $prix, PDO::PARAM_STR);
        $stmt->bindValue(':stockproduit', $stock, PDO::PARAM_STR);
        $stmt->bindValue(':marqueproduit', $marque, PDO::PARAM_STR);
        $stmt->bindValue(':descproduit', $description, PDO::PARAM_STR);
        $stmt->bindValue(':slug_categorie', $slug_categorie, PDO::PARAM_STR);
        $stmt->bindValue(':imageproduit', $image, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function updateProduit(string $slug_produit, string $nom, string $marque, string $description, string $image, int $prix,int $stock, string $slug_categorie){
        $this->getConnection();
        $stmt = $this->_connexion->prepare("UPDATE ". $this->table ." SET nom_produit = :nom, marque = :marque, description = :description, image = :image, prix = :prix,stock=:stock, slug_categorie = :slug_categorie WHERE slug_produit = :slug_produit");
        $stmt->bindValue(':slug_produit', $slug_produit, PDO::PARAM_STR);
        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindValue(':marque', $marque, PDO::PARAM_STR);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':image', $image, PDO::PARAM_STR);
        $stmt->bindValue(':prix', $prix, PDO::PARAM_INT);
        $stmt->bindValue(':stock', $stock, PDO::PARAM_INT);
        $stmt->bindValue(':slug_categorie', $slug_categorie, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function deleteProduit(int $id) {
        $this->getConnection();
        $stmt = $this->_connexion->prepare("DELETE FROM ". $this->table ." WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        try {
            $deleteSuccess = $stmt->execute();
            if($stmt->rowCount() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}