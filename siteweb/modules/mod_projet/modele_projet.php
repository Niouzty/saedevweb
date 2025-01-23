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

    public function deposerRendu($projetId) {
        // Chemin vers le dossier "fichier" du module
        $uploadDir = __DIR__ . '/fichier/';
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                die("Erreur : Impossible de créer le dossier $uploadDir.");
            }
        }

        if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] === UPLOAD_ERR_OK) {
            $dossierCible = '/home/etudiants/info/epembelefuala/uploads/';
            

            // Vérifier si le dossier existe, sinon le créer
            if (!is_dir($dossierCible)) {
                mkdir($dossierCible, 0775, true);
            }
            
            // Nettoyer le nom du fichier pour éviter les caractères spéciaux
            $nomFichier = preg_replace('/[^a-zA-Z0-9._-]/', '_', $_FILES['fichier']['name']);
            
            // Définir le chemin cible dans le dossier 'uploads'
            $cheminCible = $dossierCible . $nomFichier;
    
            // Déplacement du fichier dans le dossier cible
            if (move_uploaded_file($_FILES['fichier']['tmp_name'], $cheminCible)) {
                echo "Fichier uploadé avec succès.";
            } else {
                echo "Erreur lors du déplacement du fichier.";
            }
        } else {
            echo "Erreur : " . ($_FILES['fichier']['error'] ?? "Aucun fichier reçu.");
        }
    }
}
