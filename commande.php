<?php
session_start();
if (!isset($_SESSION["connecte"])) {
  header("Location: login.php");
  exit();
}

if (!isset($_SESSION["panier"])) {
  $_SESSION["panier"] = [];
}

// Book catalog
$catalogue = [
  "Atomic Habits" => ["price" => 30, "image" => "https://images.unsplash.com/photo-1544947950-fa07a98d237f"],
  "The Alchemist" => ["price" => 25, "image" => "https://images.unsplash.com/photo-1512820790803-83ca734da794"],
  "Rich Dad Poor Dad" => ["price" => 28, "image" => "https://images.unsplash.com/photo-1495446815901-a7297e633e8d"],
  "Think and Grow Rich" => ["price" => 27, "image" => "https://images.unsplash.com/photo-1524995997946-a1c2e315a42f"],
  "Deep Work" => ["price" => 32, "image" => "https://images.unsplash.com/photo-1519681393784-d120267933ba"],
  "Start With Why" => ["price" => 29, "image" => "https://images.unsplash.com/photo-1516979187457-637abb4f9353"],
];

$erreur = "";
$succes = "";

if (isset($_POST["valider"])) {
  $nom_livre = trim($_POST["nom_livre"]);
  $quantite = (int) $_POST["quantite"];

  if ($nom_livre === "" || $quantite < 1) {
    $erreur = "Veuillez remplir tous les champs correctement.";
  } elseif (!isset($catalogue[$nom_livre])) {
    $erreur = "Livre introuvable dans le catalogue.";
  } else {
    $book = $catalogue[$nom_livre];
    for ($i = 0; $i < $quantite; $i++) {
      $_SESSION["panier"][] = [
        "title" => $nom_livre,
        "price" => $book["price"],
        "image" => $book["image"]
      ];
    }
    header("Location: panier.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Commander</title>
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
    }

    .form-box select,
    .form-box input[type="number"] {
      width: 100%;
      padding: 0.65rem 0.9rem;
      border: 1.5px solid #ddd;
      border-radius: 8px;
      font-family: 'Poppins', sans-serif;
      font-size: 0.9rem;
      margin-bottom: 1rem;
      box-sizing: border-box;
      transition: border 0.2s;
    }

    .form-box select:focus,
    .form-box input[type="number"]:focus {
      border-color: #dac4b6;
      outline: none;
    }

    .form-box label {
      display: block;
      font-size: 0.85rem;
      font-weight: 600;
      color: #555;
      margin-bottom: 0.35rem;
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

    .msg-erreur {
      background: #fdecea;
      color: #c62828;
      border-radius: 8px;
      padding: 0.6rem 1rem;
      font-size: 0.88rem;
      margin-bottom: 1rem;
    }

    .book-preview {
      display: flex;
      align-items: center;
      gap: 1rem;
      background: #fdf6f0;
      border-radius: 10px;
      padding: 0.75rem 1rem;
      margin-bottom: 1rem;
      min-height: 70px;
    }

    .book-preview img {
      width: 48px;
      height: 64px;
      object-fit: cover;
      border-radius: 4px;
    }

    .book-preview-info strong {
      display: block;
      font-size: 0.9rem;
      color: #2d2d2d;
    }

    .book-preview-info span {
      font-size: 0.85rem;
      color: #dac4b6;
      font-weight: 600;
    }
  </style>
</head>

<body>

  <header class="header">
    <div class="container nav-container">
      <div class="logo">Book<span>Store</span></div>
      <nav class="nav">
        <a href="front/home.php">Accueil</a>
        <a href="front/livres.php">Liste des livres</a>
        <a href="panier.php">Panier 🛒</a>
        <div class="dropdown">
          <span>Front Office ▾</span>
          <div class="dropdown-menu">
            <a href="commande.php">Commander</a>
            <a href="front/profil.php">Profil</a>
            <a href="déconnecter.php">Déconnecter</a>

          </div>
        </div>
      </nav>
    </div>
  </header>

  <section class="form-section">
    <div class="form-box">
      <h2>Commander un livre</h2>

      <?php if ($erreur): ?>
        <div class="msg-erreur"><?= htmlspecialchars($erreur) ?></div>
      <?php endif; ?>

      <!-- Book preview shown via JS -->
      <div class="book-preview" id="preview" style="display:none;">
        <img id="preview-img" src="" alt="">
        <div class="book-preview-info">
          <strong id="preview-title"></strong>
          <span id="preview-price"></span>
        </div>
      </div>

      <form method="POST">
        <label for="nom_livre">Nom du livre</label>
        <select name="nom_livre" id="nom_livre" required>
          <option value="">-- Choisir un livre --</option>
          <?php foreach ($catalogue as $titre => $info): ?>
            <option value="<?= htmlspecialchars($titre) ?>" data-price="<?= $info['price'] ?>"
              data-image="<?= htmlspecialchars($info['image']) ?>" <?= (isset($_POST["nom_livre"]) && $_POST["nom_livre"] === $titre) ? "selected" : "" ?>>
              <?= htmlspecialchars($titre) ?> — <?= $info['price'] ?> DT
            </option>
          <?php endforeach; ?>
        </select>

        <label for="quantite">Quantité</label>
        <input type="number" name="quantite" id="quantite" min="1" max="10"
          value="<?= isset($_POST["quantite"]) ? (int) $_POST["quantite"] : 1 ?>" required>

        <button type="submit" name="valider">Valider commande</button>
      </form>
    </div>
  </section>

  <footer class="footer">
    <p>© 2026 BookStore</p>
  </footer>

  <script>
    const select = document.getElementById("nom_livre");
    const preview = document.getElementById("preview");
    const previewImg = document.getElementById("preview-img");
    const previewTitle = document.getElementById("preview-title");
    const previewPrice = document.getElementById("preview-price");

    function updatePreview() {
      const opt = select.options[select.selectedIndex];
      if (opt.value) {
        previewImg.src = opt.dataset.image;
        previewTitle.textContent = opt.value;
        previewPrice.textContent = opt.dataset.price + " DT";
        preview.style.display = "flex";
      } else {
        preview.style.display = "none";
      }
    }

    select.addEventListener("change", updatePreview);
    updatePreview(); 
  </script>

</body>

</html>