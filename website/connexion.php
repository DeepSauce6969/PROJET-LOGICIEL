<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
            <form action="connexion.php" method="post">
        <div class="content-connexion">
            <p>Se connecter</p>
            <!-- <a href="login.html" class="btn-connexion">Se connecter avec Email<image src="images/email.png" class="image-connexion"></a> -->
            <input type="text" name="email" placeholder="Email" class="input-connexion">
            <input type="password" name="password" placeholder="Mot de passe" class="input-connexion">
            <!-- Bouton de connexion -->
            <input type="submit" value="Se connecter" class="btn-connexion" style="padding: 0px;">
            <a href="login.html" class="btn-connexion">Se connecter avec Google<image src="images/google.png" class="image-connexion"></image></a>
            <a href="login.html" class="btn-connexion">Se connecter avec Facebook<image src="images/facebook.png" class="image-connexion"></image></a>
            
        </div>
        </form>
        <?php
            include('includes/connect.php');
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $sql = "SELECT * FROM utilisateur WHERE mail = '$email' AND mdp = '$password'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // Mise en session de l'utilisateur
                    session_start();
                    $row = $result->fetch_assoc();
                    $_SESSION['pseudo'] = $row['pseudo'];
                    $_SESSION['nom'] = $row['nom'];
                    // Redirection vers la page d'accueil
                    header('Location: index.php');
                } else {
                    echo "Email ou mot de passe incorrect";
                }
            }
            $conn->close();
        ?>
    </div>
</body>
</html>