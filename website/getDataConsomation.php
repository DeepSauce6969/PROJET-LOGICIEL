<?php

    include 'includes/connect.php';

    // URL du fichier JSON
    $json_url = "test.json";

    // Récupération du contenu du fichier JSON
    $json_data = file_get_contents($json_url);

    // Vérification si la récupération a réussi
    if ($json_data === false) {
        die("Erreur lors de la récupération du fichier JSON.");
    }

    // Conversion du JSON en tableau associatif
    $json_array = json_decode($json_data, true);

    // Récupération des données des prises
    $prises = $json_array['result'];

    // Préparation de la requête SQL pour l'insertion des données des prises
    $sql = "INSERT INTO prise (eta, nom, Id_residence) VALUES (?, ?, ?)";

    // Préparation de la déclaration pour l'exécution répétée
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $eta, $nom, $id_residence);

    // Parcours des données des prises et insertion dans la base de données
    foreach ($prises as $prise) {
        $eta = 1; // Valeur à déterminer en fonction des données de la prise
        $nom = $prise['Name']; // Nom de la prise
        $id_residence = 1; // Valeur à déterminer en fonction de la résidence associée à la prise
        $stmt->execute();
    }

    // Fermeture de la connexion
    $stmt->close();

    // Ajouter les valeurs mesuré dans le fichier
    $sql = "INSERT INTO consommation (valeur, dateConsomation, Id_prise) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $valeur, $date, $id_prise);

    foreach ($prises as $prise) {
        $id_prise = 1; // Valeur à déterminer en fonction de la prise associée à la consommation
        // Data = "3.6 Watt"
        // On récupère seulement la donnée numérique en float
        $prise['Data'] = explode(" ", $prise['Data'])[0];

        $valeur = $prise['Data']; // Valeur de la consommation
        $date = $prise['LastUpdate']; // Date de la consommation
        $stmt->execute();
    }

    // Fermeture de la connexion
    $stmt->close();
    $conn->close();

    echo "Les données des prises ont été insérées avec succès dans la base de données.";

?>
