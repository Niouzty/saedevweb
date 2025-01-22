<?php
class ModeleMessagerie extends ModeleGenerique {

    // Créer une nouvelle conversation
    public function createConversation($idGroupe, $titre = 'Discussion de groupe') {
        $query = $this->bdd->prepare("
            INSERT INTO conversation (id_groupe, titre, date_creation) 
            VALUES (:idGroupe, :titre, NOW())
        ");
        $query->bindParam(':idGroupe', $idGroupe, PDO::PARAM_INT);
        $query->bindParam(':titre', $titre, PDO::PARAM_STR);
        $query->execute();
    
        return $this->bdd->lastInsertId(); // Retourne l'ID de la nouvelle conversation
    }
    

    // Récupérer les conversations
    public function getConversations($userId) {
        $query = $this->bdd->prepare("
            SELECT DISTINCT c.id_conversation, c.titre
        FROM conversation c
        JOIN inscrit i ON i.id_groupe = c.id_groupe
        WHERE i.id_etudiant = :userId
        ");
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

    // Récupérer les messages
    public function getMessages($conversationId) {
        $query = $this->bdd->prepare("
            SELECT m.contenu, m.date_envoi, m.id_etudiant, m.id_enseignant
            FROM message m
            WHERE m.id_conversation = :conversationId
            ORDER BY m.date_envoi ASC
        ");
        $query->bindParam(':conversationId', $conversationId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Envoyer un message
    public function sendMessage($conversationId, $userId, $content) {
        $query = $this->bdd->prepare("
            INSERT INTO message (id_conversation, id_etudiant, id_enseignant, contenu)
            VALUES (:conversationId, :userId, NULL, :content)
        ");
        $query->bindParam(':conversationId', $conversationId, PDO::PARAM_INT);
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->bindParam(':content', $content, PDO::PARAM_STR);
        $query->execute();
    }
}
?>

