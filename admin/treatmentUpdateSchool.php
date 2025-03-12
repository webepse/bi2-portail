<?php
    // sécurité
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
        exit();
    }

       // gestion de la dépendance du GET id
       if(isset($_GET['id']))
       {
           $id = htmlspecialchars($_GET['id']);
       }else{
           header("LOCATION:schools.php");
       }
   
       require "../connexion.php";
       // requête à la bdd
       $school = $bdd->prepare("SELECT * FROM etablissements WHERE id=?");
       $school->execute([$id]);
       $donSchool = $school->fetch();
       $school->closeCursor();
       if(!$donSchool)
       {
           header("LOCATION:schools.php");
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
            $update = $bdd->prepare("UPDATE etablissements SET nom=:nom, introduction=:intro, description=:descri, image=:img, categorie=:cat WHERE id=:myid");
            $update->execute([
                ":nom" => $nom,
                ":intro" => $introduction,
                ":descri" => $description,
                ":img" => $image,
                ":cat" => $categorie,
                ":myid" => $id
            ]);
            $update->closeCursor();

            // rediriger vers le tableau des écoles avec un signalement que c'est ajouté
            header("LOCATION:schools.php?update=".$id);
        }else{
            // il y a eu au moins une erreur
            // rediriger vers le formulaire avec le code erreur généré
            header("LOCATION:addSchools.php?error=".$err);
        }


    }else{
        header("LOCATION:updateSchools.php?id=".$id);
    }



  

?>