<?php
class VueMessagerie {
    public function afficherConversations($conversations) {
        ?>
        <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        </head>

        <?php
            Template::afficherNavigationEtudiant();
        ?>
        <div class="container mt-5">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">Groupes</h5>
                        </div>
                        <div class="list-group">
                            <?php if (!empty($conversations)): ?>
                                <?php foreach ($conversations as $conversation): ?>
                                    <button class="list-group-item list-group-item-action" onclick="loadConversation(<?= $conversation['id_conversation']; ?>)">
                                        Groupe <?= htmlspecialchars($conversation['id_conversation']); ?>
                                    </button>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="list-group-item text-center text-muted">
                                    Aucun groupe disponible.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Conversation -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body" id="conversation-container">
                            <p class="text-muted">Sélectionnez un groupe pour afficher la conversation.</p>
                        </div>
                    </div>
                </div>
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <div class="list-group">
            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $message): ?>
                    <div class="list-group-item">
                        <p class="mb-1"><?= htmlspecialchars($message['contenu']); ?></p>
                        <small class="text-muted"><?= htmlspecialchars($message['date_envoi']); ?></small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center text-muted">
                    Aucun message dans cette conversation.
                </div>
            <?php endif; ?>
        </div>
        <?php
    }

    public function afficherFormulaireMessage($conversationId) {
        ?>
        <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        </head>
        <form class="input-group mt-3" method="POST" action="?module=messagerie&action=envoyer">
            <input type="hidden" name="conversation_id" value="<?= $conversationId; ?>">
            <textarea name="content" class="form-control" placeholder="Écrivez un message..." required></textarea>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        <?php
    }
}
?>