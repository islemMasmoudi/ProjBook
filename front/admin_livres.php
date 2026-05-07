<?php
session_start();

if (!isset($_SESSION["connecte"]) || $_SESSION['user']['role'] !='admin') {
  header("Location: login.php");
  exit();
}

require_once('../classes/Produit.php');
$p=new Produit();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ajouter"])) {
    $p->ajouterProd($_POST["titre"], $_POST["auteur"], $_POST["prix"], $_POST["image"], $_POST["description"]);
    header("Location: admin_livres.php");
    exit();
}
if (isset($_GET["delete"])) {
    $p->supprimeProd($_GET["delete"]);
    header("Location: admin_livres.php");
    exit();
}

$res=$p->listerProd(); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Admin - Livres</title>
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
  <section class="admin-top container">

  <div class="admin-title">
    <h1>Gestion des livres</h1>

    <p>
      Ajoutez et supprimez les livres du catalogue.
    </p>
  </div>

</section>

  

  <section class="admin-form-section container">
  <div class="admin-form-card">
    <h2>Ajouter un livre</h2>
    <form method="POST" action="" class="admin-form">
      <div class="form-grid">
        <input type="text" name="titre" placeholder="Titre" required>
        <input type="text" name="auteur" placeholder="Auteur" required>
        <input type="text" name="prix" placeholder="Prix" required>
        <input type="text" name="image" placeholder="URL image" required>
        <textarea name="description" placeholder="Description"></textarea>
        <button type="submit" name="ajouter">Ajouter</button>
        </div>
      </form>
    </div>
  </section>

  <section class="products container">
    <h2 class="section-title">Catalogue des livres</h2>
    <div class="grid">
      <?php foreach ($res as $row): ?>
        <div class="card">
          <img src="<?php echo $row['image']; ?>">
          <div class="card-body">
            <h3><?php echo $row['titre']; ?></h3>
            <p><?php echo $row['auteur']; ?></p>
            <span><?php echo $row['prix']; ?> DT</span>
            <a href="admin_livres.php?delete=<?php echo $row['id']; ?>" class="delete-btn">Supprimer</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</body>
</html>