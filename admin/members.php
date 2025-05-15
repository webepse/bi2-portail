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
    <h1>Les membres</h1>
    <a href="addMember.php" class="btn btn-success">Ajouter</a>
    <?php
    if(isset($_GET['insert']))
    {
        if($_GET['insert']=="success")
        {
            echo "<div class='alert alert-success my-3'>Vous avez bien ajouté un membre à la liste</div>";
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
            <th>Login</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $categories = $bdd->query("SELECT * FROM admin");
        while($don = $categories->fetch())
        {
            echo "<tr>";
            echo "<td>".$don['id']."</td>";
            echo "<td>".$don['login']."</td>";
            echo "<td>";
            echo "<a href='updateMember.php?id=".$don['id']."' class='btn btn-warning mx-1'>Modifier</a>";
            echo "<a href='members.php?delete=".$don['id']."' class='btn btn-danger mx-1'>Supprimer</a>";
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