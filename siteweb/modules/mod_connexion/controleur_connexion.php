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
        $password = $_POST['password'];

        // Vérification pour les deux rôles
        $utilisateur = $this->modele->verifierUtilisateur($email, $password);
        if ($utilisateur) {
            session_start();
            session_regenerate_id(true);
            $_SESSION['user_id'] = $utilisateur['id'];
            $_SESSION['role'] = $utilisateur['role'];

            $redirect = ($utilisateur['role'] === 'enseignant') ? '/dashboard-enseignant' : '/dashboard-etudiant';
            header("Location: {$redirect}");
            exit;
        }

        // Utilisateur non trouvé
        echo htmlspecialchars("Identifiant ou mot de passe incorrect.", ENT_QUOTES, 'UTF-8');
    } else {
        echo htmlspecialchars("Veuillez remplir tous les champs.", ENT_QUOTES, 'UTF-8');
    }
}

}
