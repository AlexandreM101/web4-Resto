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
    FROM plats
";

$stmt = $bdd->prepare($sql);
$stmt->execute();
$plats = $stmt->fetchAll();

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
        <?php foreach ($plats as $plat): ?>
        <li>
            <strong><?= $plat["nom"] ?></strong> <?= $plat["prix"] ?>
        </li>
        <?php endforeach ?>    
    </ul>
</body>
</html>