<?php

include "../../includes/bdd.php";

if (!empty($_POST))
{
    $nom = $_POST["nom"];
    $acoter = $_POST["acoter"];
    $prix = $_POST["prix"];
    $ingredients = $_POST["ingredients"];
    $cheminImage = null;
    if (!empty($_FILES["image"]["name"]))
    {
        $dossierUpload = "../../images/";
        $cheminImage = $dossierUpload . basename($_FILES["image"]["name"]);

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $cheminImage))
        {
            die ("File upload failed");
        }
    }


    $sql = "
        INSERT INTO plats
            (nom,acoter,prix,ingredients,image)
        VALUES
            (:nom,:acoter,:prix,:ingredients,:image) 
    ";

    $stmt = $bdd->prepare($sql);
    $stmt->execute([
        ":nom" => $nom,
        ":acoter" => $acoter,
        ":prix" => $prix,
        ":ingredients" => $ingredients,
        ":image" => $cheminImage,
    ]);


    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un repas</title>
    <link rel="stylesheet" href="../../css/ajoute.css">
    
</head>
<body>
    <p>
        <a href="index.php">Retour</a>
    </p>
    <h1>Ajouter</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="txt">
            <p>Nom:</p>
            <input type="text" name="nom">
        </div>

        <div class="txt">
            <p>Acoter:</p>
            <input type="text" name="acoter">
        </div>

        <div class="txt">
            <p>Prix:</p>
            <input type="text" name="prix">
        </div>

        <div class="txt">
            <p>Ingredients:</p>
            <input type="text" name="ingredients">
        </div>

        <div class="image">
            <p>image</p>
            <input type="file" name="image">
        </div>

        <div class="bouton">
            <p>
                <input type="submit" value="Ajouter">
            </p>
        </div>
    </form>
</body>
</html>
