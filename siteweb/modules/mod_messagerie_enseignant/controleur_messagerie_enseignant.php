<?php
require_once "modele_messagerie_enseignant.php";
require_once "vue_messagerie_enseignant.php";

class ControleurMessagerieEnseignant {
    protected $modele;

    public function __construct() {
        $this->modele = new ModeleMessagerieEnseignant();
    }

    public function afficherConversations() {
        $vue = new VueMessagerieEnseignant();

        // Récupérer toutes les conversations
        $conversations = $this->modele->getConversations();
        $vue->afficherConversations($conversations);
    }

    public function afficherMessages($conversationId) {
        $vue = new VueMessagerieEnseignant();

        // Récupérer les messages d'une conversation
        $messages = $this->modele->getMessages($conversationId);
        $vue->afficherMessages($messages);
        $vue->afficherFormulaireMessage($conversationId);
    }

    public function envoyerMessage() {
        if (!empty($_POST['conversation_id']) && !empty($_POST['content'])) {
            $conversationId = $_POST['conversation_id'];
            $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');
            $enseignantId = $_SESSION['enseignant_id'];

            $this->modele->sendMessage($conversationId, $enseignantId, $content);

            header("Location: ?module=messagerie_enseignant&action=messages&conversation_id=$conversationId");
            exit;
        }
    }

    public function creerConversation() {
        if (!empty($_POST['id_groupe']) && !empty($_POST['titre'])) {
            $idGroupe = $_POST['id_groupe'];
            $titre = htmlspecialchars($_POST['titre'], ENT_QUOTES, 'UTF-8');

            $conversationId = $this->modele->createConversation($idGroupe, $titre);

            header("Location: ?module=messagerie_enseignant&action=messages&conversation_id=$conversationId");
            exit;<?php
            class VueMessagerie {
                public function afficherConversations($conversations) {
                    ?>
            
                    <head>
                        <link rel="stylesheet" href="./public/css/style.css">
                    </head>
                    <div class="messagerie-body">
                        <div class="messagerie-sidebar">
                            <h2>Groupes</h2>
                            <?php if (!empty($conversations)): ?>
                                <div class="messagerie-group-list">
                                    <?php foreach ($conversations as $conversation): ?>
                                        <div class="messagerie-group-item" onclick="loadConversation(<?= $conversation['id_conversation']; ?>)">
                                            Groupe <?= htmlspecialchars($conversation['id_conversation']); ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="messagerie-no-groups">Aucun groupe disponible.</p>
                            <?php endif; ?>
                        </div>
                        <div class="messagerie-container" id="conversation-container">
                            <p>Sélectionnez un groupe pour afficher la conversation.</p>
                        </div>
                    </div>
            
                    <script>
                        function loadConversation(conversationId) {
                            fetch(`?module=messagerie&action=messages&conversation_id=${conversationId}`)
                                .then(response => response.text())
                                .then(html => {
                                    document.getElementById('conversation-container').innerHTML = html;
                                })
                                .catch(error => console.error('Erreur lors du chargement de la conversation:', error));
                        }
                    </script>
                    <?php
                }
            
                public function afficherMessages($messages) {
                    ?>
                     <head>
                        <link rel="stylesheet" href="./public/css/style.css">
                    </head>
                    <div class="messagerie-message-list">
                        <?php if (!empty($messages)): ?>
                            <?php foreach ($messages as $message): ?>
                                <div class="messagerie-message">
                                    <p class="messagerie-message-content"><?= htmlspecialchars($message['contenu']); ?></p>
                                    <span class="messagerie-message-date"><?= htmlspecialchars($message['date_envoi']); ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="messagerie-no-messages">Aucun message dans cette conversation.</p>
                        <?php endif; ?>
                    </div>
                    <?php
                }
            
                public function afficherFormulaireMessage($conversationId) {
                    ?>
                     <head>
                        <link rel="stylesheet" href="./public/css/style.css">
                    </head>
                    <form class="messagerie-input" method="POST" action="?module=messagerie&action=envoyer">
                        <input type="hidden" name="conversation_id" value="<?= $conversationId; ?>">
                        <textarea name="content" placeholder="Écrivez un message..." required></textarea>
                        <button type="submit" class="messagerie-send-button">Envoyer</button>
                    </form>
                    <?php
                }
            }
            ?>
        }
    }
}
?>
