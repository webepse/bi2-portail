<?php
    session_start();

    if(isset($_SESSION['login']))
    {
        header("LOCATION:dashboard.php");
    }

    // vérifier si le formulaire est envoyé ou non?
    if(isset($_POST['login']) && isset($_POST['password']))
    {
        // traiter les informations
        if(empty($_POST['login']) || empty($_POST['password']))
        {
            $error = "Veuillez remplir correctement le formulaire";
        }else{
            // protèger les éléments (le mot de passe pas besoin)
            $login = htmlspecialchars($_POST['login']);
            // vérifier si login existe dans ma bdd
            // besoin de connexion (attention connexion il est à l'extérieur de admin)
            require "../connexion.php";
            // req à la bdd
            $req = $bdd->prepare("SELECT * FROM admin WHERE login=?");
            $req->execute([$login]);
            // récup la réponse (fetch) et stock dans $don 
            $don = $req->fetch();
            // vérifier si $don est vide ou non
            if(!$don)
            {
                $error = "Votre login ou votre mot de passe ne correspond pas!";
            }else{
                if(password_verify($_POST['password'],$don['password']))
                {
                    // création des sessions
                    $_SESSION['login'] = $don['login'];
                    header("LOCATION:dashboard.php");
                    exit(); // pour dire au programme d'arrêter (opti)
                }else{
                    $error = "Votre login ou votre mot de passe ne correspond pas!";
                }
            }
            
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>BI2 Portail - Admin</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <h1>Portail - Admin</h1>
                <h3>Connexion</h3>
                <form action="index.php" method="POST">
                    <?php
                        if(isset($error))
                        {
                            echo "<div class='alert alert-danger'>".$error."</div>";
                        }
                    ?>
                    <div class="form-group my-2">
                        <label for="login">Login: </label>
                        <input type="text" name="login" id="login" class="form-control">
                    </div>
                    <div class="form-group my-2">
                        <label for="password">Mot de passe: </label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group my-2">
                        <input type="submit" value="Connexion" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>