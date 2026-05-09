<?php
session_start();

require_once('../classes/Produit.php');
require_once('../classes/Panier.php');

if (!isset($_SESSION["connecte"])) {
  header("Location: login.php");
  exit();
}
if (!isset($_SESSION["panier"])) {
  $_SESSION["panier"] = [];
}

$panier = new Panier();
if (isset($_POST["add"])) {
    $panier->ajouter(
        $_POST["id_produit"],
        $_POST["title"],
        $_POST["price"],
        $_POST["image"]
    );

    $_SESSION["msg"] = "Livre ajouté au panier";
    header("Location: livres.php");
    exit();
}

$p = new Produit();
$res = $p->listerProd();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Liste des livres - BookStore</title>
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

  <section class="products container">
    <?php if (isset($_SESSION["success_panier"])): ?>
      <div class="msg-success">
        <?= $_SESSION["success_panier"]; 
        unset($_SESSION["success_panier"]); ?>
      </div>
    <?php endif; ?>
    <h2>Liste des livres</h2>
    <div class="grid">
      <?php foreach ($res as $row): ?>
        <div class="card">
        <img src="<?php echo (strpos($row['image'], 'http') === 0) 
              ? $row['image'] 
              : '../'.$row['image']; ?>">
          <div class="card-body">
            <h3><?php echo ($row['titre']); ?></h3>
            <p><?php echo $row['auteur']; ?></p>
            <span><?php echo $row['prix']; ?> DT</span>
            <form method="post" action="">
              <input type="hidden" name="id_produit" value="<?= $row['id'] ?>">
              <input type="hidden" name="title" value="<?php echo $row['titre']; ?>">
              <input type="hidden" name="price" value="<?php echo $row['prix']; ?>">
              <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
              <button type="submit" name="add">Ajouter au panier</button><br>
        
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <footer class="footer">
    <p>© 2026 BookStore</p>
  </footer>
</body>

</html>