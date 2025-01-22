<?php
require_once "core/module_generique.php";
require_once "controleur_messagerie.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ModuleMessagerie extends ModuleGenerique {
    public function __construct() {
        $this->controleur = new ControleurMessagerie();

        // Debugging : Affichage de l'action
        echo var_dump($_GET['action']);
        
        // Vérification de l'action
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'conversations':
                    // Afficher les conversations de l'utilisateur
                    $this->controleur->afficherConversations();
                    break;
                case 'messages':
                    // Afficher les messages d'une conversation
                    if (isset($_GET['conversation_id'])) {
                        $this->controleur->afficherMessages($_GET['conversation_id']);
                    }
                    break;
                case 'envoyer':
                    // Envoyer un message dans une conversation
                    $this->controleur->envoyerMessage();
                    break;
                case 'creer':
                    // Créer une nouvelle conversation
                    $this->controleur->creerConversation();
                    break;
    
                default:
                    echo "Action non reconnue.";
            }
        } else {
            // Par défaut, afficher les conversations
            $this->controleur->afficherConversations();
        }
    }

    protected function creerControleur() {}
    protected function creerModele() {}
}
?>