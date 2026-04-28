<?php
session_start();
require_once "pdo.php";

if (isset($_POST['login'])) {
  $login = $_POST["login"];
  $pwd = $_POST["pwd"];

  try {
    $req = $pdo->prepare("SELECT * FROM compte WHERE login = ? AND pwd = ?");
    $req->execute([$login, $pwd]);

    $data = $req->fetch(PDO::FETCH_ASSOC);

    if ($data) {
      $_SESSION["connecte"] = "1";
      $_SESSION["user"] = $data["user"];
      header("Location: home.php");
      exit();
    } else {
      echo "<script>alert('Login/mot de passe incorrect(s)');</script>";
    }

  } catch (PDOException $e) {
    echo "ERREUR : " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
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
        <input type="email" name="login" placeholder="Email" required>
        <input type="password" name="pwd" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
      </form>

      <p class="form-link">Pas de compte ? <a href="register.php">S'inscrire</a></p>
    </div>
  </section>

</body>

</html>