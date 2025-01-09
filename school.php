<?php
    // besoin d'un id si pas d'id affichage erreur donc on fait une redirection
    // isset => si existe
    // empty => si vide mais existe
    // négation des fonctions ! 
    // n'existe pas => !isset
    if(isset($_GET['id']))
    {
        $id = htmlspecialchars($_GET['id']);
        // is_numeric => si c'est numérique
        // !is_numeric => si pas numérique
        if(!is_numeric($id))
        {
            header("LOCATION:404.php");
        }
    }else{
        header("LOCATION:404.php");
    }
    require "connexion.php";
    $req = $bdd->prepare("SELECT etablissements.nom AS enom, categories.nom AS cnom, etablissements.introduction AS intro, etablissements.description AS description,  etablissements.image as image FROM etablissements INNER JOIN categories ON etablissements.categorie = categories.id WHERE etablissements.id=?");
    $req->execute([$id]);
    $don = $req->fetch();
    $req->closeCursor();
    // vérifier si $don est vide
    if(!$don)
    {
        header("LOCATION:404.php");
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="slide school" id="test">
        <?php
            include("partials/header.php");
        ?>
        <div class="container container-info">
            <div class="gauche">
                <h1><?= $don['enom'] ?></h1>
                <h4>Catégorie : <?= $don['cnom'] ?></h4>
                <div class="img">
                    <img src="images/<?= $don['image'] ?>" alt="image de <?= $don['enom'] ?>">
                </div>
            </div>
            <div class="droite">
                <div class="text">
                    <h3>Introduction</h3>
                    <?= nl2br($don['intro']) ?>
                    <h3>Description</h3>
                    <?= nl2br($don['description']) ?>
                </div>
            </div>
        </div>

    </div>

    <div id="galimg">
        <div class="container">
            <h1>Galerie images</h1>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php
                        $reqGal = $bdd->prepare("SELECT * FROM images WHERE id_etablissement=?");
                        $reqGal->execute([$id]);
                        // compter le nombre de réponse
                        $count = $reqGal->rowCount();
                        if($count > 0)
                        {
                            while($donGal = $reqGal->fetch())
                            {
                                echo "<div class='swiper-slide'><img src='images/".$donGal['fichier']."' alt='image'></div>";
                            }
                        }else{
                            echo "Aucune image pour cet établissement";
                        }
                        $reqGal->closeCursor();
                    ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            
        </div>
    </div>
    <?php
        include("partials/footer.php");
    ?>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="assets/script.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        });
    </script>
</body>
</html>