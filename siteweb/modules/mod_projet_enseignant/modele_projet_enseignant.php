<?php
class ModeleProjetEnseignant extends ModeleGenerique {

    public function getProjets() {
        $query = $this->bdd->query("SELECT id_projet, nom, description, annee, semestre FROM projet");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRendus($projetId) {
        $query = $this->bdd->prepare("SELECT id_rendu, id_projet, date_depot, fichier FROM rendu WHERE id_projet = :projetId");
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

    public function associerIntervenant($idProjet, $idEnseignant) {
        $query = $this->bdd->prepare("INSERT INTO est_intervenant (id_projet, id_enseignant) VALUES (:idProjet, :idEnseignant)");
        $query->bindParam(':idProjet', $idProjet, PDO::PARAM_INT);
        $query->bindParam(':idEnseignant', $idEnseignant, PDO::PARAM_INT);
        return $query->execute();
    }
    
    public function ajouterRessource($nom, $idProjet, $cheminFichier) {
        $query = $this->bdd->prepare("INSERT INTO ressource (nom, id_projet, chemin_fichier) VALUES (:nom, :idProjet, :cheminFichier)");
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':idProjet', $idProjet, PDO::PARAM_INT);
        $query->bindParam(':cheminFichier', $cheminFichier, PDO::PARAM_STR);
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
