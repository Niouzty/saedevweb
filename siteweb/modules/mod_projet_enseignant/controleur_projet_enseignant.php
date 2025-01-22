<?php
require_once "modele_projet_enseignant.php";
require_once "vue_projet_enseignant.php";

class ControleurProjetEnseignant {
    protected $modele;

    public function __construct() {
        $this->modele = new ModeleProjetEnseignant();
    }

    // Afficher la liste des projets
    public function afficherProjets() {
        $vue = new VueProjetEnseignant();
        $projets = $this->modele->getProjets();
        $vue->afficherProjets($projets);
    }

    // Afficher les rendus d'un projet
    public function afficherRendus($projetId) {
        $vue = new VueProjetEnseignant();
        $rendus = $this->modele->getRendus($projetId);
        $vue->afficherListeRendus($rendus);
    }

    //afficher la liste des rendus
    public function afficherListeRendus() {
        $vue = new VueProjetEnseignant();
        $rendus = $this->modele->getAllRendus(); // Récupère tous les rendus depuis le modèle
        $vue->afficherListeRendus($rendus); // Appelle la vue pour afficher les rendus
    }

    public function afficherRessources($idProjet) {
        $vue = new VueProjetEnseignant();
        $ressources = $this->modele->getRessourcesByProjet($idProjet);
        $vue->afficherRessources($ressources, $idProjet);
    }

    public function ajouterRessource($idProjet) {
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
                    if ($this->modele->ajouterRessource($idProjet, $type, 'modules/mod_projet_enseignant/fichier/' . basename($_FILES['chemin_contenu']['name']), $miseEnAvant)) {
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
    }

    // Supprimer une ressource
    public function supprimerRessource($idRessource, $idProjet) {
        if ($this->modele->supprimerRessource($idRessource)) {
            header("Location: ?module=projet_enseignant&action=ressources&projet_id=$idProjet");
            exit;
        } else {
            echo "Erreur lors de la suppression de la ressource.";
        }
    }

    // Modifier la mise en avant
    public function modifierMiseEnAvant($idRessource, $idProjet, $miseEnAvant) {
        if ($this->modele->modifierMiseEnAvant($idRessource, $miseEnAvant)) {
            header("Location: ?module=projet_enseignant&action=ressources&projet_id=$idProjet");
            exit;
        } else {
            echo "Erreur lors de la mise à jour.";
        }
    }

    // Créer un nouveau projet
    public function creerProjet() {
        $vue = new VueProjetEnseignant();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'] ?? '';
            $description = $_POST['description'] ?? '';
            $annee = $_POST['annee'] ?? '';
            $semestre = $_POST['semestre'] ?? '';
            $intervenants = $_POST['intervenants'] ?? []; // Récupère les enseignants sélectionnés
            $ressources = $_FILES['ressources'] ?? [];
    
            // Sauvegarder le projet
            $projetId = $this->modele->sauvegarderProjet($titre, $description, $annee, $semestre);
    
            if ($projetId) {
                // Sauvegarder les enseignants intervenants
                foreach ($intervenants as $idEnseignant) {
                    $this->modele->attribuerIntervenant($projetId, $idEnseignant);
                }
    
                // Sauvegarder les ressources
                foreach ($ressources['name'] as $index => $name) {
                    if ($ressources['error'][$index] === UPLOAD_ERR_OK) {
                        $chemin = 'uploads/' . basename($ressources['name'][$index]);
                        if (move_uploaded_file($ressources['tmp_name'][$index], $chemin)) {
                            $this->modele->ajouterRessource($projetId, $chemin);
                        }
                    }
                }
    
                header("Location: ?module=projet_enseignant&action=projets");
                exit;
            } else {
                $vue->afficherMessage("Erreur lors de la création du projet.", "danger");
            }
        } else {
            // Récupérer les enseignants pour le formulaire
            $enseignants = $this->modele->getEnseignants();
            $vue->afficherFormulaireProjet($enseignants, []);
        }
    }
    
    

    // Créer un nouveau rendu
    public function creerRendu() {
        $vue = new VueProjetEnseignant();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $projetId = $_POST['projet_id'] ?? '';
            $fichier = $_FILES['fichier'] ?? null;

            if ($fichier && $fichier['error'] === UPLOAD_ERR_OK) {
                $cheminFichier = 'uploads/' . basename($fichier['fichier']);
                if (move_uploaded_file($fichier['fichier'], $cheminFichier)) {
                    if ($this->modele->sauvegarderRendu($projetId, $cheminFichier)) {
                        header("Location: ?module=projet_enseignant&action=rendus&projet_id=$projetId");
                        exit;
                    } else {
                        $vue->afficherMessage("Erreur lors de l'enregistrement du rendu.", "danger");
                    }
                } else {
                    $vue->afficherMessage("Erreur lors du téléchargement du fichier.", "danger");
                }
            } else {
                $vue->afficherMessage("Fichier non valide ou manquant.", "danger");
            }
        } else {
            $vue->afficherFormulaireRendu();
        }
    }
}
?>
