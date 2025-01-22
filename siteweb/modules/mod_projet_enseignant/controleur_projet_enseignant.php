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

    // Créer un nouveau projet
    public function creerProjet() {
        $vue = new VueProjetEnseignant();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $titre = $_POST['titre'] ?? '';
            $description = $_POST['description'] ?? '';
            $annee = $_POST['annee'] ?? '';
            $semestre = $_POST['semestre'] ?? '';
            $intervenants = $_POST['intervenants'] ?? [];
            $ressources = $_FILES['ressources'] ?? null;
    
            // Création du projet
            $idProjet = $this->modele->sauvegarderProjet($titre, $description, $annee, $semestre);
    
            if ($idProjet) {
                // Association des intervenants au projet
                foreach ($intervenants as $idEnseignant) {
                    $this->modele->associerIntervenant($idProjet, $idEnseignant);
                }
    
                // Téléchargement et association des ressources
                if ($ressources && is_array($ressources['name'])) {
                    for ($i = 0; $i < count($ressources['name']); $i++) {
                        if ($ressources['error'][$i] === UPLOAD_ERR_OK) {
                            $cheminFichier = 'uploads/' . basename($ressources['name'][$i]);
                            if (move_uploaded_file($ressources['tmp_name'][$i], $cheminFichier)) {
                                $this->modele->ajouterRessource($ressources['name'][$i], $idProjet, $cheminFichier);
                            }
                        }
                    }
                }
    
                // Redirection après succès
                header("Location: ?module=projet_enseignant&action=projets");
                exit;
            } else {
                $vue->afficherMessage("Erreur lors de la création du projet.", "danger");
            }
        } else {
            // Chargement des enseignants et affichage du formulaire
            $enseignants = $this->modele->getEnseignants();
            $ressources = $this->modele->getRessources();
            $vue->afficherFormulaireProjet($enseignants, $ressources);
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
