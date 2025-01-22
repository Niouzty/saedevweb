<?php
class ModeleNoteEnseignant extends ModeleGenerique {

    // Récupérer la liste des rendus pour un projet donné
    public function getRendusByProjet($id_projet) {
        $query = $this->bdd->prepare("
            SELECT r.id_rendu, r.nom_fichier, r.date_depot, g.id_groupe, g.nom AS nom_groupe
            FROM rendu r
            JOIN effectuer e ON e.id_groupe = r.id_groupe
            JOIN groupe g ON g.id_groupe = e.id_groupe
            WHERE e.id_projet = :id_projet
        ");
        $query->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les évaluations pour un rendu donné
    public function getEvaluationsByRendu($id_rendu) {
        $query = $this->bdd->prepare("
            SELECT e.id_evaluation, e.note, e.commentaire, e.type_eval, e.coefficient
            FROM evaluation e
            JOIN evalue ev ON ev.id_evaluation = e.id_evaluation
            WHERE ev.id_rendu = :id_rendu
        ");
        $query->bindParam(':id_rendu', $id_rendu, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Créer une nouvelle évaluation (note) et l'associer à un rendu
    public function createEvaluation($id_rendu, $note, $commentaire, $type_eval, $coefficient) {
        try {
            // Démarrer une transaction
            $this->bdd->beginTransaction();

            // Insérer une nouvelle évaluation
            $queryEvaluation = $this->bdd->prepare("
                INSERT INTO evaluation (note, commentaire, type_eval, coefficient) 
                VALUES (:note, :commentaire, :type_eval, :coefficient)
            ");
            $queryEvaluation->bindParam(':note', $note, PDO::PARAM_STR);
            $queryEvaluation->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
            $queryEvaluation->bindParam(':type_eval', $type_eval, PDO::PARAM_STR);
            $queryEvaluation->bindParam(':coefficient', $coefficient, PDO::PARAM_STR);
            $queryEvaluation->execute();

            // Récupérer l'ID de l'évaluation nouvellement créée
            $id_evaluation = $this->bdd->lastInsertId();

            // Associer l'évaluation au rendu
            $queryEvalue = $this->bdd->prepare("
                INSERT INTO evalue (id_evaluation, id_rendu) 
                VALUES (:id_evaluation, :id_rendu)
            ");
            $queryEvalue->bindParam(':id_evaluation', $id_evaluation, PDO::PARAM_INT);
            $queryEvalue->bindParam(':id_rendu', $id_rendu, PDO::PARAM_INT);
            $queryEvalue->execute();

            // Valider la transaction
            $this->bdd->commit();

            // Retourner l'ID de l'évaluation pour confirmation
            return $id_evaluation;

        } catch (Exception $e) {
            // Annuler la transaction en cas d'erreur
            $this->bdd->rollBack();
            throw new Exception("Erreur lors de la création de l'évaluation : " . $e->getMessage());
        }
    }

    // Récupérer les détails d'une évaluation spécifique
    public function getEvaluationDetails($id_evaluation) {
        $query = $this->bdd->prepare("
            SELECT id_evaluation, note, commentaire, type_eval, coefficient
            FROM evaluation
            WHERE id_evaluation = :id_evaluation
        ");
        $query->bindParam(':id_evaluation', $id_evaluation, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Supprimer une évaluation
    public function deleteEvaluation($id_evaluation) {
        $query = $this->bdd->prepare("
            DELETE FROM evaluation WHERE id_evaluation = :id_evaluation
        ");
        $query->bindParam(':id_evaluation', $id_evaluation, PDO::PARAM_INT);
        $query->execute();
    }

    // Récupérer les notes d'un étudiant spécifique
    public function getNotesByEtudiant($id_etudiant) {
        $query = $this->bdd->prepare("
            SELECT e.id_evaluation, e.note, e.commentaire, e.type_eval, e.coefficient, r.id_rendu, p.nom AS projet
            FROM evaluation e
            JOIN evalue ev ON ev.id_evaluation = e.id_evaluation
            JOIN rendu r ON r.id_rendu = ev.id_rendu
            JOIN effectuer ef ON ef.id_groupe = r.id_groupe
            JOIN groupe g ON g.id_groupe = ef.id_groupe
            JOIN inscrit i ON i.id_groupe = g.id_groupe
            JOIN projet p ON p.id_projet = ef.id_projet
            WHERE i.id_etudiant = :id_etudiant
        ");
        $query->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEtudiantById($id_etudiant) {
        $query = $this->bdd->prepare("
            SELECT id_etudiant, nom, prenom, email
            FROM etudiant
            WHERE id_etudiant = :id_etudiant
        ");
        $query->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    

}
?>
