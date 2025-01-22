<?php
require_once "modele_projet.php";
require_once "vue_projet.php";
session_start();

class ControleurProjet {
    protected $modele;

    public function __construct() {
        $this->modele = new ModeleProjet();
    }
    
    public function afficherProjets() {
        $vue = new VueProjet();
        $projets = $this->modele->getProjets();
        $vue->afficherProjets($projets);
    }

    public function afficherRendus($projetId) {
        $vue = new VueProjet();

        $rendus = $this->modele->getRendus($projetId);
        $vue->afficherRendus($rendus, $projetId);
    }

    public function deposerRendu($projetId) {
        var_dump($projetId);
        if ($projetId && $_SESSION['user_id']) {
            $this->modele->deposerRendu($projetId, $_SESSION['user_id']);
        } else {
            echo "Erreur : Projet ou utilisateur non défini.";
        }
    }
    
    /*
    public function deposerRendu(){
        $this->modele->deposerRendu();
    }*/

}