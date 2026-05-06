<?php
class Panier
{
    public function ajouterProduit($titre, $prix, $image)
    {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
        $produitExiste = false;
        foreach ($_SESSION['panier'] as &$produit) {
            if ($produit['titre'] == $titre) {
                $produit['quantite']++;
                $produitExiste = true;
                break;
            }
        }
        if (!$produitExiste) {
            $_SESSION['panier'][] = [
                'titre' => $titre,
                'prix' => $prix,
                'image' => $image,
                'quantite' => 1
            ];
        }
    }
}

if (isset($_POST['add'])) {
    $panier = new Panier();
    $panier->ajouterProduit($_POST['title'], $_POST['price'], $_POST['image']);
    header("Location: panier.php");
    exit();
}
?>