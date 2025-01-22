<?php
require_once 'modules/mod_enseignant/vue_noteenseignant.php';
require_once 'modules/mod_enseignant/modele_noteenseignant.php';

class ControleurNoteEnseignant {
    protected $modele;

    public function __construct() {
        $this->modele = new ModeleNoteEnseignant();
    }

    // Afficher les notes d'un étudiant
    public function afficherNotesEtudiant() {
        if (isset($_GET['id_etudiant'])) {
            $id_etudiant = $_GET['id_etudiant'];

            // Récupérer les informations nécessaires depuis le modèle
            $notes = $this->modele->getNotesByEtudiant($id_etudiant);
            $etudiant = $this->modele->getEtudiantById($id_etudiant);

            if ($etudiant) {
                $vue = new VueNoteEnseignant();
                $vue->afficherNotesParEtudiant($notes, $etudiant);
            } else {
                // Redirection ou message d'erreur si l'étudiant n'existe pas
                header("Location: index.php?module=enseignant&action=listeEtudiants");
            }
        } else {
            // Redirection si aucun id_etudiant n'est passé
            header("Location: index.php?module=enseignant&action=listeEtudiants");
        }
    }

    // Afficher le formulaire de création de note
    public function afficherFormulaireCreationNote() {
        if (isset($_GET['id_projet'])) {
            $id_projet = $_GET['id_projet'];

            // Récupérer les rendus associés au projet depuis le modèle
            $rendus = $this->modele->getRendusByProjet($id_projet);

            $vue = new VueNoteEnseignant();
            $vue->afficherFormulaireCreationNote($rendus);
        } else {
            // Redirection si aucun id_projet n'est passé
            header("Location: index.php?module=enseignant&action=afficherProjets");
        }
    }

    // Créer une nouvelle note
    public function creerNote() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id_rendu'], $_POST['note'], $_POST['type_eval'], $_POST['coefficient'])) {
                $id_rendu = $_POST['id_rendu'];
                $note = $_POST['note'];
                $type_eval = $_POST['type_eval'];
                $coefficient = $_POST['coefficient'];
                $commentaire = $_POST['commentaire'] ?? null;

                try {
                    // Créer l'évaluation via le modèle
                    $this->modele->createEvaluation($id_rendu, $note, $commentaire, $type_eval, $coefficient);

                    // Redirection après création réussie
                    if (isset($_POST['id_etudiant'])) {
                        $id_etudiant = $_POST['id_etudiant'];
                        header("Location: index.php?module=enseignant&action=afficherNotesEtudiant&id_etudiant=" . $id_etudiant);
                    } else {
                        header("Location: index.php?module=enseignant&action=afficherProjets");
                    }
                } catch (Exception $e) {
                    // Gérer l'erreur en affichant un message
                    echo "<div class='alert alert-danger'>Erreur : " . htmlspecialchars($e->getMessage()) . "</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Veuillez remplir tous les champs requis.</div>";
            }
        } else {
            // Redirection si l'utilisateur accède à l'action en GET
            header("Location: index.php?module=enseignant&action=afficherProjets");
        }
    }
}
?>
