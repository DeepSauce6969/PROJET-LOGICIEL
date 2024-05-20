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
            <image src="images/logo.png" alt="Green Hub" class="image">
            <!-- Récupération des données de l'utilisateur -->
            <?php
                session_start();
                if (isset($_SESSION['pseudo'])) {
                    echo "<p style='color: #edf5f5;font-size: 20px;font-weight: bold;'>Bonjour " . $_SESSION['pseudo'] . "</p>";
                    echo "<a href='deconnexion.php' class='bouton-dashboard' style='margin-top: 90px;'>Se déconnecter</a>";
                    // Dashboard
                    echo "<div class='dashboard'>";
                    echo "<a href='dashboard.php' class='bouton-dashboard'>Dashboard</a>";
                    echo "</div>";
                }
                else {
                    echo "<div class='display-flex'>";
                    echo "<div><a href='loca-pro-connexion.html' class='bouton-dashboard'>Se connecter</a></div>";
                    echo "<div><a href='loca-pro-inscription.html' class='bouton-dashboard' style='margin-top: 90px;'>S'inscrire</a></div>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>
</body>
</html>