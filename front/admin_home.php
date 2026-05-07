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

    <div class="logo">
      Book<span>Store</span> Admin
    </div>

    <nav class="nav">
      <a href="admin_home.php">Accueil</a>
      <a href="admin_livres.php">Livres</a>
      <a href="déconnecter.php" class="logout-btn">
        Déconnecter
      </a>
    </nav>

  </div>
</header>

  <section class="admin-hero container">

  <div class="admin-hero-content">
    <h1>Tableau de bord Administrateur</h1>

    <p>
      Gérez les livres, surveillez le catalogue
      et administrez votre plateforme BookStore.
    </p>

    <a href="admin_livres.php" class="btn">
      Gérer les livres
    </a>
  </div>

</section>

  <section class="dashboard container">

  <h2>Actions rapides</h2>

  <div class="dashboard-grid">

    <div class="dashboard-card">
      <div class="dashboard-icon">📚</div>

      <h3>Gestion des livres</h3>

      <p>
        Ajouter ou supprimer
        des livres du catalogue.
      </p>

      <a href="admin_livres.php" class="btn">
        Ouvrir
      </a>
    </div>

  </div>

</section>

  <footer class="footer">
    <p>© 2026 BookStore - Admin</p>
  </footer>
</body>
</html>
