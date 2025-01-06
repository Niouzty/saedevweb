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

if (!$enseignant) {
    echo "Aucun enseignant trouvé avec cet email.";
} else {
    echo "Enseignant trouvé : " . print_r($enseignant, true);
    return $enseignant;
}

// Faites la même chose pour les étudiants
$query = $this->bdd->prepare("SELECT id_etudiant AS id, 'etudiant' AS role, password 
                               FROM etudiant 
                               WHERE email = :email");
$query->bindParam(':email', $email);
$query->execute();
$etudiant = $query->fetch();

if (!$etudiant) {
    echo "Aucun étudiant trouvé avec cet email.";
} else {
    echo "Étudiant trouvé : " . print_r($etudiant, true);
}
}


}
