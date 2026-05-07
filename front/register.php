<?php
session_start();
require_once('../classes/Utilisateur.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if ($_POST["pwd"]!=$_POST["pwd2"]) {
    $message="Les mots de passe ne correspondent pas.";
  } else {
    $us = new Utilisateur();
    $us->nom = $_POST["nom"];
    $us->email = $_POST["email"];
    $us->pwd = $_POST["pwd"];
    $us->role = "user";
    $us->inscrire();
    header("Location: login.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Inscription - BookStore</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
</head>

<body>
  <header class="header">
    <div class="container nav-container">
      <div class="logo">Book<span>Store</span></div>
    </div>
  </header>
  <section class="form-section">
    <div class="form-box">
      <h2>Inscription</h2>

      <?php if (isset($message)) : ?>
        <p style="color: red; margin-bottom: 15px; font-weight: 500;">
          <?php echo $message; ?>
        </p>
      <?php endif; ?>

      <form method="POST" action="">
        <input type="text" name="nom" placeholder="Nom complet" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="pwd" placeholder="Mot de passe" required>
        <input type="password" name="pwd2" placeholder="Confirmer le mot de passe" required>
        <button type="submit">S'inscrire</button>
      </form>

      <p class="form-link">Déjà inscrit ? <a href="login.php">Se connecter</a></p>
    </div>
  </section>

</body>

</html>