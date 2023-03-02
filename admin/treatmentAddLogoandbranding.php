<?php 
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

    // s'il vient de mon form ou non
    if(isset($_POST['title']))
    {
        // vérif du contenu du formulaire et gestion error
        // init d'une variable $err à 0 
        $err = 0;
        if(empty($_POST['title']))
        {
            $err = 1;
        }else{
            $title = htmlspecialchars($_POST['title']);
        }

        if(empty($_POST['date']))
        {
            $err = 2;
        }else{
            $date = htmlspecialchars($_POST['date']);
        }

        if(empty($_POST['description']))
        {
            $err = 3;
        }else{
            $description = htmlspecialchars($_POST['description']);
        }

        //vérif si err sinon traitement
        if($err==0){
            $dossier = "../images/"; // ../images/monfichier.jpg
            $fichier = basename($_FILES['image']['name']);
            $taille_maxi = 2000000;
            $taille = filesize($_FILES['image']['tmp_name']);
            $extensions = ['.png','.jpg','.jpeg'];
            $extension = strrchr($_FILES['image']['name'],'.');

            if(!in_array($extension, $extensions))
            {
                $erreur = 1;
            }
            
            if($taille>$taille_maxi){
                $erreur = 2;
            }

            if(!isset($erreur))
            {
                 // traitement
                $fichier = strtr($fichier, 
                 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $fichier = preg_replace('/([^.a-z0-9]+)/i','-',$fichier); 
                $fichiercptl = rand().$fichier; 

                if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier.$fichiercptl))
                {
                    require "../connexion.php";
                    $insert = $bdd->prepare("INSERT INTO logoandbranding(title,date,description,cover) VALUES(?,?,?,?)");
                    $insert->execute([$title,$date,$description,$fichiercptl]);
                    $insert->closeCursor();
                    header("LOCATION:logoandbranding.php?addsuccess=ok");
                }else{
                    header("LOCATION:addLogoandbranding.php?errorimg=3");
                }             
            }else{
                header("LOCATION:addLogoandbranding.php?errorimg=".$erreur);
            }


        }else{
            header("LOCATION:addLogoandbranding.php?error=".$err);
        }

    }else{
        header("LOCATION:logoandbranding.php");
    }

?>