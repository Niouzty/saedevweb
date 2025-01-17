<?php

class ModuleRessource {
    public function run($action) {
        require_once 'controleur_ressources.php';
        $controller = new ControleurRessource();

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            echo "Erreur : Action '$action' introuvable.";
        }
    }
}
?>