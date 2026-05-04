<?php
class Produit {
    public $id;
    public $titre;
    public $auteur;
    public $prix;
    public $image;
    public $desc;

    public function ajouterProd($titre, $auteur, $prix, $image, $desc) {
        require_once('../Cnx.php');
        $cnx=new Cnx();
        $pdo=$cnx->CNXbase();
        $req="INSERT INTO produits (titre,auteur,prix,image,description) VALUES ('$this->titre','$this->auteur','$this->prix','$this->image','$this->desc')";
        $pdo->exec($req) or print_r($pdo->errorInfo());
    }

    public function listerProd() {
        require_once('../Cnx.php');
        $cnx=new Cnx();
        $pdo=$cnx->CNXbase();
        $req="SELECT * FROM produits";
        return $pdo->query($req);
    }
    public function supprimeProd($id) {
        require_once('../Cnx.php');
        $cnx=new Cnx();
        $pdo=$cnx->CNXbase();
        $req="DELETE FROM produits WHERE id=$id";
        $pdo->exec($req) or print_r($pdo->errorInfo());
    }
}
?>
