<?php

include "../includes/bdd.php";


if (empty($_POST))
{ 
    //affichage du form
    $id = $_GET["id"];
    
    $sql = "
    
        SELECT *
        FROM entrées
        WHERE id = :id
    ";
    
    $stmt = $bdd->prepare($sql);
    $stmt->execute([
        ":id" => $id,
    ]);
    $entre = $stmt->fetch();

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
      UPDATE entrées
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
</head>
<body>
    <p>
        <a href="index.php">Retour</a>
    </p>
    <h1>Modifier</h1>
    <form action="" method="post">

        <input type="hidden" name="id" value="<?= $entre["id"] ?>">
        <p>Nom:</p>
        <input type="text" name="nom" value="<?= $entre["nom"] ?>">

        <p>Acoter:</p>
        <input type="text" name="acoter" value="<?= $entre["acoter"] ?>">
        
        <p>Prix:</p>
        <input type="text" name="prix" value="<?= $entre["prix"] ?>">
        
        <p>Ingredients:</p>
        <input type="text" name="ingredients" value="<?= $entre["ingredients"] ?>">
        
        <p>image:</p>
        <input type="file" name="image" value="<?= $entre["image"] ?>">
        <p>
            <input type="submit" value="Modifier">
        </p>
    </form>
</body>
</html>
