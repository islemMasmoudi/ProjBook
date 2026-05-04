<?php
session_start();

if (!isset($_SESSION["connecte"]) || $_SESSION['user']['role'] != 'admin') {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Admin - BookStore</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
</head>

<body>
  <header class="header">
    <div class="container nav-container">
      <div class="logo">BookStore - Admin</div>
      <a href="déconnecter.php">Déconnecter</a>
      
    </div>
  </header>

  <section class="hero">
    <div class="container">
      <h1>Bienvenue dans l'espace administrateur</h1>
      <p>Gérez les livres et les utilisateurs de la librairie.</p>
    </div>
  </section>

  <section class="container">
    <div class="grid">
      <div class="card">
        <p style="padding: 50px; color: 'blue'">Ajouter ou supprimer des livres.</p>
        <a href="admin_livres.php" class="btn">Gérer les livres</a>
      </div>
      
  </section>

  <footer class="footer">
    <p>© 2026 BookStore - Admin</p>
  </footer>
</body>
</html>
