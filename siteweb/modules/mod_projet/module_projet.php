<?php
require_once "core/module_generique.php";
require_once 'controleur_projet.php';
class ModuleProjet extends ModuleGenerique{
    
    public function construct() {
    
        $controleur = new ControleurProjet();
        echo var_dump($_GET['action']);

        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'accueil':
                    $this->controleur->afficherProjet();
                    break;
                case 'enregistrerRessource':
                    $this->controleur->enregistrerRessource();
                    break;
                default:
                    echo "Action non reconnue.";
            }
        } else {
            echo "Erreur : Action '$action' introuvable.";
        }
    }
    protected function creerControleur(){}
    protected function creerModele(){}
    
}
?>
