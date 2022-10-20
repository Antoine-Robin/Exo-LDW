<?php

var_dump($_GET);

$result = $_GET;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

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