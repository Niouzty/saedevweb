require_once "vue_groupe.php";

class ControleurGroupe {
    public function afficherGestionGroupes() {
        $vue = new VueGroupe();
        $vue->afficherBarreDeNavigationGroupe();
    }

    public function afficherListeGroupes() {
        $vue = new VueGroupe();
        $groupes = $this->modele->getGroupes();
        $vue->afficherListeGroupes($groupes);
    }

    public function creerGroupe() {
        $vue = new VueGroupe();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomGroupe = $_POST['nom_groupe'] ?? '';
            $etudiants = $_POST['etudiants'] ?? [];

            if ($this->modele->creerGroupe($nomGroupe, $etudiants)) {
                $vue->afficherMessage("Groupe créé avec succès.", "success");
                header("Location: ?module=groupe&action=listeGroupes");
                exit;
            } else {
                $vue->afficherMessage("Erreur lors de la création du groupe.", "danger");
            }
        } else {
            $etudiants = $this->modele->getEtudiants();
            $vue->afficherFormulaireCreerGroupe($etudiants);
        }
    }

    public function afficherNotesGroupes() {
        $vue = new VueGroupe();
        $notes = $this->modele->getNotesGroupes();
        $vue->afficherNotesGroupes($notes);
    }
}
