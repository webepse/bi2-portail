<?php
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

// traitement de l'image
if(isset($_FILES['image']))
{
    if($_FILES['image']['error'] != 0)
    {
        header("LOCATION:updateSchools.php?id=".$id."&error=2");
        exit();
    }
    // init err
    $err = 0;

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
        $err=3;
    }

// vérifier le poids de mon image
    if($taille > $taille_maxi)
    {
        $err=4;
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
            $insert = $bdd->prepare("INSERT INTO images(fichier,id_etablissement) VALUES(:img,:etab)");
            $insert->execute([
                ":img" => $fichierCplt,
                ":etab" => $id
            ]);
            $insert->closeCursor();
            // rediriger vers le tableau des écoles avec un signalement que c'est ajouté
            header("LOCATION:updateSchools.php?id=".$id."&insert=success");
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
    header("LOCATION:updateSchools.php?id=".$id."&error=1");
    exit();
}



?>




