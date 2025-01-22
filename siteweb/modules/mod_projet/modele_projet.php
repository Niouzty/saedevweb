<?php
class ModeleProjet extends ModeleGenerique {

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

    public function deposerRendu($projetId, $userId) {
        echo var_dump($projetId,  $userId);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] === UPLOAD_ERR_OK) {
                $nomFichier = $_FILES['fichier']['name'];
                $cheminTemporaire = $_FILES['fichier']['tmp_name'];
                $dossierDestination = 'uploads/';
                $cheminFinal = $dossierDestination . uniqid() . '-' . basename($nomFichier);
    
                if (!is_dir($dossierDestination)) {
                    mkdir($dossierDestination, 0755, true);
                }
    
                if (move_uploaded_file($cheminTemporaire, $cheminFinal)) {
                    // Sauvegarde dans la BD
                    $query = $this->bdd->prepare("
                        INSERT INTO doit_rendre (id_etudiant, id_projet, fichier, date_depot)
                        VALUES (:userId, :projetId, :cheminFichier, NOW())
                    ");
                    $query->bindParam(':userId', $userId, PDO::PARAM_INT);
                    $query->bindParam(':projetId', $projetId, PDO::PARAM_INT);
                    $query->bindParam(':cheminFichier', $cheminFinal, PDO::PARAM_STR);
                    $query->execute();
    
                    echo "Fichier déposé avec succès.";
                } else {
                    echo "Erreur lors du déplacement du fichier.";
                }
            } else {
                echo "Aucun fichier téléchargé ou erreur détectée.";
            }
        } else {
            echo "Méthode non autorisée.";
        }
    }

    

}