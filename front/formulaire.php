<?php
session_start();

require_once("../Cnx.php");

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

    foreach ($_SESSION["panier"] as $item) {

        $quantite = $item["quantite"];
        $prix = $item["prix"];

        $sql = "INSERT INTO commandes 
        (quantite, date, nom_client, adresse, prix)
        VALUES 
        ('$quantite', '$date', '$nom', '$adresse', '$prix')";

        $pdo->exec($sql);
    }

    unset($_SESSION["panier"]);

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


    <style>
        .container {
            width: 60%;
            margin: 40px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        .box {
            background: #eee;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .ok {
            background: green;
            color: white;
        }

        .cancel {
            background: red;
            color: white;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="container nav-container">
            <div class="logo">Book<span>Store</span></div>
            <nav class="nav">
                <a href="home.php">Accueil</a>
                <a href="livres.php">Liste des livres</a>
                <a href="../panier.php">Panier 🛒</a>
                <div class="dropdown">
                    <span>Front Office ▾</span>
                    <div class="dropdown-menu">
                        <a href="profil.php">Profil</a>
                        <a href="guest.html">Déconnecter</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div class="container">

        <h2>Validation commande</h2>

        <form method="POST">

            <input type="text" name="nom" placeholder="Nom client">
            <textarea name="adresse" placeholder="Adresse"></textarea>

            <h3>Résumé panier</h3>

            <?php foreach ($_SESSION["panier"] as $item): ?>
                <div class="box">
                    <p>Produit : <?= $item["titre"] ?></p>
                    <p>Prix : <?= $item["prix"] ?> DT</p>
                    <p>Quantité : <?= $item["quantite"] ?></p>
                    <p>Date : <?= date("Y-m-d") ?></p>
                </div>
            <?php endforeach; ?>

            <button type="submit" name="ok" class="ok">OK</button>
            <button type="submit" name="annuler" class="cancel">Annuler</button>

        </form>

    </div>

</body>

</html>