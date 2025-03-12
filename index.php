<?php
    require "connexion.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="slide" id="home">
        <?php
            include("partials/header.php");
        ?>
    </div>
    <div class="slide" id="etablissement">
        <div class="container">
            <h2>Les établissements</h2>
        </div>
        <div class="container-grid">
            <?php
                $req = $bdd->query("SELECT * FROM etablissements ORDER BY id DESC LIMIT 0,6");
                while($don = $req->fetch())
                {
                    echo '<div class="card">';
                        echo '<div class="image">';
                            echo '<img src="images/'.$don['image'].'" alt="image de '.$don['nom'].'">';
                        echo '</div>';
                        echo '<div class="texte">';
                            echo '<h2>'.$don['nom'].'</h2>';
                            echo '<p>'.$don['introduction'].'</p>';
                            echo '
                            <a href="school.php?id='.$don['id'].'" class="btn">En savoir plus</a>';
                        echo '</div>';
                    echo '</div>';
                }
                $req->closeCursor();
            ?>         
        </div>     
    </div>
    <div class="slide" id="contact">
        <div class="gauche">
            <div class="container-contact">
                <div class="mycontact">
                    <h2>Contactez nous</h2>
                    <div class="info-contact">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora quo debitis dolores vel officiis nisi, suscipit dolor, minus fugit eum et sequi inventore omnis alias numquam, nulla quod atque dignissimos?
                    </div>
                </div>
                <div class="contact-social">
                    social media
                    <div class="c-social"></div>
                    <div class="c-social"></div>
                    <div class="c-social"></div>
                </div>
            </div>
        </div>
        <div class="droite">
            <div id="formulaire">
                <div class="name">
                    <div class="form-group">
                        <label for="last">Last Name</label>
                        <input type="text" id="last" name="lastname">
                    </div>
                    <div class="form-group">
                        <label for="first">First Name</label>
                        <input type="text" id="first" name="firstname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">E-mail Adress</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message"></textarea>
                </div>
                <div class="submit">
                    <input type="submit" value="Envoyer">
                </div>
            </div>

        </div>
    </div>
    <?php
        include("partials/footer.php");
    ?>
    <!-- le script doit être déclaré en dernier (juste avant la fermeture du body) car les élements doivent exister pour que javascripts les select -->
    <script src="assets/script.js"></script>
</body>
</html>