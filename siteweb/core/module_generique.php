<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

abstract class ModuleGenerique {
    protected $controleur;
    protected $modele;

    public function __construct() {
        $this->controleur = $this->creerControleur();
        $this->modele = $this->creerModele();
        $this->afficher();
    }

    /**
     * Méthode abstraite pour créer un contrôleur.
     * Chaque module doit implémenter cette méthode.
     */
    abstract protected function creerControleur();

    /**
     * Méthode abstraite pour créer un modèle.
     * Chaque module doit implémenter cette méthode.
     */
    abstract protected function creerModele();

    /**
     * Méthode pour afficher le module.
     * Peut être surchargée par les modules spécifiques.
     */
    public function afficher() {
        echo "Affichage du module...";
    }
}
?>

