<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="left">
            <a href="loca-pro-connexion.html">Se connecter</a>
            <a href="loca-pro-inscription.html">S'inscrire</a>
        </div>
        <div class="middle">
            <a href="index.php">GREEN HUB</a>
        </div>
        <div class="right">
            <a href="contact.html">Contact</a>
        </div>
    </nav>
    <div class="container">
        <div class="content">
            <!-- Formaulaire d'ajout de résidence -->
            <form action="ajouterResidence.php" method="post">
                <h2>Ajouter une résidence</h2>
                <input type="text" name="ville" placeholder="Ville" require>
                <input type="text" name="adresse" placeholder="Adresse" require>
                <input type="text" name="secteur" placeholder="Secteur">
                <!-- Spécifications du nombre de prises et de capteur -->
                <button type="submit" class="btn-connexion" name="ajouterResidence" style="display: inline;">Ajouter</button>
            </form>
            <?php
                include('includes/connect.php');

                // Récupérations de l'utilisateur
                session_start();
                $pseudo = $_SESSION['pseudo'];

                // Requette sql pour ajouter la résidence dans la table 
                if (isset($_POST['ajouterResidence'])) {
                    $ville = $_POST['ville'];
                    $adresse = $_POST['adresse'];
                    $secteur = $_POST['secteur'];

                    $sql = "INSERT INTO residence (ville, adresse, secteur, pseudo) VALUES ('$ville', '$adresse', '$secteur', '$pseudo')";
                    $conn->query($sql);

                    // redirection vers la page dashboard.php
                    header("Location:dashboard.php");
                }
            ?>
        </div>
    </div>
</body>
</html>