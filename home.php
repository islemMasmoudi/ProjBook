<!DOCTYPE html>
<html lang="fr">
<?php
session_start();

if (!isset($_SESSION["connecte"])) {
  header("Location: login.php");
  exit();
}
?>

<head>
  <meta charset="UTF-8">
  <title>BookStore</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
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

  <section class="hero">
    <div class="container">
      <h1>Bienvenue dans notre librairie</h1>
      <p>Découvrez et commandez vos livres en ligne facilement</p>
      <a href="livres.html" class="btn">Explorer les livres</a>
    </div>
  </section>

  <section class="products container">
    <h2>Livres populaires</h2>

    <div class="grid">
      <div class="card">
        <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f">
        <div class="card-body">
          <h3>Atomic Habits</h3>
          <p>James Clear</p>
          <span>30 DT</span>
          <button>Ajouter au panier</button>
        </div>
      </div>

      <div class="card">
        <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794">
        <div class="card-body">
          <h3>The Alchemist</h3>
          <p>Paulo Coelho</p>
          <span>25 DT</span>
          <button>Ajouter au panier</button>
        </div>
      </div>

      <div class="card">
        <img src="https://images.unsplash.com/photo-1495446815901-a7297e633e8d">
        <div class="card-body">
          <h3>Rich Dad Poor Dad</h3>
          <p>Robert Kiyosaki</p>
          <span>28 DT</span>
          <button>Ajouter au panier</button>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer">
    <p>© 2026 BookStore</p>
  </footer>

</body>

</html>