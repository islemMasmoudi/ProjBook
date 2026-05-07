<?php
class Produit
{
    public $id;
    public $titre;
    public $auteur;
    public $prix;
    public $image;
    public $desc;

    public function ajouterProd($titre, $auteur, $prix, $image, $desc)
    {
        require_once('../Cnx.php');
        $cnx = new Cnx();
        $pdo = $cnx->CNXbase();
        $pdo->exec("INSERT INTO produits (titre, prix) VALUES ('$titre', '$prix')");
    }
    public function listerProd()
    {
        require_once('../Cnx.php');
        $cnx = new Cnx();
        $pdo = $cnx->CNXbase();
        $stmt = $pdo->query("SELECT * FROM produits");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function supprimeProd($id)
    {
        require_once('../Cnx.php');
        $cnx = new Cnx();
        $pdo = $cnx->CNXbase();
        $pdo->exec("DELETE FROM produits WHERE id = $id");
        
    }
}
?>