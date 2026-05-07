<?php
session_start();
if (!isset($_SESSION["connecte"])) {
  header("Location: login.php");
  exit();
}
require_once('../classes/Produit.php');
require_once('../classes/Panier.php');

if (isset($_POST["add"])) {
  $_SESSION["panier"][] = [
    "id_produit" => $_POST["id_produit"],
    "titre" => $_POST["title"],
    "prix" => $_POST["price"],
    "image" => $_POST["image"],
    "quantite" => 1
  ];

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
      <div class="logo">Book<span>Store</span></div>
      <nav class="nav">
        <a href="home.php">Accueil</a>
        <a href="livres.php">Liste des livres</a>
        <a href="../panier.php">Panier 🛒</a>
        <div class="dropdown">
          <span>Front Office ▾</span>
          <div class="dropdown-menu">
            <a href="profil.php">Profil</a>
            htmlspecialchars <a href="guest.html">Déconnecter</a>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <section class="products container">
    <h2>Liste des livres</h2>
    <div class="grid">
      <?php foreach ($res as $row): ?>
        <div class="card">
          <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['titre']); ?>">
          <div class="card-body">
            <h3><?php echo ($row['titre']); ?></h3>
            <p><?php echo htmlspecialchars($row['auteur']); ?></p>
            <span><?php echo htmlspecialchars($row['prix']); ?> DT</span>
            <form method="post" action="../panier.php">
              <input type="hidden" name="id_produit" value="<?= $row['id'] ?>">
              <input type="hidden" name="title" value="<?php echo htmlspecialchars($row['titre']); ?>">
              <input type="hidden" name="price" value="<?php echo htmlspecialchars($row['prix']); ?>">
              <input type="hidden" name="image" value="<?php echo htmlspecialchars($row['image']); ?>">
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