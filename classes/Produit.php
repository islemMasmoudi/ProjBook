<?php
class Produit
{
    public $id;
    public $titre;
    public $auteur;
    public $prix;
    public $image;
    public $desc;

    public $stock;

    public function ajouterProd($titre, $auteur, $prix, $image, $desc,$stock)
    {
        require_once('../Cnx.php');
        $cnx = new Cnx();
        $pdo = $cnx->CNXbase();
        $pdo->exec("INSERT INTO produits (titre,auteur, prix,image,description,stock) VALUES ('$titre','$auteur', '$prix','$image','$desc','$stock')");
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
    public function selectLivre($id){
        require_once('../Cnx.php');
        $cnx = new Cnx();
        $pdo = $cnx->CNXbase();
        $stmt = $pdo->query("SELECT * FROM produits WHERE id=$id");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function modifierProd($id,$titre, $auteur, $prix, $image, $desc,$stock)
    {
        require_once('../Cnx.php');
        $cnx = new Cnx();
        $pdo = $cnx->CNXbase();
        $pdo->exec("UPDATE produits 
        SET titre='$titre', auteur='$auteur', prix='$prix', image='$image', description='$desc', stock='$stock'
        WHERE id='$id'");
    }
}
?>