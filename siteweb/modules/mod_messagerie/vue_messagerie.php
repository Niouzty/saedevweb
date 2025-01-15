<?php
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