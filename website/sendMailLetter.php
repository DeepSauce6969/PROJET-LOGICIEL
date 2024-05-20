<?php

    // Démarrage de la session
    session_start();

    // Récupération du pseudo de l'utilisateur en session
    if (!isset($_SESSION['pseudo'])) {
        die("Erreur: Session non trouvée.");
    }
    $pseudo = $_SESSION['pseudo'];

    // Inclusion du fichier de connexion à la base de données
    include 'includes/connect.php';

    // Récupération de l'e-mail de l'utilisateur
    $sql = "SELECT mail FROM utilisateur WHERE pseudo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $pseudo);
    $stmt->execute();
    $stmt->bind_result($mail);
    $stmt->fetch();
    $stmt->close();

    // Vérification si l'e-mail a été trouvé
    if (!$mail) {
        die("Erreur: Adresse e-mail non trouvée.");
    }

    // Configuration de l'e-mail
    $to = $mail;
    $subject = "Ouverture de la boîte aux lettres";
    $message = "Bonjour, votre boîte aux lettres a été ouverte.";

    // Envoi de l'e-mail
    if (mail($to, $subject, $message)) {
        echo "L'e-mail a été envoyé avec succès.";
    } else {
        echo "Erreur lors de l'envoi de l'e-mail.";
    }

?>
