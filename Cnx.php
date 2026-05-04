<?php
class Cnx {
    public function CNXbase() {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=proj", 'root', '');
            return $pdo;

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
        }
    }
}
?>