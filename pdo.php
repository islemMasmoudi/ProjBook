<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=proj", 'root', '');

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
}
?>