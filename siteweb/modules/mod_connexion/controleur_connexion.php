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
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            $utilisateur = $this->modele->verifierUtilisateur($username, $password);
            if ($utilisateur) {
                $_SESSION['user_id'] = $utilisateur['id']; // Exemple de gestion de session
                header('Location: /dashboard');
                exit;
            } else {
                echo "Identifiant ou mot de passe incorrect.";
            }
        } else {
            echo "Veuillez remplir tous les champs.";
        }
    }
}
?>

