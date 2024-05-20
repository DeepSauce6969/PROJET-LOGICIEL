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
                $pseudo = $_SESSION['pseudo'];

                // Récupération des résidences de l'utilisateur
                $sql = "SELECT * FROM residence WHERE pseudo = '$pseudo'";
                $residences = $conn->query($sql);

                // Résidence du même secteur
                $sql = "SELECT * FROM residence WHERE secteur = (SELECT secteur FROM residence WHERE pseudo = '$pseudo') AND pseudo != '$pseudo'";
                $residences_secteur = $conn->query($sql);
                
            ?>

            <table style="color: white; font-size: 22px;">
                <h2>Résidences de l'utilisateur <?php echo $pseudo; ?></h2>
                <tr>
                    <th><a style="font: size 25px;" href="ajouterResidence.php"><span class="material-symbols-outlined">add_circle</span></a></th>
                    <th>Ville</th>
                    <th>Adresse</th>
                    <th>Secteur</th>
                    <th>Consomations de la journée</th>
                </tr>
                <?php
                    foreach ($residences as $residence) {
                        echo "<tr>";
                            echo "<td><a href='residence.php?id=".$residence['Id_residence']."'><span class='material-symbols-outlined'>home</span></a></td>";
                            echo "<td>".$residence['ville']."</td>";
                            echo "<td>".$residence['adresse']."</td>";
                            echo "<td>".$residence['secteur']."</td>";
                            // Récupération de toutes les consommations de la résidence
                            $sql = "SELECT * FROM prise WHERE Id_residence = ".$residence['Id_residence'];
                            $prises = $conn->query($sql);
                            $consommation = 0;
                            foreach ($prises as $prise) {
                                $sql = "SELECT * FROM consommation WHERE Id_prise = ".$prise['Id_prise'];
                                $moyenne = $conn->query($sql);
                                foreach ($moyenne as $cons) {
                                    $consommation += $cons['valeur'];
                                }
                            }
                            echo "<td>".$consommation." W</td>";
                        echo "</tr>";
                    }
                ?>
            </table>

            <h2>Résidences du même secteur</h2>
            <table style="color: white; font-size: 22px;">
                <tr>
                    <th></th>
                    <th>Ville</th>
                    <th>Adresse</th>
                    <th>Secteur</th>
                </tr>
                <?php
                    if ($residences_secteur->num_rows > 0) {
                        foreach ($residences_secteur as $residence) {
                            echo "<tr>";
                                echo "<td><a href='residence.php?id=".$residence['Id_residence']."'><span class='material-symbols-outlined'>home</span></a></td>";
                                echo "<td>".$residence['ville']."</td>";
                                echo "<td>".$residence['adresse']."</td>";
                                echo "<td>".$residence['secteur']."</td>";
                                
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                            echo "<td colspan='4'>Aucune résidence dans le même secteur</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
    </div>
</body>
</html>