<?php

class ModeleProjet {
    // Sauvegarder un projet
    public function sauvegarder($titre, $description, $annee, $semestre) {
        $connexion = Connexion::getBdd();

        try {
            $query = $connexion->prepare("INSERT INTO projet (nom, description, annee, semestre) VALUES (?, ?, ?, ?)");
            $query->execute([$titre, $description, $annee, $semestre]);
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    // Sauvegarder un rendu
    public function sauvegarderRendu($titre, $description, $dateLimite) {
        $connexion = Connexion::getBdd();

        try {
            $query = $connexion->prepare("INSERT INTO rendu (id_rendu, id_projet, date_depot) VALUES (?, ?, ?)");
            $query->execute([$titre, $description, $dateLimite]);
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    // Récupérer tous les projets
    public function getProjets() {
        $connexion = Connexion::getBdd();

        try {
            $query = $connexion->prepare("SELECT * FROM projet");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC); // Retourne tous les projets
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }

    // Récupérer tous les rendus
    public function getRendus() {
        $connexion = Connexion::getBdd();

        try {
            $query = $connexion->prepare("SELECT * FROM rendu");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC); // Retourne tous les rendus
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }
}
?>
