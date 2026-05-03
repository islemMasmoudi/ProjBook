<?php
session_start();
require_once "pdo.php";

if (!isset($_SESSION["connecte"])) {
  header("Location: login.php");
  exit();
}

$succes = "";
$erreur = "";

$req = $pdo->prepare("SELECT * FROM compte WHERE login = ?");
$req->execute([$_SESSION["login"]]);
$user = $req->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["update"])) {
  $new_login = trim($_POST["login"]);
  $new_pwd = trim($_POST["pwd"]);

  if ($new_login === "") {
    $erreur = "L'email ne peut pas être vide.";
  } else {
    try {
      if ($new_pwd !== "") {
        $stmt = $pdo->prepare("UPDATE compte SET login = ?, pwd = ? WHERE login = ?");
        $stmt->execute([$new_login, $new_pwd, $_SESSION["login"]]);
      } else {
        $stmt = $pdo->prepare("UPDATE compte SET login = ? WHERE login = ?");
        $stmt->execute([$new_login, $_SESSION["login"]]);
      }

      $_SESSION["login"] = $new_login;
      $succes = "Profil mis à jour avec succès.";

      // Refresh data
      $req = $pdo->prepare("SELECT * FROM compte WHERE login = ?");
      $req->execute([$new_login]);
      $user = $req->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
      $erreur = "Erreur : " . $e->getMessage();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Mon Profil</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    .form-section {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: calc(100vh - 140px);
      padding: 2rem;
    }

    .form-box {
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.09);
      padding: 2.5rem;
      width: 100%;
      max-width: 480px;
    }

    .form-box h2 {
      margin-bottom: 1.5rem;
      font-size: 1.4rem;
      color: #2d2d2d;
      text-align: center;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 0.35rem;
      margin-bottom: 1.1rem;
    }

    .form-group label {
      font-size: 0.85rem;
      font-weight: 600;
      color: #555;
    }

    .form-group input {
      padding: 0.65rem 0.9rem;
      border: 1.5px solid #ddd;
      border-radius: 8px;
      font-family: 'Poppins', sans-serif;
      font-size: 0.9rem;
      transition: border 0.2s;
      box-sizing: border-box;
      width: 100%;
    }

    .form-group input:focus {
      border-color: #dac4b6;
      outline: none;
    }

    .form-group small {
      font-size: 0.78rem;
      color: #aaa;
    }

    .form-box button {
      width: 100%;
      padding: 0.75rem;
      background: #dac4b6;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-family: 'Poppins', sans-serif;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
      margin-top: 0.5rem;
    }

    .form-box button:hover {
      background: #dac4b6;
    }

    .msg-succes {
      background: #e8f5e9;
      color: #2e7d32;
      border-radius: 8px;
      padding: 0.6rem 1rem;
      font-size: 0.88rem;
      margin-bottom: 1rem;
    }

    .msg-erreur {
      background: #fdecea;
      color: #c62828;
      border-radius: 8px;
      padding: 0.6rem 1rem;
      font-size: 0.88rem;
      margin-bottom: 1rem;
    }

    .avatar {
      width: 72px;
      height: 72px;
      border-radius: 50%;
      background: #f0e0d0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      margin: 0 auto 1.5rem;
    }
  </style>
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

      <div class="avatar">👤</div>
      <h2>Mon Profil</h2>

      <?php if ($succes): ?>
        <div class="msg-succes"><?= htmlspecialchars($succes) ?></div>
      <?php endif; ?>
      <?php if ($erreur): ?>
        <div class="msg-erreur"><?= htmlspecialchars($erreur) ?></div>
      <?php endif; ?>

      <form method="POST">
        <div class="form-group">
          <label for="login">Email</label>
          <input type="email" name="login" id="login" value="<?= htmlspecialchars($user["login"] ?? "") ?>" required>
        </div>

        <div class="form-group">
          <label for="pwd">Nouveau mot de passe</label>
          <input type="password" name="pwd" id="pwd" placeholder="Laisser vide pour ne pas changer">
          <small>Laisser vide pour conserver le mot de passe actuel.</small>
        </div>

        <button type="submit" name="update">Mettre à jour</button>
      </form>

    </div>
  </section>

  <footer class="footer">
    <p>© 2026 BookStore</p>
  </footer>

</body>

</html>