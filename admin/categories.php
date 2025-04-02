<?php
session_start();
if(!$_SESSION['login'])
{
    header("LOCATION:index.php");
    exit();
}
require "../connexion.php";

if(isset($_GET['delete']))
{
    // vérifier si delete est numérique
    $idDel = htmlspecialchars($_GET['delete']);
    if(!is_numeric($idDel))
    {
        header("LOCATION:schools.php");
        exit();
    }


    // vérifier si delete existe dans la bdd
    $cat = $bdd->prepare("SELECT * FROM categories WHERE id=?");
    $cat->execute([$idDel]);
    $donCat = $cat->fetch();
    $cat->closeCursor();
    if(!$donCat)
    {
        header("LOCATION:categories.php");
        exit();
    }

    // supprimer en cascade les éléments lié à la catégorie à supprimer
    // aller chercher tous les établissements qui ont l'id ex 7
    // ne pas oublier les images de la gallerie associée
    $schools = $bdd->prepare("SELECT * FROM etablissements WHERE categorie=?");
    $schools->execute([$idDel]);
    while($donSchools = $schools->fetch())
    {
        // supprimer l'image
        unlink("../images/".$donSchools['image']);
        unlink("../images/mini_".$donSchools['image']);
        // supprimer les éventuelles images (fichier) de la galerie
        $gal = $bdd->prepare("SELECT * FROM images WHERE id_etablissement=?");
        $gal->execute([$donSchools['id']]);
        while($donGal = $gal->fetch())
        {
            unlink("../images/".$donGal['fichier']);
        }
        $gal->closeCursor();

        // supprimer les éventuelles images (la donnée) de la galerie
        $delGal = $bdd->prepare("DELETE FROM images WHERE id_etablissement=?");
        $delGal->execute([$idDel]);
        $delGal->closeCursor();
    }
    $schools->closeCursor();

    // supprimer tous les établissements qui ont l'id ex 7
    $deleteSchools = $bdd->prepare("DELETE FROM etablissements WHERE categorie=?");
    $deleteSchools->execute([$idDel]);
    $deleteSchools->closeCursor();

    // supprimer la donnée dans la bdd
    $delete = $bdd->prepare("DELETE FROM categories WHERE id=?");
    $delete->execute([$idDel]);
    $delete->closeCursor();


    // prévenir l'utilisateur
    header("LOCATION:categories.php?successdel=".$idDel);
    exit();
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
<?php
include("partials/header.php");
?>
<div class="container-fluid">
    <h1>Les catégories</h1>
    <a href="addCategory.php" class="btn btn-success">Ajouter</a>
    <?php
    if(isset($_GET['insert']))
    {
        if($_GET['insert']=="success")
        {
            echo "<div class='alert alert-success my-3'>Vous avez bien ajouté une catégorie à la liste</div>";
        }
    }
    if(isset($_GET['update']))
    {
        echo "<div class='alert alert-warning my-3'>Vous avez bien modifié l'id numéro ".$_GET['update']."</div>";
    }
    if(isset($_GET['successdel']))
    {
        echo "<div class='alert alert-danger my-3'>Vous avez bien supprimé l'id numéro ".$_GET['successdel']."</div>";
    }
    ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $categories = $bdd->query("SELECT * FROM categories");
        while($don = $categories->fetch())
        {
            echo "<tr>";
            echo "<td>".$don['id']."</td>";
            echo "<td>".$don['nom']."</td>";
            echo "<td>";
            echo "<a href='updateCategory.php?id=".$don['id']."' class='btn btn-warning mx-1'>Modifier</a>";
            echo "<a href='categories.php?delete=".$don['id']."' class='btn btn-danger mx-1'>Supprimer</a>";
            echo "</td>";
            echo "</tr>";
        }
        $categories->closeCursor();
        ?>
        </tbody>
    </table>
</div>
</body>
</html>