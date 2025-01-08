<?php
require_once "modele_messagerie.php";
require_once "vue_messagerie.php";
session_start();
class ControleurMessagerie {
    protected $modele;
    
    public function __construct() {
        $this->modele = new ModeleMessagerie();
    }

    // Récupérer les groupes pour un utilisateur connecté
    public function afficherGroupes() {
        $vue = new VueMessagerie();
        $groupes = $this->modele->getGroupes($_SESSION['user_id']);
        $vue->afficherGroupes($groupes);
    }

    // Récupérer et afficher les messages d'un groupe
    public function afficherMessages($groupId) {
        $vue = new VueMessagerie();
        $messages = $this->modele->getMessages($groupId);
        $vue->afficherMessages($messages);
        $vue->afficherFormulaireMessage($groupId);
    }

    // Envoyer un message
    public function envoyerMessage() {
        if (!empty($_POST['group_id']) && !empty($_POST['content'])) {
            $groupId = $_POST['group_id'];
            $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');
            $userId = $_SESSION['user_id'];

            $this->modele->sendMessage($groupId, $userId, $content);
            header("Location: ?module=messagerie&action=messages&group_id=$groupId");
            exit;
        }
    }
}

