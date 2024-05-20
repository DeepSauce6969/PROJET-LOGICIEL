<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
            <!-- Liste des résidences de l'utilisateur sour forme de tableau -->
            <?php
                include('includes/connect.php');

                // Récupérations de l'utilisateur
                session_start();
                $id_residence = $_GET['id'];

                // Récupération des données de prises de la résidence et de leurs consomations

                $sql = "SELECT * FROM prise WHERE Id_residence = $id_residence";
                $prises = $conn->query($sql);

                // Récupérations des donnée des capteurs de la résidence
                $sql = "SELECT * FROM capteur WHERE Id_residence = $id_residence";
                $capteurs = $conn->query($sql);

                
            ?>

            <table style="color: white; font-size: 22px;">
                <h1>Prises de la résidence n°<?php echo $id_residence; ?></h1>
                <tr>
                    <th></th>
                    <th>Eta de la prise</th>
                    <th>Nom</th>
                    <th>Consommation</th>
                </tr>
                <?php
                    foreach ($prises as $prise) {
                        echo "<tr>";
                            echo "<td><a href='prise.php?id=".$prise['Id_prise']."'><span class='material-symbols-outlined'>bolt</span></a></td>";
                            // Afficher fonctione si 1 et Aret si 0
                            if($prise['eta'] == 1){
                                echo "<td>Fonctionne</td>";
                            }else{
                                echo "<td>Arrêt</td>";
                            }
                            echo "<td>".$prise['nom']."</td>";
                            // Récupération de toutes les consommations de la prise
                            $sql = "SELECT * FROM consommation WHERE Id_prise = ".$prise['Id_prise'];
                            $moyenne = $conn->query($sql);

                            echo "<td>";    
                            foreach ($moyenne as $consommation) {
                                echo $consommation['valeur']." W";
                            }
                            echo "</td>";


                        echo "</tr>";
                    }
                ?>
            </table>
            <h2>Capteurs de la résidence n°<?php echo $id_residence; ?></h2>
            <table style="color: white; font-size: 22px;">
                <tr>
                    <th></th>
                    <th>ID
                </tr>
                <?php
                    foreach ($capteurs as $capteur) {
                        echo "<tr>";
                            echo "<td><a href='capteur.php?id=".$capteur['Id_capteur']."'><span class='material-symbols-outlined'>bolt</span></a></td>";
                            echo "<td>".$capteur['Id_capteur']."</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>