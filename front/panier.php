<?php
session_start();
require_once('../classes/Panier.php');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Panier - BookStore</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <header class="header">
        <div class="container nav-container">
            <a href="home.php" class="logo-link">
                <div class="logo">
                    Book<span>Store</span>
                </div>
            </a>
            <nav class="nav">
                <a href="home.php">Accueil</a>
                <a href="livres.php">Liste des livres</a>
                <a href="panier.php">Panier 🛒</a>
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

    <section class="container" style="padding: 2rem 0 3rem;">
        <h2>🛒 Mon Panier</h2>

        <?php if (empty($_SESSION["panier"])): ?>
            <p class="empty">Votre panier est vide.</p>
        <?php else: ?>
            <div class="panier-grid">
                <?php foreach ($_SESSION["panier"] as $index => $item): ?>
                    <div class="panier-card">
                        <img src="<?php echo (strpos($item['image'], 'http') === 0) 
                        ? $item['image'] 
                        : '../'.$item['image']; ?>">
                        <div class="panier-card-body">
                            <h3><?= $item["titre"]?></h3>
                            <span class="price"><?= $item["prix"]?> DT</span>
                            <span class="qty">Quantité : <?= (int) $item["quantite"] ?></span>
                            <form method="POST">
                                <input type="hidden" name="index" value="<?= $index ?>">
                                <button class="btn-remove" name="remove">Supprimer</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php
            $total = 0;
            foreach ($_SESSION["panier"] as $item) {
                $total += $item["prix"] * $item["quantite"];
            }
            ?>
            <div class="panier-total">
                Total : <?= number_format($total, 2) ?> DT
            </div>
        <?php endif; ?>
    </section>
    <a href="formulaire.php">
        <button class="acheter-btn">Acheter</button>
    </a>
    <footer class="footer">
        <p>© 2026 BookStore</p>
    </footer>

</body>

</html>