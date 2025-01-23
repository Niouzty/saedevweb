<?php
 
 require_once 'modules/mod_etudiant/controleur_etudiant.php';
 require_once 'modules/mod_etudiant/modele_etudiant.php';

class ModuleEtudiant extends ModuleGenerique {
    public function __construct() {
        $this->controleur = $this->creerControleur();
        $this->controleur->afficherPageAccueil();
    }

    // Implémentation de la méthode abstraite pour créer le contrôleur
    protected function creerControleur() {
        return new ControleurEtudiant();
    }

    // Implémentation de la méthode abstraite pour créer le modèle
    protected function creerModele() {
        return new ModeleEtudiant(); // Supposons que vous avez une classe ModeleConnexion
    }
}

