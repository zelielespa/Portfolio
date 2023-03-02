<?php
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

    // déconnexion 
    if(isset($_GET['deco']))
    {
        session_destroy();
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
    <h1>Administration</h1>
    <div>
        <a href="dashboard.php?deco=ok">Déconnexion</a>
    </div>
    <div>
        <a href="products.php">Gestion des produits</a>
    </div>
</body>
</html>