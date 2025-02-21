<?php
// Tableau à stocker
$data = [];

// Convertir le tableau en JSON
$jsonData = json_encode($data, JSON_PRETTY_PRINT);

// Chemin du fichier
$file = "data.json";

// Écrire dans le fichier
if (file_put_contents($file, $jsonData)) {
    echo "Données enregistrées dans le fichier JSON avec succès !";
} else {
    echo "Erreur lors de l'écriture dans le fichier.";
}
?>