<?php
class ModeleProjet extends ModeleGenerique {

/*
    public function getProjets() {
        $query = $this->bdd->query("SELECT id_projet, nom, annee, description FROM projet");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
        */

    public function getProjets() {
        $query = $this->bdd->query("SELECT id_projet, nom, description, annee, semestre FROM projet");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getRendus($projetId) {
        $query = $this->bdd->prepare("
            SELECT r.description, r.date_depot, 
                   e2.id_enseignant, e2.nom, e2.prenom
            FROM rendu AS r
            JOIN est_responsable AS e USING (id_projet)
            JOIN enseignant AS e2 ON e.id_enseignant = e2.id_enseignant
            WHERE r.id_projet =:projetId
        ");
        $query->bindParam(':projetId', $projetId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function saveRendu($projetId, $userId, $cheminFichier) {
        $query = $this->bdd->prepare("INSERT INTO doit_rendre (id_etudiant, id_projet, fichier, date_depot) VALUES (:projetId, :userId, :cheminFichier, NOW())");
        $query->bindParam(':projetId', $projetId, PDO::PARAM_INT);
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->bindParam(':cheminFichier', $cheminFichier, PDO::PARAM_STR);
        $query->execute();
    }
}
