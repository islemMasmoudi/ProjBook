<!DOCTYPE html>
<html lang="fr">
<?php
session_start();

if (!isset($_SESSION["connecte"])) {
  header("Location: login.php");
  exit();
}
require_once('../classes/Utilisateur.php');

$user = new Utilisateur();
$user->id = $_SESSION['user']['id'];
$user->nom = $_SESSION['user']['nom'];
$user->email = $_SESSION['user']['email'];
$user->pwd = $_SESSION['user']['pwd'];
$user->role = $_SESSION['user']['role'];

$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["modifier"])) {
  $user->modifierProfil($_POST["nom"], $_POST["email"], $_POST["pwd"]);
  $_SESSION['user']['nom'] = $_POST["nom"];
  $_SESSION['user']['email'] = $_POST["email"];
  $_SESSION['user']['pwd'] = $_POST["pwd"];
  $success = "Profil mis à jour avec succès";
}
?>

<head>
  <meta charset="UTF-8">
  <title>Profil - BookStore</title>
  <link rel="stylesheet" href="../style.css">
</head>

<body>
  <header class="header">
    <div class="container nav-container">
        <a href="home.php" class="logo-link">
                <div class="logo">
                    Book<span>Store</span>
                </div>
            </a>
      <nav class="nav">
        <a href="home.php">Accueil</a>
        <a href="livres.php">Liste des livres</a>
        <a href="panier.php">Panier 🛒</a>
        <div class="dropdown">
          <span>Front Office ▾</span>
          <div class="dropdown-menu">
            <a href="profil.php">Profil</a>
            <a href="guest.html">Déconnecter</a>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <section class="form-section">
    <div class="form-box">
      <h2>Mon Profil</h2>
      <form method="POST" action="">
        <input type="text" name="nom" value="<?php echo $user->nom; ?>" required>
        <input type="email" name="email" value="<?php echo $user->email; ?>" required>
        <input type="password" name="pwd" value="<?php echo $user->pwd; ?>" required>
        <button type="submit" name="modifier">Modifier</button>
        <?php if ($success): ?>
          <div class="msg-success"><?= $success ?></div>
        <?php endif; ?>
      </form>
    </div>
  </section>

  <footer class="footer">
    <p>© 2026 BookStore</p>
  </footer>

</body>

</html>