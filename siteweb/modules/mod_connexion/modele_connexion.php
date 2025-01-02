<?php
class ModeleConnexion extends ModeleGenerique {
    public function verifierUtilisateur($username, $password) {
        $query = $this->bdd->prepare("SELECT * FROM users WHERE username = :username");
        $query->bindParam(':username', $username);
        $query->execute();

        $user = $query->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
}
?>

