<?php
class ModeleProjet extends ModeleGenerique {

    public function getProjets() {
        $query = $this->bdd->query("SELECT id_projet, nom, annee, description FROM projet");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRendus($projetId) {
        $query = $this->bdd->prepare("SELECT id_rendu, id_projet, date_depot, type FROM rendu WHERE id_projet = :projetId");
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
