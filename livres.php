<?php
session_start();

if (!isset($_SESSION["connecte"])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Liste des livres</title>

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

  <section class="products container">
    <h2>Liste des livres</h2>

    <div class="grid">

      <div class="card">
        <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f">
        <div class="card-body">
          <h3>Atomic Habits</h3>
          <p>James Clear</p>
          <span>30 DT</span>

          <form method="POST" action="panier.php">
            <input type="hidden" name="title" value="Atomic Habits">
            <input type="hidden" name="price" value="30">
            <button type="submit" name="add">Ajouter au panier</button>
          </form>

        </div>
      </div>

      <div class="card">
        <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794">
        <div class="card-body">
          <h3>The Alchemist</h3>
          <p>Paulo Coelho</p>
          <span>25 DT</span>

          <form method="POST" action="panier.php">
            <input type="hidden" name="title" value="The Alchemist">
            <input type="hidden" name="price" value="25">
            <button type="submit" name="add">Ajouter au panier</button>
          </form>

        </div>
      </div>

      <div class="card">
        <img src="https://images.unsplash.com/photo-1495446815901-a7297e633e8d">
        <div class="card-body">
          <h3>Rich Dad Poor Dad</h3>
          <p>Robert Kiyosaki</p>
          <span>28 DT</span>

          <form method="POST" action="panier.php">
            <input type="hidden" name="title" value="Rich Dad Poor Dad">
            <input type="hidden" name="price" value="28">
            <button type="submit" name="add">Ajouter au panier</button>
          </form>

        </div>
      </div>

      <div class="card">
        <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f">
        <div class="card-body">
          <h3>Think and Grow Rich</h3>
          <p>Napoleon Hill</p>
          <span>27 DT</span>

          <form method="POST" action="panier.php">
            <input type="hidden" name="title" value="Think and Grow Rich">
            <input type="hidden" name="price" value="27">
            <button type="submit" name="add">Ajouter au panier</button>
          </form>

        </div>
      </div>

      <div class="card">
        <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba">
        <div class="card-body">
          <h3>Deep Work</h3>
          <p>Cal Newport</p>
          <span>32 DT</span>

          <form method="POST" action="panier.php">
            <input type="hidden" name="title" value="Deep Work">
            <input type="hidden" name="price" value="32">
            <button type="submit" name="add">Ajouter au panier</button>
          </form>

        </div>
      </div>

      <div class="card">
        <img src="https://images.unsplash.com/photo-1516979187457-637abb4f9353">
        <div class="card-body">
          <h3>Start With Why</h3>
          <p>Simon Sinek</p>
          <span>29 DT</span>

          <form method="POST" action="panier.php">

            <input type="hidden" name="title" value="Atomic Habits">
            <input type="hidden" name="price" value="30">
            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1544947950-fa07a98d237f">

            <button type="submit" name="add">Ajouter au panier</button>

          </form>

        </div>
      </div>

    </div>
  </section>

  <footer class="footer">
    <p>© 2026 BookStore</p>
  </footer>

</body>

</html>