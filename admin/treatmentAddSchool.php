<?php
    // sécurité
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
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
            $description = $_POST['description'];
        }

       
        // tester s'il y a eu une erreur
        if($err == 0)
        {
            // traitement de l'image 
            if(isset($_FILES['image']))
            {
                if($_FILES['image']['error'] != 0)
                {
                    header("LOCATION:addSchools.php?error=6");
                    exit();
                }

                // gestion de l'image
                $dossier = '../images/';
                // fichier.jpg
                // basename(fichier.jpg) = fichier
                $fichier = basename($_FILES['image']['name']);
                $taille_maxi = 2000000;
                $taille = filesize($_FILES['image']['tmp_name']);
                $extensions = ['.png', '.jpg', '.jpeg'];
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
                        // insertion dans la base de données
                          // pas d'erreur avec l'image
                        // aller chercher la base de données (attention elle est à l'extérieur)
                        require "../connexion.php";
                        // insérer dans la base de données avec PDO et SQL
                        /** @var PDO $bdd */
                        $insert = $bdd->prepare("INSERT INTO etablissements(nom,introduction,description,image,categorie) VALUES(:nom,:intro,:descri,:img,:cat)");
                        $insert->execute([
                            ":nom" => $nom,
                            ":intro" => $introduction,
                            ":descri" => $description,
                            ":img" => $fichierCplt,
                            ":cat" => $categorie
                        ]);
                        $insert->closeCursor();
                        // rediriger vers le tableau des écoles avec un signalement que c'est ajouté
                        if($extension == ".jpg" || $extension == ".jpeg")
                        {
                            header("LOCATION:redim.php?image=".$fichierCplt);
                            exit();
                        }else{
                            header("LOCATION:redimpng.php?image=".$fichierCplt);
                            exit();
                        }
                    }else{
                        header("LOCATION:addSchools.php?error=8");
                        exit();
                    }

                }else{
                    header("LOCATION:addSchools.php?error=".$err);
                    exit();
                }




            }else{
                header("LOCATION:addSchools.php?error=5");
                exit();
            }



          
        }else{
            // il y a eu au moins une erreur
            // rediriger vers le formulaire avec le code erreur généré
            header("LOCATION:addSchools.php?error=".$err);
            exit();
        }


    }else{
        header("LOCATION:addSchools.php");
        exit();
    }



  

?>