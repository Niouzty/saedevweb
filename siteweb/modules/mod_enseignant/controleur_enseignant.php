<?php
require_once 'modules/mod_enseignant/vue_enseignant.php';

class ControleurEnseignant {
    protected $modele;

    public function __construct() {
        $this->modele = new ModeleEnseignant();
    }

    public function afficherPageAccueil() {
        $vue = new VueEnseignant();
        $vue->afficherPageAcceuil();
    }

    
}
