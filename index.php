<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=ss, initial-scale=1.0">
    <title>Livre d'or</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbName = "livre d'or";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    if (isset($_POST) && !is_null($_POST) && count($_POST) != 0) {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $commentaire = $_POST["commentaire"];

        if ($nom != null || $nom != "" || $prenom != null || $prenom != "" || $commentaire != null || $commentaire != "") {
            // insert 
            try {
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO `commentaire` (`Nom`, `Prenom`, `commentaire`) VALUES ('$nom', '$prenom', '$commentaire')";
                $conn->exec($sql);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    // delete 
    if (isset($_GET) && count($_GET) != 0) {
        if ($_GET["a"] != '') {
            if ($_GET['a'] == 'd') {
                // delete
                $id = $_GET["id"];
                try {
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "DELETE FROM commentaire WHERE Id=:id";
                    $statement = $conn->prepare($sql);
                    $statement->bindParam(':id', $id, PDO::PARAM_INT);
                    $statement->execute();
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }
    }
    // affichage:
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM commentaire");
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $result = $stmt->fetchAll();

    // var_dump($_GET);
    ?>

    <h1>Livre d'or</h1>

    <div class="formulaire">
        <form action="./index.php" method="post" class="formulaire">
            <label for="nom"> Nom: </label>
            <input name="nom" type="text">
            <br>
            <label for="prénom"> Prénom: </label>
            <input name="prenom" type="text"> <br> <br>
            <label for="commentaire">Commentaire: </label>
            <textarea name="commentaire" id="" cols="50" rows="10"></textarea> <br>
            <input type="submit" value="Valider">
        </form>
    </div>



    <?php if (count($result) != 0) { ?>

        <div class="resutlat">
            <table>
                <tr>

                    <td>Nom: </td>
                    <td>Prenom: </td>
                    <td>Commentaire: </td>
                    <td>Action: </td>
                    <td>Action: </td>
                </tr>
                <?php

                foreach ($result as $user) { ?>
                    <tr>
                        <td><?php echo $user["Nom"] ?></td>
                        <td><?php echo $user["Prenom"] ?></td>
                        <td><?php echo $user["commentaire"] ?></td>
                        <td> <a href="index.php?a=d&id=<?php echo $user["Id"]; ?>">DELETE</a> </td>
                        <td> <a href="./modify-commentaire.php?id=<?php echo $user["Id"]; ?>&nom='<?php echo $user["Nom"]; ?> &prenom=<?php echo $user["Prenom"] ?> &commentaire=<?php echo $user["commentaire"] ?>'">MODIFY</a> </td>
                    </tr>
            <?php
                }
            }
            ?>
            </table>
        </div>

</body>

</html>