<?php
// sécurité
session_start();
if(!isset($_SESSION['login']))
{
    header("LOCATION:index.php");
    exit();
}

//vérifier si mon formulaire à été envoyé oui ou non?
if(isset($_POST['login']))
{
    require "../connexion.php";
    // vérifier si mon formulaire à envoyé des données (pas vide)
    // initialiser une variable erreur à 0 pour dire pas encore d'erreur à ce stade
    $err=0;

    // tester chaque name du form
    if(empty($_POST['login']))
    {
        $err=1;
    }else{
        $login = htmlspecialchars($_POST['login']);
        $req = $bdd->prepare("SELECT * FROM admin WHERE login=?");
        $req->execute([$login]);
        if($don = $req->fetch())
        {
            $err=2;
        }
        $req->closeCursor();
    }

    if(empty($_POST['password']))
    {
        $err=3;
    }else{
        $hash = password_hash($_POST['password'],PASSWORD_BCRYPT);
    }

    // tester s'il y a eu une erreur
    if($err == 0)
    {
        
        // insérer dans la base de données avec PDO et SQL
        $insert = $bdd->prepare("INSERT INTO admin(login, password) VALUES(:login,:pass)");
        $insert->execute([
            ":login" => $login,
            ":pass" => $hash
        ]);
        $insert->closeCursor();
        // rediriger vers le tableau des écoles avec un signalement que c'est ajouté
        header("LOCATION:members.php?insert=success");
        exit();

    }else{
        // il y a eu au moins une erreur
        // rediriger vers le formulaire avec le code erreur généré
        header("LOCATION:addMember.php?error=".$err);
        exit();
    }


}else{
    header("LOCATION:addMember.php");
    exit();
}





?>