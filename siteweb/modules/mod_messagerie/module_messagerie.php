<?php
require_once 'modules/mod_messagerie/vue_messagerie.php';
require_once 'modules/mod_messagerie/modele_messagerie.php';
require_once 'modules/mod_messagerie/controleur_messagerie.php';

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

