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
        header("LOCATION:categories.php");
        exit();
    }
}else{
    header("LOCATION:categories.php");
    exit();
}

require "../connexion.php";
// requête à la bdd
$category = $bdd->prepare("SELECT * FROM categories WHERE id=?");
$category->execute([$id]);
$donCat = $category->fetch();
$category->closeCursor();
if(!$donCat)
{
    header("LOCATION:categories.php");
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

    // tester s'il y a eu une erreur
    if($err == 0)
    {

        // update dans la base de données
       $update = $bdd->prepare("UPDATE categories SET nom=:nom WHERE id=:myid");
       $update->execute([
           ":nom" => $nom,
           ":myid" => $id
       ]);
       $update->closeCursor();
        // rediriger vers le tableau des écoles avec un signalement que c'est ajouté
        header("LOCATION:categories.php?update=".$id);
        exit();

    }else{
        // il y a eu au moins une erreur
        // rediriger vers le formulaire avec le code erreur généré
        header("LOCATION:updateCategory.php?id=".$id."&error=".$err);
        exit();
    }


}else{
    header("LOCATION:updateCategory.php?id=".$id);
    exit();
}





?>