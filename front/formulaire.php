<?php
session_start();

require_once("../Cnx.php");
require_once("../classes/Commande.php");

if (!isset($_SESSION["panier"]) || empty($_SESSION["panier"])) {
    header("Location: panier.php");
    exit();
}

$cnx = new Cnx();
$pdo = $cnx->CNXbase();

if (isset($_POST["annuler"])) {
    header("Location: home.php");
    exit();
}

if (isset($_POST["ok"])) {

    
    $nom = $_POST["nom"];
    $adresse = $_POST["adresse"];
    $date = date("Y-m-d H:i:s");

    foreach ($_SESSION["panier"] as $index=>$item) {

        $quantite = $_POST["quantite"][$index];
        $prix_unitaire = $item["prix"];
        $prix_total = $prix_unitaire * $quantite;

        $cmd = new Commande();

        $cmd->nom_client = $nom;
        $cmd->adresse = $adresse;
        $cmd->produit = $item["titre"];
        $cmd->quantite = $quantite;
        $cmd->prix = $prix_total; 

        $cmd->date = $date;

        $cmd->ajouter();
    }

    unset($_SESSION["panier"]);

    $_SESSION["success_achat"] = "Ton ordre est bien enregistré. Le livre sera livré en 24h.";

    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Commande</title>

    <link rel="stylesheet" href="../style.css">
    
</head>

<body>
    <header class="header">
        <div class="container nav-container">
            <div class="container nav-container">
                <a href="home.php" class="logo-link">
                <div class="logo">
                    Book<span>Store</span>
                </div>
            </a>
            <nav class="nav">
                <a href="home.php">Accueil</a>
                <a href="livres.php">Liste des livres</a>
                <a href="../panier.php">Panier 🛒</a>
                <div class="dropdown">
                    <span>Paramètres ▾</span>
                    <div class="dropdown-menu">
                        <a href="profil.php">Profil</a>
                        <a href="guest.html">Déconnecter</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div class="container cart-section">

    <h2 class="cart-title">Validation commande</h2>

    <form method="POST">

        <input type="text" name="nom" placeholder="Nom client">
        <textarea name="adresse" placeholder="Adresse"></textarea>

        <h3>Résumé panier</h3>

        <?php foreach ($_SESSION["panier"] as $index => $item): ?>
            <div class="cart-box">
                <div class="cart-item">
                    <h4><?= $item["titre"] ?></h4>
                    <span><?= $item["prix"] ?> DT</span>
                </div>

                <div class="cart-item">
                    <label>Quantité</label>
                    <input 
                        type="number" 
                        name="quantite[<?= $index ?>]" 
                        value="<?= $item["quantite"] ?>" 
                        min="1"
                    >
                </div>
            </div>
        <?php endforeach; ?>

        <button type="submit" name="ok" class="cart-btn ok">OK</button>
        <button type="submit" name="annuler" class="cart-btn cancel">Annuler</button>

    </form>

</div>
</body>

</html>