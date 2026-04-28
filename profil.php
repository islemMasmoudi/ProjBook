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

  <section class="form-section">
    <div class="form-box">
      <h2>Mon Profil</h2>

      <form>
        <input type="text" placeholder="Nom">
        <input type="email" placeholder="Email">
        <button>Mettre à jour</button>
      </form>

    </div>
  </section>
</body>

</html>