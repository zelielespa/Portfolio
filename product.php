<?php
    require "connexion.php";
    if(isset($_GET['id']))
    {
        $id = htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:index.php");
    }

    $req = $bdd->prepare("SELECT title, DATE_FORMAT(date,'%d') AS day, DATE_FORMAT(date,'%m') AS month, DATE_FORMAT(date,'%Y') AS year, description, cover FROM products WHERE id=?");
    $req->execute([$id]);
    if(!$don = $req->fetch())
    {
        $req->closeCursor();
        header("LOCATION:index.php");
    }
    $req->closeCursor();

    $months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h1 class="title"><?= $don['title'] ?></h1>
    <div class="date">Le <?= $don['day'] ?> <?= $months[$don['month'] - 1] ?> <?= $don['year'] ?></div>
    <div class="description"><?= nl2br($don['description']) ?></div>
    <div class="image">
        <img src="images/<?= $don['cover'] ?>" alt="image de <?= $don['title'] ?>">
    </div>
</body>
</html>