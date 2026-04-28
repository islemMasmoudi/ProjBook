<!DOCTYPE html>
<html lang="fr">
<?php
session_start();
require_once "pdo.php";

if (!isset($_SESSION["connecte"])) {
  header("Location: login.php");
  exit();
}

$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $login = $_POST["login"];
  $pwd = $_POST["pwd"];

  try {
    $req = $pdo->prepare("INSERT INTO compte (login , pwd) VALUES (?,?)");
    $req->execute([$login, $pwd]);

    $msg = "compte crée avec succes";

  } catch (PDOException $e) {
    $msg = "Erreur : " . $e->getMessage();
  }
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
        <a href="index.html">Accueil</a>
        <a href="produits.html">Liste des Produits</a>

        <div class="dropdown">
          <span>Front Office ▾</span>
          <div class="dropdown-menu">
            <a href="login.html">Connexion</a>
            <a href="register.html">Inscription</a>
            <a href="commande.html">Commander</a>
            <a href="profil.html">Profil</a>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <section class="form-section">
    <div class="form-box">
      <h2>Inscription</h2>

      <form method="POST" action="">
        <input type="text" name="login" placeholder="Login">
        <input type="password" name="pwd" placeholder="Mot de passe">
        <button>S'inscrire</button>
      </form>

    </div>
  </section>

</body>

</html>