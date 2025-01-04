<?php

class ControleurConnexion {
    protected $modele;

    public function __construct() {
        $this->modele = new ModeleConnexion();
    }

    public function afficherFormulaire() {
        $vue = new VueConnexion();
        $vue->afficherFormulaire();
    }

    public function verifierConnexion() {
        // Vérifie que les données sont présentes
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password']; // Pas de FILTER_SANITIZE_STRING car non recommandé

            // Vérification des enseignants
            $enseignant = $this->modele->verifierEnseignant($email, $password);
            if ($enseignant) {
                $_SESSION['user_id'] = $enseignant['id_enseignant'];
                $_SESSION['role'] = 'enseignant';
                header('Location: /dashboard-enseignant');
                exit;
            }

            // Vérification des étudiants
            $etudiant = $this->modele->verifierEtudiant($email, $password);
            if ($etudiant) {
                $_SESSION['user_id'] = $etudiant['id_etudiant'];
                $_SESSION['role'] = 'etudiant';
                header('Location: /dashboard-etudiant');
                exit;
            }

            // Message d'erreur si utilisateur non trouvé
            echo "Identifiant ou mot de passe incorrect.";
        } else {
            // Message d'erreur si champs manquants
            echo "Veuillez remplir tous les champs.";
        }
    }
}
