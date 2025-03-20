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
        header("LOCATION:contacts.php");
        exit();
    }

    // vérifier si delete existe dans la bdd
    $cat = $bdd->prepare("SELECT * FROM contact WHERE id=?");
    $cat->execute([$idDel]);
    $donCat = $cat->fetch();
    $cat->closeCursor();
    if(!$donCat)
    {
        header("LOCATION:contacts.php");
        exit();
    }

    // supprimer la donnée dans la bdd
    $delete = $bdd->prepare("DELETE FROM contact WHERE id=?");
    $delete->execute([$idDel]);
    $delete->closeCursor();
    // prévenir l'utilisateur
    header("LOCATION:contacts.php?successdel=".$idDel);
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
    <h1>Les contacts</h1>
    <?php
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
            <th>Prénom</th>
            <th>Email</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $contacts = $bdd->query("SELECT id, lastname, firstname,email, DATE_FORMAT(date,'%d/%m/%Y %Hh%i') AS mydate FROM contact");
        while($don = $contacts->fetch())
        {
            echo "<tr>";
            echo "<td>".$don['id']."</td>";
            echo "<td>".$don['lastname']."</td>";
            echo "<td>".$don['firstname']."</td>";
            echo "<td>".$don['email']."</td>";
            echo "<td>".$don['mydate']."</td>";
            echo "<td>";
                echo "<a href='showContact.php?id=".$don['id']."' class='btn btn-primary mx-1'>Voir</a>";
                echo "<a href='contacts.php?delete=".$don['id']."' class='btn btn-danger mx-1'>Supprimer</a>";
            echo "</td>";
            echo "</tr>";
        }
        $contacts->closeCursor();
        ?>
        </tbody>
    </table>
</div>
</body>
</html>