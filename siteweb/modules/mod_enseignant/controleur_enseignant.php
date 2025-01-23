<?php
// ControleurEnseignant.php
require_once 'modules/mod_enseignant/vue_enseignant.php';
require_once 'modules/mod_enseignant/vue_emploidutempsenseignant.php';  // Vue de l'emploi du temps
require_once 'modules/mod_enseignant/vue_groupeenseignant.php'; // Vue des groupes enseignants
require_once 'modules/mod_enseignant/vue_creergroupeenseignant.php'; // Vue des créations des groupes
require_once 'modules/mod_enseignant/vue_listegroupeenseignant.php'; // Modele Enseignant
require_once 'modules/mod_enseignant/modele_enseignant.php'; // Modele Enseignant


class ControleurEnseignant {
    protected $modele;

    public function __construct() {
        $this->modele = new ModeleEnseignant();
    }

    // Afficher la page d'accueil de l'enseignant
    public function afficherPageAccueil() {
        $vue = new VueEnseignant();
        $vue->afficherPageAcceuil(); // Méthode pour afficher la page d'accueil
    }


    public function afficherEmploiDuTemps() {
        // Utilisation de la vue spécifique pour l'emploi du temps
        $vue = new VueEmploiDuTempsEnseignant();
        $vue->afficherEmploiDuTemps(); // Méthode pour afficher l'emploi du temps
    }


    // Afficher les projets de l'enseignant
    public function afficherProjets() {
        $vue = new VueGroupeEnseignant();
        $projets = $this->modele->getProjets();
        $vue->afficherProjets($projets); // Affiche les projets pour qu'un enseignant puisse les sélectionner
    }

    // Afficher les groupes d'un projet sélectionné
    public function afficherGroupes() {
        if (isset($_POST['id_projet'])) {
            $id_projet = $_POST['id_projet'];
            $groupes = $this->modele->getGroupesByProjet($id_projet);
            $vue = new VueGroupeEnseignant();
            $vue->afficherGroupes($groupes, $id_projet); // Affiche les groupes du projet
        } else {
            // Rediriger ou afficher un message d'erreur si l'ID du projet n'est pas défini
            header("Location: index.php?module=enseignant&action=afficherProjets");
        }
    }

    
  // Afficher les membres d'un groupe sélectionné
public function afficherMembres() {
    if (isset($_GET['id_groupe'])) {
        $id_groupe = $_GET['id_groupe'];

        // Récupérer les membres du groupe
        $membres = $this->modele->getMembresByGroupe($id_groupe);
        
        // Récupérer les étudiants qui ne sont pas encore assignés à ce groupe
        $etudiantsDisponibles = $this->modele->getEtudiantsSansGroupeExcept($id_groupe);

        // Instancier la vue et afficher les membres et étudiants disponibles pour ajout
        $vue = new VueGroupeEnseignant();
        $vue->afficherMembres($membres, $etudiantsDisponibles, $id_groupe);  // Passer les 3 arguments
    } else {
        // Rediriger ou afficher un message d'erreur si l'ID du groupe n'est pas défini
        header("Location: index.php?module=enseignant&action=afficherGroupes");
    }
}



    // Supprimer un groupe
    public function supprimerGroupe() {
        if (isset($_POST['id_groupe'])) {
            $id_groupe = $_POST['id_groupe'];
            $this->modele->deleteGroupe($id_groupe); // Supprime le groupe
            header("Location: index.php?module=enseignant&action=afficherGroupes");
        } else {
            // Rediriger ou afficher un message d'erreur si l'ID du groupe est manquant
            header("Location: index.php?module=enseignant&action=afficherGroupes");
        }
    }
    public function afficherFormulaireCreerGroupe() {
        if (isset($_GET['id_projet'])) {
            $id_projet = $_GET['id_projet'];
    
            // Récupérer les étudiants qui ne sont pas encore assignés à un groupe dans ce projet
            $etudiantsDisponibles = $this->modele->getEtudiantsSansGroupe($id_projet);
    
            // Instancier la vue et afficher le formulaire avec les données nécessaires
            $vue = new VueCreerGroupeEnseignant();
            $vue->afficherFormulaireCreerGroupe($id_projet, $etudiantsDisponibles);
        } else {
            // Rediriger ou afficher une erreur si l'ID du projet est manquant
            header("Location: index.php?module=enseignant&action=afficherProjets");
        }
    }
    
    public function creerGroupe() {
        if (isset($_POST['nom']) && isset($_POST['id_projet'])) {
            $nom = $_POST['nom'];
            $id_projet = $_POST['id_projet'];
    
            try {
                // Créer le groupe
                $id_groupe = $this->modele->createGroupe($id_projet, $nom);
    
                // Rediriger vers la page des groupes après la création du groupe
                // Dans la méthode creerGroupe() après la création du groupe
            header("Location: index.php?module=enseignant&action=afficherListeGroupes&id_projet=$id_projet&success=true");
            exit();  // Pour s'assurer qu'aucune autre sortie n'est faite après la redirection

    
            } catch (Exception $e) {
                echo "Erreur lors de la création du groupe : " . $e->getMessage();
            }
        }
    }
    
    
    
 
    public function ajouterEtudiant() {
        if (isset($_POST['id_etudiant']) && isset($_POST['id_groupe'])) {
            $id_etudiant = $_POST['id_etudiant'];
            $id_groupe = $_POST['id_groupe'];
    
            // Appel de la méthode pour ajouter l'étudiant
            $resultat = $this->modele->addEtudiantToGroupe($id_etudiant, $id_groupe);
    
            if ($resultat === true) {
                // Rediriger vers la page des membres du groupe avec un message de succès
                header("Location: index.php?module=enseignant&action=afficherMembres&id_groupe=" . $id_groupe . "&success=true");
            } else {
                // Si une erreur est retournée, afficher le message d'erreur
                header("Location: index.php?module=enseignant&action=afficherMembres&id_groupe=" . $id_groupe . "&error=" . urlencode($resultat));
            }
        } else {
            // Rediriger vers la liste des groupes en cas d'erreur
            header("Location: index.php?module=enseignant&action=afficherGroupes");
        }
    }
    

 
    
}
?>