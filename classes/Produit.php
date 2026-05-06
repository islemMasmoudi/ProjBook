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
        $req = $pdo->prepare("INSERT INTO produits (titre, auteur, prix, image, description) VALUES (?, ?, ?, ?, ?)");
        $req->execute([$titre, $auteur, $prix, $image, $desc]);
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
        $req = $pdo->prepare("DELETE FROM produits WHERE id = ?");
        $req->execute([$id]);
    }
}
?>