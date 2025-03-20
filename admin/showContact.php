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
$contact = $bdd->prepare("SELECT id, lastname, firstname,email, message,DATE_FORMAT(date,'%d/%m/%Y %Hh%i') AS mydate FROM contact WHERE id=?");
$contact->execute([$id]);
$donCont = $contact->fetch();
$contact->closeCursor();
if(!$donCont)
{
    header("LOCATION:contacts.php");
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
    <h2 class="my-2">contact <?= $donCont['email'] ?></h2>
    <a href="contacts.php" class="btn btn-secondary mb-5">Retour</a>
    <div class="row">
        <div class="col-md-6 text-bg-light">
            <div>Nom: <?= $donCont['lastname'] ?></div>
            <div>Prénom: <?= $donCont['firstname'] ?></div>
            <div>Email: <a href="mailto:<?= $donCont['email'] ?>"><?= $donCont['email'] ?></a></div>
            <div>date: <?= $donCont['mydate'] ?></div>
        </div>
        <div class="col-md-6 p-6">
            <?= nl2br($donCont['message']) ?>
        </div>
        <div class="col-12">
            <a href="mailto:<?= $donCont['email'] ?>" class="btn btn-success my-2">Répondre</a>
        </div>
    </div>
</div>
</body>
</html>