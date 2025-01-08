<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'modele_messagerie.php';
require_once 'controleur_messagerie.php';
require_once 'vue_messagerie.php';


class ModuleMessagerie extends ModuleGenerique {
    public function __construct() {
        $this->controleur = new ControleurMessagerie();

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
}

