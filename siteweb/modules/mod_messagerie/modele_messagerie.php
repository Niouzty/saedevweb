<?php
class ModeleMessagerie extends ModeleGenerique {
    // Récupérer les groupes d'un utilisateur
    public function getGroupes($userId) {
        $query = $this->bdd->prepare("
            SELECT g.id, g.name 
            FROM groups g 
            JOIN group_members gm ON g.id = gm.group_id 
            WHERE gm.user_id = :userId
        ");
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les messages d'un groupe
    public function getMessages($groupId) {
        $query = $this->bdd->prepare("
            SELECT m.content, m.created_at, u.name 
            FROM messages m 
            JOIN users u ON m.user_id = u.id 
            WHERE m.group_id = :groupId 
            ORDER BY m.created_at ASC
        ");
        $query->bindParam(':groupId', $groupId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Envoyer un message dans un groupe
    public function sendMessage($groupId, $userId, $content) {
        $query = $this->bdd->prepare("
            INSERT INTO messages (group_id, user_id, content, created_at) 
            VALUES (:groupId, :userId, :content, NOW())
        ");
        $query->bindParam(':groupId', $groupId, PDO::PARAM_INT);
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->bindParam(':content', $content, PDO::PARAM_STR);
        return $query->execute();
    }
}

