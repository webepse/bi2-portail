<?php
    // sécurité
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }
    
    //vérifier si mon formulaire à été envoyé oui ou non?
    if(isset($_POST['nom']))
    {

        // vérifier si mon formulaire à envoyé des données (pas vide)
        // initialiser une variable erreur à 0 pour dire pas encore d'erreur à ce stade
        $err=0;
        
        // tester chaque name du form
        if(empty($_POST['nom']))
        {
            // vrai
            $err=1;
        }else{
            // faux
            // protection de la données pcq elle vient de l'extérieur
            $nom = htmlspecialchars($_POST['nom']);
        }

        if(empty($_POST['categorie']))
        {
            $err=2;
        }else{
            $categorie = htmlspecialchars($_POST['categorie']);
        }

        if(empty($_POST['introduction']))
        {
            $err=3;
        }else{
            $introduction = htmlspecialchars($_POST['introduction']);
        }

        if(empty($_POST['description']))
        {
            $err=4;
        }else{
            $description = htmlspecialchars($_POST['description']);
        }

        if(empty($_POST['image']))
        {
            $err=5;
        }else{
            $image = htmlspecialchars($_POST['image']);
        }


        // tester s'il y a eu une erreur
        if($err == 0)
        {
            // pas d'erreur
            // insertion dans la base de données
            // aller chercher la base de données (attention elle est à l'extérieur)
            require "../connexion.php";
            // insérer dans la base de données avec PDO et SQL
            $insert = $bdd->prepare("INSERT INTO etablissements(nom,introduction,description,image,categorie) VALUES(:nom,:intro,:descri,:img,:cat)");
            $insert->execute([
                ":nom" => $nom,
                ":intro" => $introduction,
                ":descri" => $description,
                ":img" => $image,
                ":cat" => $categorie
            ]);
            $insert->closeCursor();

            // rediriger vers le tableau des écoles avec un signalement que c'est ajouté
            header("LOCATION:schools.php?insert=success");
        }else{
            // il y a eu au moins une erreur
            // rediriger vers le formulaire avec le code erreur généré
            header("LOCATION:addSchools.php?error=".$err);
        }


    }else{
        header("LOCATION:addSchools.php");
    }



  

?>