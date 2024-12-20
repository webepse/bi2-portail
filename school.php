<?php
    // besoin d'un id si pas d'id affichage erreur donc on fait une redirection
    // isset => si existe
    // empty => si vide mais existe
    // négation des fonctions ! 
    // n'existe pas => !isset
    if(isset($_GET['id']))
    {
        $id = htmlspecialchars($_GET['id']);
        // is_numeric => si c'est numérique
        // !is_numeric => si pas numérique
        if(!is_numeric($id))
        {
            header("LOCATION:404.php");
        }
    }else{
        header("LOCATION:404.php");
    }
    require "connexion.php";
    $req = $bdd->prepare("SELECT * FROM etablissements WHERE id=?");
    $req->execute([$id]);
    $don = $req->fetch();
    // vérifier si $don est vide
    if(!$don)
    {
        header("LOCATION:404.php");
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="slide" id="test">
      

    <?php

        echo $don['nom'];
    ?>
    </div>
  

    <script src="assets/script.js"></script>
</body>
</html>