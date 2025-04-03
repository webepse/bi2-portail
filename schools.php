<?php
require "connexion.php";

// récup les info de l'url
/** @var PDO $bdd */

if(isset($_GET['category']))
{
    // j'ai categorie => sécuriser la données => vérifier si la donnée existe => faire ma requête en rapport à la catégorie
    $category = htmlspecialchars($_GET['category']);
    if(!empty($category))
    {
        // vérifier si c'est numérique
        if(is_numeric($category))
        {
            // vérifier si la catégorie existe
            $verif = $bdd->prepare("SELECT * FROM categories WHERE id=?");
            $verif->execute([$category]);
            if($verif->rowCount() == 0)
            {
                $verif->closeCursor();
                header("LOCATION:404.php");
                exit();
            }
            $verif->closeCursor();


            $req = $bdd->prepare("SELECT * FROM etablissements WHERE categorie =?");
            $req->execute([$category]);
            // permet de compter le nombre de réponse
            $count = $req->rowCount();

        }else{
            header("LOCATION:404.php");
            exit();
        }
    }else{
        $req = $bdd->query("SELECT * FROM etablissements ORDER BY id DESC");
    }

}else{
    $req = $bdd->query("SELECT * FROM etablissements ORDER BY id DESC");
    $count = $req->rowCount();
}





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
<div class="slide" id="schools">
    <?php
    include("partials/header.php");
    ?>
    <div class="category-header">
        <h1>Les établissements</h1>
        <div class="container-flex">
            <a href="schools.php" class="btn">Tous</a>
            <?php
                $categories = $bdd->query("SELECT * FROM categories");
                while($categorie = $categories->fetch()){
                    echo '<a href="schools.php?category='.$categorie['id'].'" class="btn">'.$categorie['nom'].'</a>';
                }
                $categories->closeCursor();
            ?>
        </div>

        <div class="container-grid">
            <?php
            if($count > 0){
                while($don = $req->fetch())
                {
                    echo '<div class="card">';
                    echo '<div class="image">';
                    echo '<img src="images/mini_'.$don['image'].'" alt="image de '.$don['nom'].'">';
                    echo '</div>';
                    echo '<div class="texte">';
                    echo '<h2>'.$don['nom'].'</h2>';
                    echo '<p>'.$don['introduction'].'</p>';
                    echo '
                                <a href="school.php?id='.$don['id'].'" class="btn">En savoir plus</a>';
                    echo '</div>';
                    echo '</div>';
                }
            }else{
                echo "<div>Il n'y a pas d'établissement lié à cette catégorie</div>";
            }

            $req->closeCursor();
            ?>
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

