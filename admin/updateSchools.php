<?php
    session_start();
    if(!$_SESSION['login'])
    {
        header("LOCATION:index.php");
    }
   
    // gestion de la dépendance du GET id
    if(isset($_GET['id']))
    {
        $id = htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:schools.php");
    }

    require "../connexion.php";
    // requête à la bdd
    $school = $bdd->prepare("SELECT * FROM etablissements WHERE id=?");
    $school->execute([$id]);
    $donSchool = $school->fetch();
    $school->closeCursor();
    if(!$donSchool)
    {
        header("LOCATION:schools.php");
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
    <h1>Modifier un établissement</h1>
    <a href="schools.php" class="btn btn-secondary">Retour</a>
    <form action="treatmentAddSchool.php" method="POST">
        <div class="form-group my-3">
            <label for="nom">Nom: </label>
            <input type="text" id="nom" name="nom" class="form-control" value="<?= $donSchool['nom'] ?>">
        </div>
        <div class="form-group my-3">
            <label for="categorie">Categorie: </label>
            <select name="categorie" id="categorie" class="form-control">
                <?php
                    $req = $bdd->query("SELECT * FROM categories");
                    while($don = $req->fetch())
                    {
                        echo "<option value='".$don['id']."'>".$don['nom']."</option>";
                    }
                    $req->closeCursor();
                ?>
            </select>
        </div>
        <div class="form-group my-3">
            <label for="intro">Introduction: </label>
            <textarea name="introduction" id="intro" class="form-control"><?= $donSchool['introduction'] ?></textarea>
        </div>
        <div class="form-group my-3">
            <label for="description">Description: </label>
            <textarea name="description" id="description" class="form-control"><?= $donSchool['description'] ?></textarea>
        </div>
        <div class="form-group my-3">
            <label for="image">Image: </label>
            <input type="text" name="image" id="image" class="form-control" value="<?= $donSchool['image'] ?>">
        </div>
        <div class="form-group my-3">
            <input type="submit" value="Modifier" class="btn btn-warning">
        </div>
    </form>
  </div>
</body>
</html>