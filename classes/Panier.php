<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Panier
{
    public function ajouter($id, $titre, $prix, $image)
    {
        if (!isset($_SESSION["panier"])) {
            $_SESSION["panier"] = [];
        }

        foreach ($_SESSION["panier"] as &$item ) {
            if (isset($item["id_produit"]) && $item["id_produit"] == $id) {
                $item["quantite"]++;
                return;
            }
        }

        $_SESSION["panier"][] = [
            "id_produit" => $id,
            "titre" => $titre,
            "prix" => $prix,
            "image" => $image,
            "quantite" => 1
        ];
    }

    public function supprimer($index)
    {
        unset($_SESSION["panier"][$index]);
        $_SESSION["panier"] = array_values($_SESSION["panier"]);
    }

    public function paniertotal()
    {
        $total = 0;
        foreach ($_SESSION["panier"] ?? [] as $item) {
            $total += $item["prix"] * $item["quantite"];
        }
        return $total;
    }
}