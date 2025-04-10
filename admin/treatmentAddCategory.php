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

    // tester s'il y a eu une erreur
    if($err == 0)
    {

        // insertion dans la base de données
        require "../connexion.php";
        // insérer dans la base de données avec PDO et SQL
        $insert = $bdd->prepare("INSERT INTO categories(nom) VALUES(:nom)");
        $insert->execute([
            ":nom" => $nom,
        ]);
        $insert->closeCursor();
        // rediriger vers le tableau des écoles avec un signalement que c'est ajouté
        header("LOCATION:categories.php?insert=success");
        exit();

    }else{
        // il y a eu au moins une erreur
        // rediriger vers le formulaire avec le code erreur généré
        header("LOCATION:addCategory.php?error=".$err);
        exit();
    }


}else{
    header("LOCATION:addCategory.php");
    exit();
}





?>