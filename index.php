zzezez<?php
    require "connexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link resl="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h1>Stock</h1>
    <?php
        $req = $bdd->query("SELECT * FROM products");
        while($don = $req->fetch())
        {
            //var_dump($don);
            echo "<div><a href='product.php?id=".$don['id']."'>".$don['title']."</a></div>";
        }
        $req->closeCursor();

    ?>

</body>
</html>