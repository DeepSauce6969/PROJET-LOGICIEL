<!DOCTYPE html>
<html>
    <head>
        <title>Inscription</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="container">
            <form action="inscription.php" method="post">
                <div class="content-connexion">
                    <p>S'inscrire</p>
                    <input type="text" name="pseudo" placeholder="Pseudo" class="input-connexion" require>
                    <input type="text" name="nom" placeholder="Nom" class="input-connexion" require>
                    <input type="text" name="prenom" placeholder="Prénom" class="input-connexion" require>
                    <input type="text" name="email" placeholder="Email" class="input-connexion" require>
                    <input type="password" name="password" placeholder="Mot de passe" class="input-connexion" require>
                    
                    <!-- Choix du type d'utilisateur -->
                    <?php $type = $_GET['jesuis']; ?>
                    <input hidden type="text" name="jesuis" value="<?php echo $type; ?>" class="input-connexion" require>
                    <!-- Bouton de connexion -->
                    <input type="submit" value="S'inscrire" class="btn-connexion" style="padding: 0px;">

                    <!-- Connexion avec Google et Facebook -->

                    <a href="login.html" class="btn-connexion">S'inscrire avec Google<image src="images/google.png" class="image-connexion"></image></a>
                    <a href="login.html" class="btn-connexion">S'inscrire avec Facebook<image src="images/facebook.png" class="image-connexion"></image></a>
                </div>
            <form>
                <?php
                    include('includes/connect.php');
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        // On rempli la table utilisateur
                        $pseudo =   $_POST['pseudo'];
                        $nom =      $_POST['nom'];
                        $prenom =   $_POST['prenom'];
                        $email =    $_POST['email'];
                        $password = $_POST['password'];

                        $type = $_POST['jesuis'];

                        $sql = "INSERT INTO utilisateur (pseudo, nom, prenom, mail, mdp, type) VALUES ('$pseudo', '$nom', '$prenom', '$email', '$password', '$type')";
                        $conn->query($sql);

                        // Si il est locataire

                        // Mise en session de l'utilisateur
                        session_start();
                        $_SESSION['pseudo'] = $pseudo;
                        $_SESSION['nom'] = $nom;
                        // Redirection vers la page d'accueil
                        header('Location: index.php');
                    }
                    $conn->close();
                ?>
        </div>
    </body>
</html>