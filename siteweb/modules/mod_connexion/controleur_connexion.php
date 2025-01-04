<?php
require_once 'modules/mod_connexion/vue_connexion.php';

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
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            // Vérification des enseignants
            $enseignant = $this->modele->verifierEnseignant($email, $password);
            if ($enseignant) {
                $_SESSION['user_id'] = $enseignant['id_enseignant'];
                $_SESSION['role'] = 'enseignant'; // Gestion du rôle
                header('Location: /dashboard-enseignant'); // Redirection spécifique
                exit;
            }

            // Vérification des étudiants
            $etudiant = $this->modele->verifierEtudiant($email, $password);
            if ($etudiant) {
                $_SESSION['user_id'] = $etudiant['id_etudiant'];
                $_SESSION['role'] = 'etudiant'; // Gestion du rôle
                header('Location: /dashboard-etudiant'); // Redirection spécifique
                exit;
            }

            // Si aucune correspondance trouvée
            echo "Email ou mot de passe incorrect.";
        } else {
            echo "Veuillez remplir tous les champs.";
        }
    }
}
?>
