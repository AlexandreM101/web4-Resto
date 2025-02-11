<?php
include "../includes/bdd.php";

if (!empty($_GET["supprimer"])) {
    $sql = "
        DELETE FROM plats
        WHERE id = :id
    ";

    $stmt = $bdd->prepare($sql);
    $stmt ->execute([
        ":id" => $_GET["supprimer"],
    ]);

    header("location: index.php");
}

$sql = "
    SELECT 
        id, 
        nom,
        acoter,
        prix,
        ingredients,
        image
    FROM plats
    ORDER BY 
    nom ASC
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
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="all">
        <h1>Zone admin</h1>
        
        <div class="nav">
            <h2>Liste des repas</h2>
            
            <p>
                <a class= "ajoute" href="ajoute.php">Ajouter un élément au menu</a>
            </p>
        </div>
        <div class="box">
            <?php foreach ($plats as $plat): ?>
                <div class="menu">
                    <p class="name"><?= $plat["nom"] ?></p>
                    <p><?= $plat["prix"] ?></p>
                    <!-- <img src="<?= $plat["image"]?>" alt=""> -->
                    <div class="link">
                        <a href="modifier.php?id=<?= $plat["id"]?>">Modifier</a>
                        <a href="index.php?supprimer=<?= $plat["id"]?>">Supprimer</a>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
    </div>
</body>
</html>