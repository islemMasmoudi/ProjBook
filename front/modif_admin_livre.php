<?php
session_start();
require_once('../classes/Produit.php');

$p = new Produit();

if (!isset($_GET['id'])) {
    header("Location: admin_livres.php");
    exit();
}

$id = $_GET['id'];
$prod = $p->selectLivre($id);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $image = $prod['image']; 

    if (!empty($_FILES["image"]["name"])) {
        $image = "images/" . $_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], "../" . $image);
    }

    $p->modifierProd($id,$_POST["titre"],$_POST["auteur"],$_POST["prix"],$image,$_POST["description"],$_POST["stock"]);

    header("Location: admin_livres.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier Livre</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<header class="header">
    <div class="container nav-container">
      <div class="logo">
        <a href="admin_home.php" class="logo-link">
          Book<span>Store</span> Admin
        </a>
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
<div class="container" style="padding: 50px 0;">

  <div class="admin-form-card">

    <h2>Modifier le livre</h2>

    <div class="book-preview">
      <img src="<?php echo (strpos($prod['image'], 'http') === 0) 
          ? $prod['image'] 
          : '../'.$prod['image']; ?>">
      <div class="book-preview-info">
        <strong><?php echo $prod['titre']; ?></strong>
        <span><?php echo $prod['auteur']; ?></span>
      </div>
    </div>

    <form method="POST" enctype="multipart/form-data" class="admin-form">

      <div class="form-grid">

        <input type="text" name="titre" value="<?php echo $prod['titre']; ?>" required>

        <input type="text" name="auteur" value="<?php echo $prod['auteur']; ?>" required>

        <input type="text" name="prix" value="<?php echo $prod['prix']; ?>" required>

        <input type="number" name="stock" value="<?php echo $prod['stock']; ?>" required>

        <textarea name="description"><?php echo $prod['description']; ?></textarea>

        <input type="file" name="image">

      </div>

      <button type="submit">Modifier</button>

    </form>

  </div>

</div>

</body>
</html>