<?php
// ModuleEnseignant.php
require_once 'modules/mod_enseignant/controleur_enseignant.php';
require_once 'modules/mod_enseignant/modele_enseignant.php';
require_once 'modules/mod_enseignant/vue_enseignant.php';
require_once 'modules/mod_enseignant/vue_emploidutempsenseignant.php';
require_once 'modules/mod_enseignant/vue_groupeenseignant.php';
require_once 'modules/mod_enseignant/vue_creergroupeenseignant.php';
require_once 'modules/mod_enseignant/vue_listegroupeenseignant.php';

class ModuleEnseignant extends ModuleGenerique {
    public function __construct() {
        $this->controleur = $this->creerControleur();

        // Vérifie l'action dans l'URL et appelle la méthode appropriée dans le contrôleur
        if (isset($_GET['action']) && method_exists($this->controleur, $_GET['action'])) {
            $action = $_GET['action'];
            $this->controleur->$action(); // Appelle l'action correspondante dans le contrôleur
        } else {
            // Par défaut, afficher la page d'accueil
            $this->controleur->afficherPageAccueil();
        }
    }
    protected function creerControleur() {
        return new ControleurEnseignant();
    }

    protected function creerModele() {
        return new ModeleEnseignant();
    }
}
?>
