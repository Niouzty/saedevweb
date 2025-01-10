<?php

class ModuleProjet {
    public function run($action) {
        require_once 'controleur_projet.php';
        $controller = new ControleurProjet();

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            echo "Erreur : Action '$action' introuvable.";
        }
    }
}
?>
