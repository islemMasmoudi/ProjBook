<?php
session_start();
if (!isset($_SESSION["panier"])) {
    $_SESSION["panier"] = [];
}

if (isset($_POST["add"])) {
    $_SESSION["panier"][] = [
        "title" => $_POST["title"],
        "price" => $_POST["price"],
        "image" => isset($_POST["image"]) ? $_POST["image"] : ""
    ];
    header("Location: panier.php");
    exit();
}

if (isset($_POST["remove"])) {
    $index = $_POST["index"];
    unset($_SESSION["panier"][$index]);
    $_SESSION["panier"] = array_values($_SESSION["panier"]);
    header("Location: panier.php");
    exit();
}

$book_images = [
    "Atomic Habits" => "https://images.unsplash.com/photo-1544947950-fa07a98d237f",
    "The Alchemist" => "https://images.unsplash.com/photo-1512820790803-83ca734da794",
    "Rich Dad Poor Dad" => "https://images.unsplash.com/photo-1495446815901-a7297e633e8d",
    "Think and Grow Rich" => "https://images.unsplash.com/photo-1524995997946-a1c2e315a42f",
    "Deep Work" => "https://images.unsplash.com/photo-1519681393784-d120267933ba",
    "Start With Why" => "https://images.unsplash.com/photo-1516979187457-637abb4f9353",
];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Panier</title>
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
    </style>
</head>

<body>

    <header class="header">
        <div class="container nav-container">
            <div class="logo">Book<span>Store</span></div>
            <nav class="nav">
                <a href="home.php">Accueil</a>
                <a href="livres.php">Liste des livres</a>
                <a href="panier.php">Panier 🛒</a>
                <div class="dropdown">
                    <span>Front Office ▾</span>
                    <div class="dropdown-menu">
                        <a href="commande.php">Commander</a>
                        <a href="profil.php">Profil</a>
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
                    <?php
                    $title = $item["title"];
                    $img = !empty($item["image"])
                        ? $item["image"]
                        : (isset($book_images[$title]) ? $book_images[$title] : "https://images.unsplash.com/photo-1544947950-fa07a98d237f");
                    ?>
                    <div class="panier-card">
                        <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($title) ?>">
                        <div class="panier-card-body">
                            <h3><?= htmlspecialchars($title) ?></h3>
                            <span class="price"><?= htmlspecialchars($item["price"]) ?> DT</span>
                            <form method="POST">
                                <input type="hidden" name="index" value="<?= $index ?>">
                                <button class="btn-remove" name="remove">🗑 Supprimer</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php $total = array_sum(array_column($_SESSION["panier"], "price")); ?>
            <div class="panier-total">
                Total : <?= $total ?> DT
            </div>
        <?php endif; ?>
    </section>

    <footer class="footer">
        <p>© 2026 BookStore</p>
    </footer>

</body>

</html>