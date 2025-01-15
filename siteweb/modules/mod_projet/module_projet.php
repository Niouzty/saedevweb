<?php
require_once 'modele_projet.php';
require_once 'controleur_projet.php';

class ModuleProjet {

    // La méthode run gère les différentes actions
    public function run($action) {
        $controleur = new ControleurProjet(); // Création d'une instance du contrôleur

        // Afficher la barre de navigation principale + gestion de la section "Projet"
        $this->afficherBarreDeNavigation();

        // Gérer les différentes actions (création de projet, rendu, etc.)
        switch ($action) {
            case 'cree_projet':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controleur->cree_projet();
                } else {
                    $controleur->afficherFormulaire();
                }
                break;

            case 'cree_rendu':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controleur->creerRendu();
                } else {
                    $controleur->creerRendu();
                }
                break;

            case 'listerProjets':
                $controleur->listerProjets();
                break;

            case 'listerRendus':
                $controleur->listerRendus();
                break;

            default:
                echo "Action inconnue.";
                break;
        }
    }

    // Afficher la barre de navigation spécifique aux projets
    private function afficherBarreDeNavigation() {
        echo '
        <div class="navbar">
            <img src="./public/images/logoiutmontreuil-sommaire.png" alt="Logo IUT Montreuil">
            <div>
                <a href="index.php">Home</a>
                <a href="#">Ressources</a>
                <a href="index.php?module=projet&action=cree_projet">Créer Projet</a>
                <a href="index.php?module=projet&action=cree_rendu">Créer Rendu</a>
                <a href="index.php?module=projet&action=listerProjets">Voir la liste des Projets</a>
                <a href="index.php?module=projet&action=listerRendus">Voir la liste des Rendus</a>
                <a href="deconnexion.php">Déconnexion</a>
            </div>
        </div>';
    }
}
?>
