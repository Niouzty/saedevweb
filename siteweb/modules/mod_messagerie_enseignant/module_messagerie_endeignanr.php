<?php
require_once "controleur_messagerie_enseignant.php";

class ModuleMessagerieEnseignant extends ModuleGenerique {
    public function __construct() {
        $this->controleur = new ControleurMessagerieEnseignant();

        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'conversations':
                    $this->controleur->afficherConversations();
                    break;
                case 'messages':
                    if (isset($_GET['conversation_id'])) {
                        $this->controleur->afficherMessages($_GET['conversation_id']);
                    }
                    break;
                case 'envoyer':
                    $this->controleur->envoyerMessage();
                    break;
                case 'creer':
                    $this->controleur->creerConversation();
                    break;
                default:
                    echo "Action non reconnue.";
            }
        } else {
            $this->controleur->afficherConversations();
        }
    }
}
?>
