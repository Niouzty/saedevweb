<?php
require_once "core/module_generique.php";
require_once "controleur_messagerie.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ModuleMessagerie extends ModuleGenerique {
    public function __construct() {
        $this->controleur = new ControleurMessagerie();
        echo vard_dump($_GET['action'));
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'groupes':
                    $this->controleur->afficherGroupes();
                    break;
                case 'messages':
                    if (isset($_GET['group_id'])) {
                        $this->controleur->afficherMessages($_GET['group_id']);
                    }
                    break;
                case 'envoyer':
                    $this->controleur->envoyerMessage();
                    break;
                default:
                    echo "Action non reconnue.";
            }
        } else {
            $this->controleur->afficherGroupes();
        }
    }
protected function creerControleur(){}
protected function creerModele(){}
}

