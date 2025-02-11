<?php

include "includes/bdd.php";

$sql = "
    SELECT 
        id,  
        nom,
        acoter,
        prix,
        ingredients,
        prix
    FROM entrées
";

$stmt = $bdd->prepare($sql);
$stmt->execute();
$entres = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de donnés</title>
</head>
<body>
    <ul>
        <?php foreach ($entres as $entre): ?>
        <li>
            <strong><?= $entre["nom"] ?></strong> <?= $entre["prix"] ?>
        </li>
        <?php endforeach ?>    
    </ul>
</body>
</html>