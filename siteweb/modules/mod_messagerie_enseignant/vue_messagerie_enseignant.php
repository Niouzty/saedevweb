<?php
class VueMessagerieEnseignant {
    public function afficherConversations($conversations) {
        ?>
        <div class="messagerie-body">
            <h2>Toutes les Conversations</h2>
            <div class="messagerie-group-list">
                <?php foreach ($conversations as $conversation): ?>
                    <div class="messagerie-group-item">
                        <a href="?module=messagerie_enseignant&action=messages&conversation_id=<?= $conversation['id_conversation']; ?>">
                            <?= htmlspecialchars($conversation['titre']); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }

    public function afficherMessages($messages) {
        ?>
        <div class="messagerie-message-list">
            <?php foreach ($messages as $message): ?>
                <div class="messagerie-message">
                    <p class="messagerie-message-content"><?= htmlspecialchars($message['contenu']); ?></p>
                    <small>
                        <?= $message['enseignant_nom'] ?? $message['etudiant_nom']; ?> - 
                        <?= htmlspecialchars($message['date_envoi']); ?>
                    </small>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }

    public function afficherFormulaireMessage($conversationId) {
        ?>
        <form method="POST" action="?module=messagerie_enseignant&action=envoyer">
            <input type="hidden" name="conversation_id" value="<?= $conversationId; ?>">
            <textarea name="content" placeholder="Écrivez un message..." required></textarea>
            <button type="submit">Envoyer</button>
        </form>
        <?php
    }
}
?>
