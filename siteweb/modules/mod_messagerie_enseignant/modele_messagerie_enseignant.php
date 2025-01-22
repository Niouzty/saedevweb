<?php
class ModeleMessagerieEnseignant extends ModeleGenerique {

    // Récupérer toutes les conversations disponibles
    public function getConversations() {
        $query = $this->bdd->query("
            SELECT id_conversation, titre 
            FROM conversation
            ORDER BY date_creation DESC
        ");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les messages d'une conversation
    public function getMessages($conversationId) {
        $query = $this->bdd->prepare("
            SELECT m.contenu, m.date_envoi, e.nom AS enseignant_nom, et.nom AS etudiant_nom
            FROM message m
            LEFT JOIN enseignant e ON m.id_enseignant = e.id_enseignant
            LEFT JOIN etudiant et ON m.id_etudiant = et.id_etudiant
            WHERE m.id_conversation = :conversationId
            ORDER BY m.date_envoi ASC
        ");
        $query->bindParam(':conversationId', $conversationId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Envoyer un message
    public function sendMessage($conversationId, $enseignantId, $content) {
        $query = $this->bdd->prepare("
            INSERT INTO message (id_conversation, id_enseignant, contenu, date_envoi)
            VALUES (:conversationId, :enseignantId, :content, NOW())
        ");
        $query->bindParam(':conversationId', $conversationId, PDO::PARAM_INT);
        $query->bindParam(':enseignantId', $enseignantId, PDO::PARAM_INT);
        $query->bindParam(':content', $content, PDO::PARAM_STR);
        $query->execute();
    }

    // Créer une nouvelle conversation pour un groupe
    public function createConversation($idGroupe, $titre = 'Nouvelle discussion') {
        $query = $this->bdd->prepare("
            INSERT INTO conversation (id_groupe, titre, date_creation) 
            VALUES (:idGroupe, :titre, NOW())
        ");
        $query->bindParam(':idGroupe', $idGroupe, PDO::PARAM_INT);
        $query->bindParam(':titre', $titre, PDO::PARAM_STR);
        $query->execute();

        return $this->bdd->lastInsertId();
    }
}
?>
