<?php
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <title>Administration de Stock</title>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php
        include("partials/header.php");
    ?>
    <div class="container">
        <h1>Administration</h1>
        <div>
            <a href="3d.php" class="btn btn-secondary">Retour</a>
        </div>
        <h2>Ajouter un élément 3d</h2>
        <form action="treatmentAdd3d.php" method="POST" enctype="multipart/form-data">
            <div class="form-group my-3">
                <label for="title">Titre: </label>
                <input type="text" id="title" name="title" class="form-control">
            </div>
            <div class="form-group my-3">
                <label for="date">Date: </label>
                <input type="date" id="date" name="date" class="form-control">
            </div>
            <div class="form-group my-3">
                <label for="description">Description: </label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="form-group my-3">
                <label for="image">Image de couverture: </label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <div class="form-group my-3">
                <input type="submit" value="Ajouter" class="btn btn-success">
            </div>
        </form>
        <?php
            if(isset($_GET['error']))
            {
                echo "<div class='alert alert-danger my-2'>Une erreur est survenue (code: ".$_GET['error'].")</div>";
            }
        ?>
    </div>
</body>
</html>