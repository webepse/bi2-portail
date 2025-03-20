<?php

    if(isset($_POST["firstname"])){

        $err = 0;

        if(empty($_POST["firstname"])){
            $err = 1;
        }else{
            $firstname = htmlspecialchars($_POST["firstname"]);
        }

        if(empty($_POST["lastname"])){
            $err = 2;
        }else{
            $lastname = htmlspecialchars($_POST["lastname"]);
        }

        if(empty($_POST["email"])){
            $err = 3;
        }else{
            $email = htmlspecialchars($_POST["email"]);
        }

        if(empty($_POST["message"]))
        {
            $err = 4;
        }else{
            $message = htmlspecialchars($_POST["message"]);
        }

        if($err == 0){
            require "connexion.php";
            $insert = $bdd->prepare("INSERT INTO contact(firstname,lastname,email,message,date) VALUES(:firstname, :lastname, :email, :message, NOW())");
            $insert->execute([
                ":firstname" => $firstname,
                ":lastname" => $lastname,
                ":email" => $email,
                ":message" => $message
            ]);
            $insert->closeCursor();
            header("LOCATION:index.php?contact=success#contact");
            exit();
        }else{
            header("LOCATION:index.php?error=".$err."#contact");
            exit();
        }
    }else{
        header("LOCATION:index.php");
        exit();
    }


?>