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

                // Récupération des données de consomations de la prise id
                $sql = "SELECT * FROM consommation WHERE Id_prise = '$id'";
                $consommations = $conn->query($sql);

            ?>
            <table>
                <h2>Consommation de la prise <?php echo $id; ?></h2>
                <tr>
                    <th></th>
                    <th>Date</th>
                    <th>Consommation</th>
                </tr>
                <?php
                    foreach ($consommations as $consommation) {
                        echo "<tr>";
                            echo "<td><a href='prise.php?id=".$consommation['Id_prise']."'><span class='material-symbols-outlined'>bolt</span></a></td>";
                            echo "<td>".$consommation['dateConsomation']."</td>";
                            echo "<td>".$consommation['valeur']."</td>";
                        echo "</tr>";
                    }
                ?>
            </table>

            <h2>Consommation moyenne</h2>
            <?php
                $sql = "SELECT AVG(valeur) as moyenne FROM consommation WHERE Id_prise = '$id'";
                $moyenne = $conn->query($sql);
                $moyenne = $moyenne->fetch_assoc();
                echo "<p>".$moyenne['moyenne']."</p>";
            ?>

            <h2>Télécharger les données de consommation sour forme csv</h2>
            <form action="prise.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" class="btn-connexion" name="telecharger" style="display: inline;">Télécharger</button>
            </form>
            <?php
                if (isset($_POST['telecharger'])) {
                    $id = $_POST['id'];
                    $sql = "SELECT valeur, dateConsomation, Id_prise FROM consommation WHERE Id_prise = '$id'";
                    $consommations = $conn->query($sql);

                    $file = fopen("consommation.csv", "w");
                    fputcsv($file, array('Valeure', 'Date', 'numerot de prise'));
                    foreach ($consommations as $consommation) {
                        fputcsv($file, $consommation);
                    }
                    fclose($file);

                    header("Location:consommation.csv");
                }
            ?>
        </div>
    </div>
</body>
</html>