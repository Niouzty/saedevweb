<?php
 
 require_once 'modules/mod_enseignant/controleur_enseignant.php';
 require_once 'modules/mod_enseignant/modele_enseignant.php';

class ModuleEnseignant extends ModuleGenerique {
    public function __construct() {
        $this->controleur = $this->creerControleur();
        $this->controleur->afficherPageAccueil();
    }

    // Implémentation de la méthode abstraite pour créer le contrôleur
    protected function creerControleur() {
        return new ControleurEnseignant();
    }

    // Implémentation de la méthode abstraite pour créer le modèle
    protected function creerModele() {
        return new ModeleEnseignant(); // Supposons que vous avez une classe ModeleConnexion
    }
}

