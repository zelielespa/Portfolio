<?php
    session_start();
    require "../connexion.php";

    if(isset($_SESSION['login']))
    {
        header("LOCATION:dashboard.php");
    }

    // formulaire déjà envoyé ou non
    if(isset($_POST['login']) && isset($_POST['password']))
    {
        // si vide ou non
       if(empty($_POST['login']) OR empty($_POST['password']))
       {
        $error = "Veuillez remplir le formulaire correctement";
       }else{
            // traitement du login et mot passe
            $login = htmlspecialchars($_POST['login']);
            $req = $bdd->prepare("SELECT * FROM members WHERE login=?");
            $req->execute([$login]);
            if($don = $req->fetch())
            {
                // login existe
                // vérifier mot de passe
                if(password_verify($_POST['password'],$don['password']))
                {
                    // ok connexion
                    $_SESSION['login'] = $don['login'];
                    $req->closeCursor();
                    header("LOCATION:dashboard.php");
                }else{
                    // mot de passe incorrecte
                    $error = "Votre mot de passe ne correspond à votre login";
                }
            }else{
                // login n'existe pas
                $error = "Votre login n'existe pas";
            }
            $req->closeCursor();
       }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Connexion à l'administration de Stock</h1>
                <?php
                if(isset($error))
                {
                    echo "<div class='alert alert-danger'>".$error."</div>";
                }
                ?>
                <form action="index.php" method="POST">
                    <div class="form-group my-3">
                        <label for="login">Login: </label>
                        <input type="text" id="login" name="login" class="form-control">
                    </div>
                    <div class="form-group my-3">
                        <label for="password">Mot de passe: </label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group my-3">
                        <input type="submit" value="Connexion" class="btn btn-primary">
                        <a href="../index.php" class="btn btn-secondary mx-1">Retour au site</a>
                    </div>
                </form>
            </div>
        </div>


       
       
    </div>
</body>
</html>