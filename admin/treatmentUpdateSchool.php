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
       if(!is_numeric($id))
       {
           header("LOCATION:schools.php");
           exit();
       }
   }else{
       header("LOCATION:schools.php");
       exit();
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
       exit();
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
         // test suivant par exemple vérifier le nombre de lettre ou si 'il y a des chiffres
         // si erreur = $err=6;
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

    
     // tester s'il y a eu une erreur
     if($err == 0)
     {
        // modif sans fichier
        // modif avec fichier

         // traitement de l'image 
         if(!empty($_FILES['image']['name']))
         {
             if($_FILES['image']['error'] != 0)
             {
                 header("LOCATION:updateSchools.php?id=".$id."&error=6");
                 exit();
             }

             // gestion de l'image
             $dossier = '../images/';
             // fichier.jpg
             // basename(fichier.jpg) = fichier
             $fichier = basename($_FILES['image']['name']);
             $taille_maxi = 2000000;
             $taille = filesize($_FILES['image']['tmp_name']);
             $extensions = ['.png', '.gif', '.jpg', '.jpeg'];
             // .jpg
             $extension = strrchr($_FILES['image']['name'], '.');

             // vérifier si une valeur existe dans un tableau in_array(ce que tu cherches, le tableau)
             if(!in_array($extension,$extensions))
             {
                 $err=7;
             }

             // vérifier le poids de mon image
             if($taille > $taille_maxi)
             {
                 $err=8;
             }

             // vérifier si erreur
             if($err==0)
             {
                 // protection du nom du fichier 
                 // sur linux je ne peux avoir un fichier qui possède des kk spéciaux
                 //On formate le nom du fichier, strtr remplace tous les KK spéciaux en normaux suivant notre liste
                 // spéciaux(.jpg)
                 // speciaux(.jpg)
                 $fichier = strtr($fichier,
                 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                 // speci aux(.jpg)
                 // speci-aux(.jpg)
                 $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier); // preg_replace remplace tout ce qui n'est pas KK normal en tiret

                 // pour éviter le conflit

                 // $fichier = monimage.jpg
                 // rand() => 1561561561
                 // $fichierCplt = 1561561561monimage.jpg
                 $fichierCplt = rand().$fichier;
                                                                     // ../images/1561561561monimage.jpg
                 if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier.$fichierCplt))
                 {
                    // supprimer l'ancienne image du dossier /images/
                    unlink("../images/".$donSchool['image']);

                     // update dans la base de données avec PDO et SQL
                     $update = $bdd->prepare("UPDATE etablissements SET nom=:nom, introduction=:intro, description=:descri, image=:img, categorie=:cat WHERE id=:myid");
                    $update->execute([
                        ":nom" => $nom,
                        ":intro" => $introduction,
                        ":descri" => $description,
                        ":img" => $fichierCplt,
                        ":cat" => $categorie,
                        ":myid" => $id
                    ]);
                    $update->closeCursor();
                    header("LOCATION:schools.php?update=".$id);
                    exit();
                 }else{
                     header("LOCATION:updateSchools.php?id=".$id."&error=8");
                     exit();
                 }

             }else{
                 header("LOCATION:updateSchools.php?id=".$id."&error=".$err);
                 exit();
             }




         }else{
           // modif sans fichier
            // update dans la base de données
            // update dans la base de données avec PDO et SQL
            $update = $bdd->prepare("UPDATE etablissements SET nom=:nom, introduction=:intro, description=:descri, categorie=:cat WHERE id=:myid");
            $update->execute([
                ":nom" => $nom,
                ":intro" => $introduction,
                ":descri" => $description,
                ":cat" => $categorie,
                ":myid" => $id
            ]);
            $update->closeCursor();
            header("LOCATION:schools.php?update=".$id);
            exit();
         }



       
     }else{
         // il y a eu au moins une erreur
         // rediriger vers le formulaire avec le code erreur généré
         header("LOCATION:updateSchools.php?id=".$id."&error=".$err);
         exit();
     }


 }else{
     header("LOCATION:updateSchools.php?id=".$id);
     exit();
 }



  

?>


