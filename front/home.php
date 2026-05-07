<?php
session_start();
require_once('../classes/Produit.php');

if (!isset($_SESSION["connecte"])) {
  header("Location: login.php");
  exit();
}

$p = new Produit();
$res = $p->listerProd();


if (isset($_SESSION["success"])) {
    echo "<div class='msg-success'>" . $_SESSION["success"] . "</div>";
    unset($_SESSION["success"]);
}


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
          <span>Front Office ▾</span>
          <div class="dropdown-menu">
            <a href="profil.php">Profil</a>
            <a href="guest.html">Déconnecter</a>
          </div>
        </div>
      </nav>
    </div>
  </header>
  
   <section class="hero container">
  <h1>Bienvenue à BookStore</h1>
  <p>
    Découvrez des livres populaires, développez vos connaissances
    et profitez d'une expérience de lecture moderne.
  </p>
</section>


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
              <button type="submit" name="add">Ajouter au panier</button>
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