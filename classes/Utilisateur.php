<?php
class Utilisateur {
    public $id;
    public $nom;
    public $email;
    public $pwd;
    public $role;

    public function inscrire() {
        require_once('../Cnx.php');
        $cnx=new Cnx();
        $pdo=$cnx->CNXbase();
        $req="INSERT INTO utilisateurs (nom,email,pwd,role) VALUES ('$this->nom','$this->email','$this->pwd','$this->role')";
        $pdo->exec($req) or print_r($pdo->errorInfo());
    }

    public function connecter($email,$pwd) {
        require_once('../Cnx.php');
        $cnx=new Cnx();
        $pdo=$cnx->CNXbase();
        $req="SELECT * FROM utilisateurs WHERE email='$email' AND pwd='$pwd'";
        $res=$pdo->query($req);
        $user=$res->fetch(PDO::FETCH_ASSOC);
        if($user){
            return $user;
        }
        return false;
    }

    public function modifierProfil($newNom, $newEmail, $newPwd) {
        require_once('../Cnx.php');
        $cnx=new Cnx();
        $pdo=$cnx->CNXbase();
        $req="UPDATE utilisateurs SET nom='$newNom', email='$newEmail', pwd='$newPwd' WHERE id='$this->id'";
        $pdo->exec($req) or print_r($pdo->errorInfo());

        $this->nom=$newNom;
        $this->email=$newEmail;
        $this->pwd=$newPwd;
    }
}
?>
