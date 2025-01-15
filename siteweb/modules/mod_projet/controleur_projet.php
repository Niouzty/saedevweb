<?php
require_once 'modele_projet.php'; // Inclut le modèle qui gère la base de données

class ControleurProjet {
    private $modele;

    // Constructeur pour initialiser le modèle
    public function __construct() {
        $this->modele = new ModeleProjet();
    }

    // Afficher le formulaire de création de projet
    public function afficherFormulaire($message = '') {
        ob_start(); // Démarre la mise en tampon du contenu
        require_once 'vue_projet.php'; // Appeler la vue de la barre de navigation
        $content = ob_get_clean(); // Récupérer le contenu tamponné

        // Ajouter le formulaire à la vue principale
        require_once 'pages/vue_projet_form.php'; // Formulaire de création de projet
    }

    // Créer un projet
    public function cree_projet() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'] ?? '';
            $description = $_POST['description'] ?? '';
            $annee = $_POST['annee'] ?? '';
            $semestre = $_POST['semestre'] ?? '';

            if ($this->modele->sauvegarder($titre, $description, $annee, $semestre)) {
                $message = "Le projet a été enregistré avec succès !";
            } else {
                $message = "Erreur lors de l'enregistrement du projet.";
            }
            ob_start();
            require_once 'vue_projet.php';
            $content = ob_get_clean();

            require_once 'pages/vue_projet_form.php'; // Formulaire de projet avec message de succès
        } else {
            require_once 'pages/vue_projet.php';
            require_once 'pages/vue_projet_form.php';
        }
    }

    // Créer un rendu
    public function creerRendu() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'] ?? '';
            $description = $_POST['description'] ?? '';
            $dateLimite = $_POST['date_limite'] ?? '';

            if ($this->modele->sauvegarderRendu($titre, $description, $dateLimite)) {
                $message = "Le rendu a été créé avec succès !";
            } else {
                $message = "Erreur lors de la création du rendu.";
            }

            require_once 'pages/vue_rendu.php'; // Formulaire de création de rendu
        } else {
            require_once 'pages/vue_rendu.php'; // Formulaire de création de rendu
        }
    }

    // Lister les projets
    public function listerProjets() {
        $projets = $this->modele->getProjets();
        require_once 'pages/vue_liste_projets.php'; // Liste des projets
    }

    // Lister les rendus
    public function listerRendus() {
        $rendus = $this->modele->getRendus();
        require_once 'pages/vue_liste_rendus.php'; // Liste des rendus
    }
}
?>
