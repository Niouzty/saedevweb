<?php
require_once 'modules/mod_notes_ens/controleur_noteenseignant.php';
require_once 'core/module_generique.php';


    class ModuleNoteEnseignant extends ModuleGenerique {

        public function __construct() {
            $this->controleur = $this->creerControleur();

            // Vérifie l'action dans l'URL et appelle la méthode appropriée dans le contrôleur
            if (isset($_GET['action']) && method_exists($this->controleur, $_GET['action'])) {
                $action = $_GET['action'];
                $this->controleur->$action(); // Appelle l'action correspondante dans le contrôleur
            } else {
                // Action par défaut : redirige vers la liste des notes ou une page appropriée
                $this->controleur->afficherNotesEtudiant();
            }
        }

        // Crée une instance du contrôleur pour gérer les actions
        protected function creerControleur() {
            return new ControleurNoteEnseignant();
        }

        protected function creerModele() {
            return new ModeleEnseignant();
        }

    }
?>
