<?php
class ModeleEnseignant extends ModeleGenerique {

    // Récupérer tous les projets
    public function getProjets() {
        $query = $this->bdd->prepare("SELECT * FROM projet");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les groupes par projet
    public function getGroupesByProjet($id_projet) {
        $query = "
            SELECT g.id_groupe, g.nom 
            FROM groupe g
            JOIN effectuer e ON g.id_groupe = e.id_groupe
            WHERE e.id_projet = :id_projet
        ";
        $stmt = $this->bdd->prepare($query); // Utilisation de $this->bdd pour la connexion
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer tous les étudiants d'un groupe
    public function getMembresByGroupe($id_groupe) {
        $query = $this->bdd->prepare("
            SELECT e.id_etudiant, e.nom, e.prenom 
            FROM etudiant e
            JOIN inscrit i ON i.id_etudiant = e.id_etudiant
            WHERE i.id_groupe = :id_groupe
        ");
        $query->bindParam(':id_groupe', $id_groupe, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Créer un nouveau groupe pour un projet
    public function createGroupe($id_projet, $nom) {
        try {
            // Démarrer une transaction
            $this->bdd->beginTransaction();

            // Insérer le groupe dans la table 'groupe'
            $queryGroupe = $this->bdd->prepare("
                INSERT INTO groupe (nom) 
                VALUES (:nom)
            ");
            $queryGroupe->bindParam(':nom', $nom, PDO::PARAM_STR);
            $queryGroupe->execute();

            // Récupérer l'ID du groupe nouvellement créé
            $id_groupe = $this->bdd->lastInsertId();

            // Associer le groupe au projet dans la table 'effectuer'
            $queryEffectuer = $this->bdd->prepare("
                INSERT INTO effectuer (id_projet, id_groupe) 
                VALUES (:id_projet, :id_groupe)
            ");
            $queryEffectuer->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
            $queryEffectuer->bindParam(':id_groupe', $id_groupe, PDO::PARAM_INT);
            $queryEffectuer->execute();

            // Valider la transaction
            $this->bdd->commit();

            // Retourner l'ID du groupe
            return $id_groupe;

        } catch (Exception $e) {
            // Annuler la transaction en cas d'erreur
            $this->bdd->rollBack();
            throw new Exception("Erreur lors de la création du groupe : " . $e->getMessage());
        }
    }
    public function getEtudiantsSansGroupeExcept($id_groupe) {
        $query = "SELECT e.id_etudiant, e.nom, e.prenom
                  FROM etudiant e
                  WHERE e.id_etudiant NOT IN (
                      SELECT i.id_etudiant
                      FROM inscrit i
                      JOIN effectuer eff ON i.id_groupe = eff.id_groupe
                      WHERE eff.id_groupe = :id_groupe
                  )";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':id_groupe', $id_groupe, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Ajouter un étudiant à un groupe
// Ajouter un étudiant à un groupe
public function addEtudiantToGroupe($id_etudiant, $id_groupe) {
    // Vérifier si le groupe existe
    if (!$this->isValidGroupe($id_groupe)) {
        // Retourner une erreur ou un message que le groupe n'existe pas
        return "Groupe invalide ou inexistant. Veuillez d'abord créer un groupe.";
    }

    try {
        // Préparer la requête d'insertion
        $sql = "INSERT INTO inscrit (id_etudiant, id_groupe) VALUES (:id_etudiant, :id_groupe)";
        $stmt = $this->bdd->prepare($sql);

        // Lier les paramètres
        $stmt->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
        $stmt->bindParam(':id_groupe', $id_groupe, PDO::PARAM_INT);

        // Exécuter la requête
        $stmt->execute();

        // Retourner un succès
        return true;
    } catch (PDOException $e) {
        // En cas d'erreur, on capture l'exception et on la retourne
        return "Erreur lors de l'ajout de l'étudiant au groupe: " . $e->getMessage();
    }
}

    
    public function isValidGroupe($id_groupe) {
        $sql = "SELECT COUNT(*) FROM groupe WHERE id_groupe = :id_groupe";
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':id_groupe', $id_groupe, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
    
    // Supprimer un groupe
    public function deleteGroupe($id_groupe) {
        // Supprimer les inscriptions des étudiants dans ce groupe
        $query = $this->bdd->prepare("DELETE FROM inscrit WHERE id_groupe = :id_groupe");
        $query->bindParam(':id_groupe', $id_groupe, PDO::PARAM_INT);
        $query->execute();

        // Supprimer le groupe
        $query = $this->bdd->prepare("DELETE FROM groupe WHERE id_groupe = :id_groupe");
        $query->bindParam(':id_groupe', $id_groupe, PDO::PARAM_INT);
        $query->execute();
    }

    // Récupérer les groupes auxquels appartient un étudiant
    public function getGroupesByEtudiant($id_etudiant) {
        $query = $this->bdd->prepare("
            SELECT g.id_groupe, g.nom
            FROM groupe g
            JOIN inscrit i ON i.id_groupe = g.id_groupe
            WHERE i.id_etudiant = :id_etudiant
        ");
        $query->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les détails d'un projet
    public function getProjetDetails($id_projet) {
        $query = $this->bdd->prepare("SELECT * FROM projet WHERE id_projet = :id_projet");
        $query->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Créer un projet
    public function createProjet($nom, $description, $annee, $semestre) {
        $query = $this->bdd->prepare("
            INSERT INTO projet (nom, description, annee, semestre) 
            VALUES (:nom, :description, :annee, :semestre)
        ");
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':annee', $annee, PDO::PARAM_INT);
        $query->bindParam(':semestre', $semestre, PDO::PARAM_INT);
        $query->execute();
        return $this->bdd->lastInsertId(); // Retourne l'ID du projet créé
    }

        // Récupérer les étudiants sans groupe dans un projet donné
    public function getEtudiantsSansGroupe($id_projet) {
        $query = "SELECT e.id_etudiant, e.nom, e.prenom 
                FROM etudiant e
                WHERE e.id_etudiant NOT IN (
                    SELECT i.id_etudiant
                    FROM inscrit i
                    JOIN effectuer eff ON i.id_groupe = eff.id_groupe
                    WHERE eff.id_projet = :id_projet
                )";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    

}

// a faire, une fois que j'ai selectionner le projet faire en sorte de pouvoir creer des groupes donner un nom au groupe,
// il faut que quand je creer un groupe j'ai une liste de tous les etudiants n'ont pas de groupe dans ce projet 
// donc je dois verifier la table effectuer qui a un id_projet et un id_groupe et la table inscrit qui a un id_groupe et un id_etudiant
// pour savoir que dans tel projet il y a tel groupe et s'il n'ya pas de groupe je dois pouvoir ajouter au groupe nimporte quel etudiant
// en revanche si il y a deja un  ou des groupes, les etudiants qui sont dans ces groupes ne peuvent pas être ajouté à un groupe que je créer 
// et que a cote du nom de l'etudiant il y ait une icone ajouter et que lorsque je clique sur ajoute letudiant soit ajouiter au groupe
//
?>
