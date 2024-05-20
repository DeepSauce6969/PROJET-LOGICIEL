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
            <!-- Données des capteurs de la résidence -->
            <?php
                include('includes/connect.php');

                // Récupérations de l'utilisateur
                session_start();
                $id = $_GET['id'];

                // Récupération des données des capteurs de la résidence
                $sql = "SELECT * FROM type_d_capteur WHERE Id_capteur = $id";
                $capteurs = $conn->query($sql);
            ?>
            <table>
                <tr>
                    <th></th>
                    <th>Type de donnee</th>
                    <th>Date</th>
                    <th>Valeur</th>
                </tr>
                <?php
                    foreach ($capteurs as $capteur) {
                        echo "<tr>";
                            echo "<td><a href='capteur.php?id=".$capteur['Id_capteur']."'><span class='material-symbols-outlined'>bolt</span></a></td>";
                            echo "<td>".$capteur['donnee']."</td>";
                            echo "<td>".$capteur['dateMesure']."</td>";
                            echo "<td>".$capteur['valeur']."</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
            
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            <script>
                window.onload = function () {
                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        theme: "light2",
                        title:{
                            text: "Evolution des données du capteur"
                        },
                        axisY: {
                            title: "Valeur"
                        },
                        data: [{
                            type: "line",
                            dataPoints: [
                                <?php
                                    foreach ($capteurs as $capteur) {
                                        echo "{ y: ".$capteur['valeur'].", label: '".$capteur['dateMesure']."' },";
                                    }
                                ?>
                            ]
                        }]
                    });
                    chart.render();
                }
            </script>
                

        </div>
    </div>
</body>
</html>