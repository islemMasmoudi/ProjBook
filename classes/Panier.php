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
if (isset($_POST["valider"])) {
    $nom_livre = trim($_POST["nom_livre"]);
    $quantite = (int) $_POST["quantite"];

    if ($nom_livre === "" || $quantite < 1) {
        $erreur = "Veuillez remplir tous les champs correctement.";
    } elseif (!isset($catalogue[$nom_livre])) {
        $erreur = "Livre introuvable dans le catalogue.";
    } else {
        $book = $catalogue[$nom_livre];
        for ($i = 0; $i < $quantite; $i++) {
            $_SESSION["panier"][] = [
                "title" => $nom_livre,
                "price" => $book["price"],
                "image" => $book["image"]
            ];
        }
        header("Location: panier.php");
        exit();
    }
}
?>