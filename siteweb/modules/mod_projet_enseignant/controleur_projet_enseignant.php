<?php
require_once "modele_projet_enseignant.php";
require_once "vue_projet_enseignant.php";
require_once "module_projet_enseignant.php"; // Ajout de cette ligne

class ControleurProjetEnseignant {
    protected $modele;

    public function __construct() {
        $this->modele = new ModeleProjetEnseignant();
    }


    public function afficherProjets() {
        $vue = new VueProjetEnseignant();
        $projets = $this->modele->getProjets();
        $vue->afficherProjets($projets);
    }

    public function afficherRendus($projetId) {
        $vue = new VueProjetEnseignant();
        $rendus = $this->modele->getRendus($projetId);
        $vue->afficherListeRendus($rendus);
    }

    public function afficherListeRendus() {
        $vue = new VueProjetEnseignant();
        $rendus = $this->modele->getAllRendus();
        $vue->afficherListeRendus($rendus);
    }

    public function afficherRessources($idProjet) {
        $vue = new VueProjetEnseignant();
        $ressources = $this->modele->getRessourcesByProjet($idProjet);
        $vue->afficherRessources($ressources, $idProjet);
    }

    public function supprimerRessource($idRessource) {
        $vue = new VueProjetEnseignant();
        $ressources = $this->modele->supprimerRessource($idRessource);
    }

    public function ajouterRessource($idProjet) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $type = $_POST['fichier'] ?? 'fichier';
            $miseEnAvant = isset($_POST['mise_en_avant']) ? true : false;

            $uploadDir = __DIR__ . '/fichier/';
            if (!is_dir($uploadDir)) {
                if (!mkdir($uploadDir, 0755, true)) {
                    die("Erreur : Impossible de créer le dossier $uploadDir.");
                }
            }

            if (!empty($_FILES['chemin_contenu']['name'])) {
                $chemin = $uploadDir . basename($_FILES['chemin_contenu']['fichier']);
                if (move_uploaded_file($_FILES['chemin_contenu']['fichier'], $chemin)) {
                    if ($this->modele->ajouterRessource($idProjet, $type, 'modules/mod_projet_enseignant/fichier/' . basename($_FILES['chemin_contenu']['fichier']), $miseEnAvant)) {
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

    public function creerProjet() {
        $vue = new VueProjetEnseignant();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'] ?? '';
            $description = $_POST['description'] ?? '';
            $annee = $_POST['annee'] ?? '';
            $semestre = $_POST['semestre'] ?? '';
            $intervenants = $_POST['intervenants'] ?? [];
            $ressources = $_FILES['ressources'] ?? [];

            $projetId = $this->modele->sauvegarderProjet($titre, $description, $annee, $semestre);

            if ($projetId) {
                foreach ($intervenants as $idEnseignant) {
                    $this->modele->attribuerIntervenant($projetId, $idEnseignant);
                }

                foreach ($ressources['name'] as $index => $name) {
                    if ($ressources['error'][$index] === UPLOAD_ERR_OK) {
                        $chemin = 'uploads/' . basename($ressources['name'][$index]);
                        if (move_uploaded_file($ressources['tmp_name'][$index], $chemin)) {
                            //$this->modele->ajouterRessource($projetId, $chemin);
                        }
                    }
                }

                header("Location: ?module=projet_enseignant&action=projets");
                exit;
            } else {
                $vue->afficherMessage("Erreur lors de la création du projet.", "danger");
            }
        } else {
            $enseignants = $this->modele->getEnseignants();
            $vue->afficherFormulaireProjet($enseignants, []);
        }
    }

    public function creerRendu() {
        $vue = new VueProjetEnseignant();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $projetId = $_POST['projet_id'] ?? '';
            $fichier = $_FILES['fichier'] ?? null;

            if ($fichier && $fichier['error'] === UPLOAD_ERR_OK) {
                $cheminFichier = 'uploads/' . basename($fichier['name']);
                if (move_uploaded_file($fichier['tmp_name'], $cheminFichier)) {
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





































<?php
/*
require_once "modele_projet_enseignant.php";
require_once "vue_projet_enseignant.php";
require_once "controleur_projet_enseignant.php"; // Ajout de cette ligne

class ModuleProjetEnseignant extends ModuleGenerique {
    protected $modele;

    public function __construct() {
        $this->creerModele();
        $this->creerControleur();
    }

    // Implémentation de creerControleur
    protected function creerControleur() {
        $this->controleur = new ControleurProjetEnseignant();
    }

    // Implémentation de creerModele
    protected function creerModele() {
        $this->modele = new ModeleProjetEnseignant();
    }

    public function afficherProjets() {
        $vue = new VueProjetEnseignant();
        $projets = $this->modele->getProjets();
        $vue->afficherProjets($projets);
    }

    public function afficherRendus($projetId) {
        $vue = new VueProjetEnseignant();
        $rendus = $this->modele->getRendus($projetId);
        $vue->afficherListeRendus($rendus);
    }

    public function afficherListeRendus() {
        $vue = new VueProjetEnseignant();
        $rendus = $this->modele->getAllRendus();
        $vue->afficherListeRendus($rendus);
    }

    public function afficherRessources($idProjet) {
        $vue = new VueProjetEnseignant();
        $ressources = $this->modele->getRessourcesByProjet($idProjet);
        $vue->afficherRessources($ressources, $idProjet);
    }

    public function ajouterRessource($idProjet) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $type = $_POST['type'] ?? 'fichier';
            $miseEnAvant = isset($_POST['mise_en_avant']) ? true : false;

            $uploadDir = __DIR__ . '/fichier/';
            if (!is_dir($uploadDir)) {
                if (!mkdir($uploadDir, 0755, true)) {
                    die("Erreur : Impossible de créer le dossier $uploadDir.");
                }
            }

            if (!empty($_FILES['chemin_contenu']['name'])) {
                $chemin = $uploadDir . basename($_FILES['chemin_contenu']['name']);
                if (move_uploaded_file($_FILES['chemin_contenu']['tmp_name'], $chemin)) {
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

    public function creerProjet() {
        $vue = new VueProjetEnseignant();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'] ?? '';
            $description = $_POST['description'] ?? '';
            $annee = $_POST['annee'] ?? '';
            $semestre = $_POST['semestre'] ?? '';
            $intervenants = $_POST['intervenants'] ?? [];
            $ressources = $_FILES['ressources'] ?? [];

            $projetId = $this->modele->sauvegarderProjet($titre, $description, $annee, $semestre);

            if ($projetId) {
                foreach ($intervenants as $idEnseignant) {
                    $this->modele->attribuerIntervenant($projetId, $idEnseignant);
                }

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
            $enseignants = $this->modele->getEnseignants();
            $vue->afficherFormulaireProjet($enseignants, []);
        }
    }

    public function creerRendu() {
        $vue = new VueProjetEnseignant();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $projetId = $_POST['projet_id'] ?? '';
            $fichier = $_FILES['fichier'] ?? null;

            if ($fichier && $fichier['error'] === UPLOAD_ERR_OK) {
                $cheminFichier = 'uploads/' . basename($fichier['name']);
                if (move_uploaded_file($fichier['tmp_name'], $cheminFichier)) {
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
*/
?>
