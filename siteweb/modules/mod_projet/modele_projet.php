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

    /*
    public function deposerRendu($projetId){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $type = $_POST['type'] ?? 'fichier'; // Par défaut, type "fichier"
            $miseEnAvant = isset($_POST['mise_en_avant']) ? true : false;
    
            // Chemin vers le dossier "fichier" du module
            $uploadDir = __DIR__ . '/fichier/';
            if (!is_dir($uploadDir)) {
                if (!mkdir($uploadDir, 0755, true)) {
                    die("Erreur : Impossible de créer le dossier $uploadDir.");
                }
            }
    
            // Gestion du fichier envoyé
            if (!empty($_FILES['chemin_contenu']['name'])) {
                $chemin = $uploadDir . basename($_FILES['chemin_contenu']['name']);
                if (move_uploaded_file($_FILES['chemin_contenu']['tmp_name'], $chemin)) {
                    // Insérer les détails dans la base de données
                    if ($this->modele->ajouterRessource($projetId, $type, 'modules/mod_projet_enseignant/fichier/' . basename($_FILES['chemin_contenu']['name']), $miseEnAvant)) {
                        header("Location: ?module=projet_enseignant&action=ressources&projet_id=$idProjet");
                        exit;
                    } else {
                        echo "Erreur lors de l'ajout de la ressource à la base de données.";
                    }
                } else {
                    echo "Erreur lors de l'upload du fichier.";
                }
            } else {
                echo "Veuillez sélectionner un fichier.";
            }
        }
    }*/

}