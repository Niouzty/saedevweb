<?php
require_once "modele_messagerie.php";
require_once "vue_messagerie.php";
session_start();

class ControleurMessagerie {
    protected $modele;

    public function __construct() {
        $this->modele = new ModeleMessagerie();
    }

    public function afficherConversations() {
        $vue = new VueMessagerie();

        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit;
        }

        $conversations = $this->modele->getConversations($_SESSION['user_id']);
        $vue->afficherConversations($conversations);
    }

    public function afficherMessages($conversationId) {
        $vue = new VueMessagerie();
        $messages = $this->modele->getMessages($conversationId);
        $vue->afficherMessages($messages);
        $vue->afficherFormulaireMessage($conversationId);
    }

    public function envoyerMessage() {
        if (!empty($_POST['conversation_id']) && !empty($_POST['content'])) {
            $conversationId = $_POST['conversation_id'];
            $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');
            $userId = $_SESSION['user_id'];

            $this->modele->sendMessage($conversationId, $userId, $content);

            header("Location: ?module=messagerie&action=messages&conversation_id=$conversationId");
            exit;
        }
    }

    public function creerConversation() {
        if (!empty($_POST['other_user_id']) && isset($_POST['is_enseignant'])) {
            $otherUserId = $_POST['other_user_id'];
            $isEnseignant = (int)$_POST['is_enseignant'];

            $conversationId = $this->modele->createConversation($_SESSION['user_id'], $otherUserId, $isEnseignant);

            header("Location: ?module=messagerie&action=messages&conversation_id=$conversationId");
            exit;
        }
    }
}