<?php
session_start();

if (!isset($_SESSION["connecte"])) {
  header("Location: login.php");
  exit();
}
require_once('../classes/Produit.php');
$p = new Produit();
$res = $p->listerProd();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>BookStore</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
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

  <section class="products container">
    <h2>Livres populaires</h2>
    <div class="grid">
      <?php $i = 0;
      foreach ($res as $row): ?>
        <?php if ($i == 4)
          break; ?>
        <div class="card">
          <img src="<?php echo $row['image']; ?>">
          <div class="card-body">
            <h3><?php echo $row['titre']; ?></h3>
            <p><?php echo $row['auteur']; ?></p>
            <span><?php echo $row['prix']; ?> DT</span>
            <form method="post" action="panier.php">
              <input type="hidden" name="title" value="<?php echo $row['titre']; ?>">
              <input type="hidden" name="price" value="<?php echo $row['prix']; ?>">
              <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
            </form>
          </div>
        </div>
        <?php $i++; ?>
      <?php endforeach; ?>
    </div>
  </section>

  <footer class="footer">
    <p>© 2026 BookStore</p>
  </footer>

</body>

</html>