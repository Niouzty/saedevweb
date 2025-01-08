<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class VueMessagerie extends VueGenerique {
    // Afficher la liste des groupes
    public function afficherGroupes($groupes) {
        echo '<div class="group-list">';
        foreach ($groupes as $groupe) {
            echo "<div class='group-item' data-id='{$groupe['id']}'>{$groupe['name']}</div>";
        }
        echo '</div>';
    }

    // Afficher les messages d'un groupe
    public function afficherMessages($messages) {
        echo '<div class="message-body">';
        foreach ($messages as $message) {
            echo "<div class='message'>
                    <strong>{$message['name']}:</strong> {$message['content']}
                    <span>{$message['created_at']}</span>
                  </div>";
        }
        echo '</div>';
    }

    // Afficher le champ pour envoyer un message
    public function afficherFormulaireMessage($groupId) {
        echo "
        <div class='message-input'>
            <form action='?module=messagerie&action=envoyer' method='POST'>
                <input type='hidden' name='group_id' value='{$groupId}'>
                <input type='text' name='content' placeholder='Écrire un message' required>
                <button type='submit'>Envoyer</button>
            </form>
        </div>";
    }
}

