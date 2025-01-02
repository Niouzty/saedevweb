<?php
 
 require_once 'modules/mod_connexion/controleur_connexion.php';
 require_once 'modules/mod_connexion/modele_connexion.php';

class ModuleConnexion extends ModuleGenerique {
    public function __construct() {
        $this->controleur = $this->creerControleur();

        if (isset($_GET['action']) && $_GET['action'] === 'verifier') {
            $this->controleur->verifierConnexion();
        } else {
            $this->controleur->afficherFormulaire();
        }
    }

    // Implémentation de la méthode abstraite pour créer le contrôleur
    protected function creerControleur() {
        return new ControleurConnexion();
    }

    // Implémentation de la méthode abstraite pour créer le modèle
    protected function creerModele() {
        return new ModeleConnexion(); // Supposons que vous avez une classe ModeleConnexion
    }
}

