<?php
require_once 'modele_ressources.php';

class ControleurRessource {
    private $modele;

    public function __construct() {
        $this->modele = new ModeleRessource();
    }

    public function afficherFormulaire() {
        require_once 'vue_ressources.php';
    }

    public function enregistrerRessource() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'] ?? '';
            $fichier = $_FILES['fichier'] ?? null;

            if ($this->modele->sauvegarder($titre, $fichier)) {
                echo "Ressource enregistrée avec succès !";
            } else {
                echo "Erreur lors de l'enregistrement de la ressource.";
            }
        }
    }
}
?>
