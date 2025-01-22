class ModeleGroupe extends ModeleGenerique {

// Récupérer tous les groupes
public function getGroupes() {
    $query = $this->bdd->query("SELECT id_groupe, nom_groupe FROM groupe");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer les étudiants d'un groupe spécifique
public function getEtudiantsParGroupe($idGroupe) {
    $query = $this->bdd->prepare("
        SELECT e.id_etudiant, e.nom, e.prenom
        FROM etudiant e
        INNER JOIN appartient a ON e.id_etudiant = a.id_etudiant
        WHERE a.id_groupe = :idGroupe
    ");
    $query->bindParam(':idGroupe', $idGroupe, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer tous les étudiants
public function getEtudiants() {
    $query = $this->bdd->query("SELECT id_etudiant, nom, prenom FROM etudiant");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Créer un nouveau groupe
public function creerGroupe($nomGroupe, $etudiants) {
    try {
        $this->bdd->beginTransaction();

        // Insérer le groupe
        $query = $this->bdd->prepare("INSERT INTO groupe (nom_groupe) VALUES (:nomGroupe)");
        $query->bindParam(':nomGroupe', $nomGroupe, PDO::PARAM_STR);
        $query->execute();

        // Obtenir l'ID du groupe inséré
        $idGroupe = $this->bdd->lastInsertId();

        // Ajouter les étudiants au groupe
        $queryEtudiant = $this->bdd->prepare("INSERT INTO appartient (id_groupe, id_etudiant) VALUES (:idGroupe, :idEtudiant)");
        foreach ($etudiants as $idEtudiant) {
            $queryEtudiant->bindParam(':idGroupe', $idGroupe, PDO::PARAM_INT);
            $queryEtudiant->bindParam(':idEtudiant', $idEtudiant, PDO::PARAM_INT);
            $queryEtudiant->execute();
        }

        $this->bdd->commit();
        return true;
    } catch (Exception $e) {
        $this->bdd->rollBack();
        return false;
    }
}

// Récupérer les notes des groupes
public function getNotesGroupes() {
    $query = $this->bdd->query("
        SELECT g.nom_groupe, AVG(n.note) AS moyenne_note
        FROM groupe g
        INNER JOIN appartient a ON g.id_groupe = a.id_groupe
        INNER JOIN note n ON a.id_etudiant = n.id_etudiant
        GROUP BY g.id_groupe
    ");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
}
