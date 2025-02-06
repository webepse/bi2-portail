<?php
    // sécurité
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

    //vérifier si mon formulaire à été envoyé oui ou non?
    var_dump($_POST);



?>