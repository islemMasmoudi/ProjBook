<?php
class Commande {

    public $id;
    public $nom_client;
    public $adresse;
    public $produit;
    public $quantite;
    public $prix;
    public $date;

    public function ajouter() {
        require_once('../Cnx.php');
        $cnx = new Cnx();
        $pdo = $cnx->CNXbase();

        $req = "INSERT INTO commandes (nom_client, adresse, produit, quantite, prix, date) VALUES ('$this->nom_client', '$this->adresse', '$this->produit', '$this->quantite', '$this->prix', '$this->date')";
        $pdo->exec($req) or print_r($pdo->errorInfo());
    }
}
?>