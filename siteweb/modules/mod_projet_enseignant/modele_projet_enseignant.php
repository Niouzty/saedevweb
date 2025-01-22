<?php
class ModeleProjetEnseignant extends ModeleGenerique {

    public function getProjets() {
        $query = $this->bdd->query("SELECT id_projet, nom, description, annee, semestre FROM projet");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRendus($projetId) {
        $query = $this->bdd->prepare("SELECT id_rendu, id_projet, date_depot, type FROM rendu WHERE id_projet = :projetId");
        $query->bindParam(':projetId', $projetId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllRendus() {
        $query = $this->bdd->query("SELECT id_rendu, id_projet, date_depot, fichier FROM rendu");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function sauvegarderProjet($titre, $description, $annee, $semestre) {
        $query = $this->bdd->prepare("INSERT INTO projet (nom, description, annee, semestre) VALUES (:titre, :description, :annee, :semestre)");
        $query->bindParam(':titre', $titre, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':annee', $annee, PDO::PARAM_INT);
        $query->bindParam(':semestre', $semestre, PDO::PARAM_INT);
        return $query->execute();
    }

    public function sauvegarderRendu($projetId, $renduId) {
        $query = $this->bdd->prepare("INSERT INTO rendu (id_rendu, id_projet, date_depot, fichier) VALUES (:projetId, :renduId, NOW())");
        $query->bindParam(':projetId', $projetId, PDO::PARAM_INT);
        $query->bindParam(':cheminFichier', $renduId, PDO::PARAM_STR);
        return $query->execute();
    }

    public function attribuerIntervenant($projetId, $idEnseignant) {
        $query = $this->bdd->prepare("
            INSERT INTO est_intervenant (id_projet, id_enseignant) 
            VALUES (:id_projet, :id_enseignant)
        ");
        $query->bindParam(':id_projet', $projetId, PDO::PARAM_INT);
        $query->bindParam(':id_enseignant', $idEnseignant, PDO::PARAM_INT);
        $query->execute();
    }
    
    public function getRessourcesByProjet($idProjet) {
        $query = $this->bdd->prepare("
            SELECT id_ressource, id_projet, type, chemin_contenu, mise_en_avant 
            FROM ressource 
            WHERE id_projet = :idProjet
        ");
        $query->bindParam(':idProjet', $idProjet, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter une ressource pour un projet
    public function ajouterRessource($idProjet, $type, $cheminContenu, $miseEnAvant = false) {
        $query = $this->bdd->prepare("
            INSERT INTO ressource (id_projet, type, chemin_contenu, mise_en_avant) 
            VALUES (:idProjet, :type, :cheminContenu, :miseEnAvant)
        ");
        $query->bindParam(':idProjet', $idProjet, PDO::PARAM_INT);
        $query->bindParam(':type', $type, PDO::PARAM_STR);
        $query->bindParam(':cheminContenu', $cheminContenu, PDO::PARAM_STR);
        $query->bindParam(':miseEnAvant', $miseEnAvant, PDO::PARAM_BOOL);
        return $query->execute();
    }
    

    // Supprimer une ressource
    public function supprimerRessource($idRessource) {
        $query = $this->bdd->prepare("DELETE FROM ressource WHERE id_ressource = :idRessource");
        $query->bindParam(':idRessource', $idRessource, PDO::PARAM_INT);
        return $query->execute();
    }

    // Mettre en avant ou désactiver la mise en avant d'une ressource
    public function modifierMiseEnAvant($idRessource, $miseEnAvant) {
        $query = $this->bdd->prepare("
            UPDATE ressource 
            SET mise_en_avant = :miseEnAvant 
            WHERE id_ressource = :idRessource
        ");
        $query->bindParam(':idRessource', $idRessource, PDO::PARAM_INT);
        $query->bindParam(':miseEnAvant', $miseEnAvant, PDO::PARAM_BOOL);
        return $query->execute();
    }

    public function getEnseignants() {
        $query = $this->bdd->query("SELECT id_enseignant, CONCAT(prenom, ' ', nom) AS nom FROM enseignant");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRessources() {
        $query = $this->bdd->query("SELECT id_ressource, type, contenu FROM ressource");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }    

}
?>
