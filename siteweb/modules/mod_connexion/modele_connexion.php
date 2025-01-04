<?php
class ModeleConnexion extends ModeleGenerique {
    public function verifierEnseignant($email, $password) {
        $query = $this->bdd->prepare("SELECT * FROM enseignant WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();

        $enseignant = $query->fetch();
        if ($enseignant && password_verify($password, $enseignant['password'])) {
            return $enseignant;
        }

        return false;
    }

    public function verifierEtudiant($email, $password) {
        $query = $this->bdd->prepare("SELECT * FROM etudiant WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();

        $etudiant = $query->fetch();
        if ($etudiant && password_verify($password, $etudiant['password'])) {
            return $etudiant;
        }

        return false;
    }
}
?>
