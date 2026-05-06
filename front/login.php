<?php
session_start();
require_once('../classes/Utilisateur.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $us = new Utilisateur();
  $user = $us->connecter($_POST["email"], $_POST["pwd"]);
  if ($user) {
    $_SESSION["connecte"] = true;
    $_SESSION["user"] = $user;

    if ($_SESSION["user"]["role"] == "admin") {
      header("Location: admin_home.php");
    } else {
      header("Location: home.php");
    }
    exit();
  } else {
    $message = "Email ou mot de passe incorrect.";
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
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
      <h2>Connexion</h2>

      <form method="POST" action="">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="pwd" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
      </form>

      <p class="form-link">Pas de compte?<a href="register.php">S'inscrire</a></p>
    </div>
  </section>

</body>

</html>