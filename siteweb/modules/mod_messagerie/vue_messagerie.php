<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class VueMessagerie extends VueGenerique {
    // Afficher la liste des groupes
    public function afficherGroupes($groupes) {
        echo '<div class="messagerie-sidebar">';
        echo '<div class="messagerie-group-list">';
        foreach ($groupes as $groupe) {
            echo "
            <div class='messagerie-group-item' data-id='{$groupe['id']}'>
                <img src='{$groupe['image']}' alt='Image de groupe'>
                <div class='messagerie-group-name'>{$groupe['name']}</div>
                <div class='messagerie-group-last-message'>{$groupe['last_message']}</div>
            </div>";
        }
        echo '</div>';
        echo '</div>';
    }

    // Afficher les messages d'un groupe
    public function afficherMessages($messages) {
        echo '<div class="messagerie-container">';
        echo '<div class="messagerie-header">Messages</div>';
        echo '<div class="messagerie-body">';
        foreach ($messages as $message) {
            $isUser = $message['is_user']; // Boolean pour différencier l'utilisateur et les autres
            $class = $isUser ? 'messagerie-message messagerie-user-message' : 'messagerie-message';
            echo "
            <div class='{$class}'>
                <div class='messagerie-message-content'>
                    <strong>{$message['name']}:</strong> {$message['content']}
                </div>
                <span class='messagerie-message-date'>{$message['created_at']}</span>
            </div>";
        }
        echo '</div>'; // Ferme le corps des messages
    }

    // Afficher le champ pour envoyer un message
    public function afficherFormulaireMessage($groupId) {
        echo "
        <div class='messagerie-input'>
            <form action='?module=messagerie&action=envoyer' method='POST'>
                <input type='hidden' name='group_id' value='{$groupId}'>
                <input type='text' name='content' placeholder='Écrire un message...' required>
                <button type='submit' class='messagerie-send-button'>Envoyer</button>
            </form>
        </div>";
        echo '</div>'; // Ferme la conteneur des messages
    }
}
