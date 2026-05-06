<?php
session_start();

if (!isset($_SESSION["connecte"])) {
    header("Location: front/login.php");
    exit();
}

if (isset($_POST['add'])) {
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }
    $titre = $_POST['title'];
    $prix = $_POST['price'];
    $image = $_POST['image'];

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
    header("Location: panier.php");
    exit();
}

// Handle remove
if (isset($_POST['remove']) && isset($_POST['index'])) {
    array_splice($_SESSION['panier'], (int) $_POST['index'], 1);
    header("Location: panier.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Panier - BookStore</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .panier-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .panier-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s;
        }

        .panier-card:hover {
            transform: translateY(-4px);
        }

        .panier-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .panier-card-body {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            flex: 1;
        }

        .panier-card-body h3 {
            font-size: 0.95rem;
            font-weight: 600;
            margin: 0;
            color: #2d2d2d;
        }

        .panier-card-body .price {
            font-size: 0.9rem;
            color: #e07b39;
            font-weight: 600;
        }

        .panier-card-body .qty {
            font-size: 0.85rem;
            color: #666;
        }

        .panier-card-body .btn-remove {
            margin-top: auto;
            padding: 0.45rem 0;
            background: #fff;
            color: #e53935;
            border: 1.5px solid #e53935;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-size: 0.82rem;
            font-weight: 600;
            transition: background 0.2s, color 0.2s;
            width: 100%;
        }

        .panier-card-body .btn-remove:hover {
            background: #e53935;
            color: #fff;
        }

        .empty {
            text-align: center;
            color: #999;
            margin-top: 3rem;
            font-size: 1.1rem;
        }

        .panier-total {
            margin-top: 2rem;
            text-align: right;
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d2d2d;
        }

        .acheter-btn {
            display: block;
            margin: 2rem auto 0;
            padding: 0.9rem 2.2rem;
            background: #e07b39;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(224, 123, 57, 0.25);
        }

        .acheter-btn:hover {
            background: #c96528;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(224, 123, 57, 0.35);
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="container nav-container">
            <div class="logo">Book<span>Store</span></div>
            <nav class="nav">
                <a href="front/home.php">Accueil</a>
                <a href="front/livres.php">Liste des livres</a>
                <a href="panier.php">Panier 🛒</a>
                <div class="dropdown">
                    <span>Front Office ▾</span>
                    <div class="dropdown-menu">
                        <a href="commande.php">Commander</a>
                        <a href="front/profil.php">Profil</a>
                        <a href="déconnecter.php">Déconnecter</a>
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
                        <img src="<?= htmlspecialchars($item["image"]) ?>" alt="<?= htmlspecialchars($item["titre"]) ?>">
                        <div class="panier-card-body">
                            <h3><?= htmlspecialchars($item["titre"]) ?></h3>
                            <span class="price"><?= htmlspecialchars($item["prix"]) ?> DT</span>
                            <span class="qty">Quantité : <?= (int) $item["quantite"] ?></span>
                            <form method="POST">
                                <input type="hidden" name="index" value="<?= $index ?>">
                                <button class="btn-remove" name="remove">🗑 Supprimer</button>
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
    <a href="front/formulaire.php">
        <button class="acheter-btn">Acheter</button>
    </a>
    <footer class="footer">
        <p>© 2026 BookStore</p>
    </footer>

</body>

</html>