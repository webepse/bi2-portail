<?php
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
<div class="container">
    <h1>Modifier une catégorie</h1>
    <a href="categories.php" class="btn btn-secondary">Retour</a>
    <?php
    if(isset($_GET['error']))
    {
        echo "<div class='alert alert-danger'>Une erreur est survenue (code erreur: ".$_GET['error'].")</div>";
    }
    ?>
    <form action="treatmentUpdateCategory.php?id=<?= $donCat['id'] ?>" method="POST">
        <div class="form-group my-3">
            <label for="nom">Nom: </label>
            <input type="text" id="nom" name="nom" class="form-control" value="<?= $donCat['nom'] ?>">
        </div>
        <div class="form-group my-3">
            <input type="submit" value="Modifier" class="btn btn-warning">
        </div>
    </form>
</div>
</body>
</html>