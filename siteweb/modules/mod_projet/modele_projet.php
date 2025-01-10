<?php

class ModeleProjet {
    public function sauvegarder($titre, $fichier) {
        $cheminDestination = __DIR__ . '/../../uploads/' . basename($fichier['nom']);

        // Vérifie que le répertoire des uploads existe, sinon le crée
        if (!is_dir(dirname($cheminDestination))) {
            mkdir(dirname($cheminDestination), 0755, true);
        }

        if (move_uploaded_file($fichier['nom'], $cheminDestination)) {
            // Ici, vous pouvez ajouter un enregistrement en base de données
            return true;
        }

        return false;
    }
}
?>
