<?php

class ModeleProjet {

    public function sauvegarder($titre, $description, $annee, $semestre, $intervenants) {
    // Connexion à la base de données
        $connexion = Connexion::getBdd();

        try {
            // Insertion du projet
            $query = $connexion->prepare("INSERT INTO projet (nom, description, annee, semestre) VALUES (?, ?, ?, ?)");
            $query->execute([$titre, $description, $annee, $semestre]);

            $projetId = $connexion->lastInsertId();

            // Attribution des intervenants au projet
            $queryIntervenants = $connexion->prepare("INSERT INTO est_intervenant (id_projet, id_intervenant) VALUES (?, ?)");
            foreach ($intervenants as $intervenantId) {
                $queryIntervenants->execute([$projetId, $intervenantId]);
            }

            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function getEtudiants() {
        $connexion = Connexion::getBdd();
        $query = $connexion->prepare("SELECT * FROM etudiant");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatistiques() {
        $connexion = Connexion::getBdd();
        $query = $connexion->prepare("
            SELECT etudiant.nom, AVG(evaluation.note) AS moyenne
            FROM etudiant
            JOIN evaluation ON etudiant.id_etudiant = evaluation.id_evaluation
            GROUP BY etudiant.nom");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }  
}
?>
