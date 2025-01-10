<?php
require_once 'modules/mod_etudiant/vue_etudiant.php';

class ControleurEtudiant {
    protected $modele;

    public function __construct() {
        $this->modele = new ModeleEtudiant();
    }

    public function afficherPageAccueil() {
        $vue = new VueEtudiant();
        $vue->afficherPageAcceuil();
    }

    
}
