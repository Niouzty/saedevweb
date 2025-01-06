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
        // Vérification si l'email et le mot de passe sont présents
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            // Vérification pour les deux rôles (enseignant ou étudiant)
            $utilisateur = $this->modele->verifierUtilisateur($email, $password);
            if ($utilisateur) {
                // Démarrer une session et régénérer l'ID pour plus de sécurité
                session_start();
                session_regenerate_id(true);

                // Stocker l'ID de l'utilisateur et son rôle dans la session
                $_SESSION['user_id'] = $utilisateur['id'];
                $_SESSION['role'] = $utilisateur['role'];

                // Redirection en fonction du rôle
                if ($utilisateur['role'] === 'enseignant') {
                    header('Location: modules/mod_utilisateur/vue_utilisateur-enseignant.php'); // Page d'accueil de l'enseignant
                } else {
                    header('Location: modules/mod_utilisateur/vue_utilisateur-etudiant.php'); // Page d'accueil de l'étudiant
                }
                exit; // S'assurer qu'aucun autre code ne soit exécuté après la redirection
            }

            // Si l'utilisateur n'est pas trouvé ou les identifiants sont incorrects
            echo htmlspecialchars("Identifiant ou mot de passe incorrect.", ENT_QUOTES, 'UTF-8');
        } else {
            // Si les champs ne sont pas remplis
            echo htmlspecialchars("Veuillez remplir tous les champs.", ENT_QUOTES, 'UTF-8');
        }
    }
}
