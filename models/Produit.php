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

        $stmt = $this->_connexion->prepare("SELECT a.id, a.slug, a.nom, a.content, a.description, a.images, a.prix, c.nom as categorie, c.id as idCat FROM ". $this->table ." as a INNER JOIN categorie as c ON a.idCategorie = c.id");
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

    public function updateProduit(int $id, string $nom, string $content, string $description, string $image, int $prix, int $idCategorie){
        $this->getConnection();
        $stmt = $this->_connexion->prepare("UPDATE ". $this->table ." SET slug = :slug, nom = :nom, content = :content, description = :description, images = :images, prix = :prix, idCategorie = :idCategorie WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':slug', $this->slugify($nom), PDO::PARAM_STR);
        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':images', $image, PDO::PARAM_STR);
        $stmt->bindValue(':prix', $prix, PDO::PARAM_INT);
        $stmt->bindValue(':idCategorie', $idCategorie, PDO::PARAM_INT);
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