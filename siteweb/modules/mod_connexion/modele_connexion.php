<?php

class ModeleConnexion extends ModeleGenerique {
    public function verifierUtilisateur($email, $password) {
    // Recherche dans les enseignants
    $query = $this->bdd->prepare("SELECT id_enseignant AS id, 'enseignant' AS role, password 
                                   FROM enseignant 
                                   WHERE email = :email");
    $query->bindParam(':email', $email);
    $query->execute();
    $enseignant = $query->fetch();

    if ($enseignant) {
        if (password_verify($password, $enseignant['password'])) {
            return $enseignant;
        } else {
            echo "Mot de passe incorrect pour enseignant.";
        }
    } else {
        echo "Aucun enseignant trouvé.";
    }

    // Recherche dans les étudiants
    $query = $this->bdd->prepare("SELECT id_etudiant AS id, 'etudiant' AS role, password 
                                   FROM etudiant 
                                   WHERE email = :email");
    $query->bindParam(':email', $email);
    $query->execute();
    $etudiant = $query->fetch();

    if ($etudiant) {
        if (password_verify($password, $etudiant['password'])) {
            return $etudiant;
        } else {
            echo "Mot de passe incorrect pour étudiant.";
        }
    } else {
        echo "Aucun étudiant trouvé.";
    }

    // Aucun utilisateur trouvé
    return false;
}


}
