require_once "controleur_groupe.php";

class ModuleGroupe extends ModuleGenerique {
    public function __construct() {
        $this->controleur = new ControleurGroupe();

        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'gestionGroupes':
                    $this->controleur->afficherGestionGroupes();
                    break;
                case 'listeGroupes':
                    $this->controleur->afficherListeGroupes();
                    break;
                case 'creerGroupe':
                    $this->controleur->creerGroupe();
                    break;
                case 'notesGroupes':
                    $this->controleur->afficherNotesGroupes();
                    break;
                default:
                    echo "Action non reconnue.";
                    break;
            }
        } else {
            $this->controleur->afficherGestionGroupes();
        }
    }

    protected function creerControleur() {
        $this->controleur = new ControleurGroupe();
    }
}
