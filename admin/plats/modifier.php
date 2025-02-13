<?php

include "../../includes/bdd.php";


if (empty($_POST))
{ 
    //affichage du form
    $id = $_GET["id"];
    
    $sql = "
    
        SELECT *
        FROM plats
        WHERE id = :id
    ";
    
    $stmt = $bdd->prepare($sql);
    $stmt->execute([
        ":id" => $id,
    ]);
    $plat = $stmt->fetch();

}
else 
{
    //traitement du form

    $nom = $_POST["nom"];
    $acoter = $_POST["acoter"];
    $prix = $_POST["prix"];
    $ingredients = $_POST["ingredients"];
    $image = $_POST["image"];
    $id = $_POST["id"];

    //toujours avoir une condition comme le delete
    $sql = "
      UPDATE plats
      SET 
        nom = :nom,
        acoter = :acoter,
        prix = :prix,
        ingredients = :ingredients,
        image = :image
      WHERE
        id = :id
    ";

    $stmt = $bdd->prepare($sql);
    $stmt->execute([
        ":id" => $id,
        ":nom" => $nom,
        ":acoter" => $acoter,
        ":prix" => $prix,
        ":ingredients" => $ingredients,
        ":image" => $image,
    ]);


    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <link rel="stylesheet" href="../../css/ajoute.css">
</head>
<body>
    <p>
        <a class = "retour" href="index.php">Retour</a>
    </p>
    <h1>Modifier</h1>
    <form action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $plat["id"] ?>">

        <div class="txt">
            <p>Nom:</p>
            <input type="text" name="nom" value="<?= $plat["nom"] ?>">
        </div>

        <div class="txt">
            <p>Acoter:</p>
            <input type="text" name="acoter" value="<?= $plat["acoter"] ?>">
        </div>
        
        <div class="txt">
            <p>Prix:</p>
            <input type="text" name="prix" value="<?= $plat["prix"] ?>">
        </div>
        
        <div class="txt">
            <p>Ingredients:</p>
            <input type="text" name="ingredients" value="<?= $plat["ingredients"] ?>">
        </div>
        
        <div class="image">
            <p>image:</p>
            <input type="file" name="image" value="<?= $plat["image"] ?>">
        </div>
        <div class="bouton">
            <p>
                <input type="submit" value="Modifier">
            </p>
        </div>
    </form>
</body>
</html>
