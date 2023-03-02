<?php 
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

     //vérifier la prés de id
     if(isset($_GET['id']))
     {
         $id = htmlspecialchars($_GET['id']);
     }else{
         header("LOCATION:compositing.php");
     }
 
     // vérifier si l'id est dans la bdd
     require "../connexion.php";
     $req = $bdd->prepare("SELECT * FROM compositing WHERE id=?");
     $req->execute([$id]);
     if(!$don = $req->fetch())
     {
         $req->closeCursor();
         header("LOCATION:compositing.php");
     }
     $req->closeCursor();

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

            if(empty($_FILES['image']['tmp_name']))
            {
                // pas d'image, donc modif sans fichier
                require "../connexion.php";
                $update = $bdd->prepare("UPDATE compositing SET title=:titre, date=:date, description=:description WHERE id=:myid");
                $update->execute([
                    ":titre" => $title, 
                    ":date" => $date, 
                    ":description" => $description, 
                    ":myid" => $id
                ]);
                $update->closeCursor();
                header("LOCATION:compositing.php");
            }else{
                // traitement de l'image pour la modification
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
                        // supprimer le fichier de base
                        unlink("../images/".$don['cover']);
                        require "../connexion.php";
                        $update = $bdd->prepare("UPDATE compositing SET title=:titre, date=:date, description=:description, cover=:image WHERE id=:myid");
                        $update->execute([
                            ":titre" => $title, 
                            ":date" => $date, 
                            ":description" => $description, 
                            ":image"=>$fichiercptl,
                            ":myid" => $id
                        ]);
                        $update->closeCursor();
                        header("LOCATION:compositing.php?updatesuccess=".$id);
                    }else{
                        header("LOCATION:updateCompositing.php?id=".$id."&errorimg=3");
                    }             
                }else{
                    header("LOCATION:updateCompositing.php?id=".$id."&errorimg=".$erreur);
                }

            }
        }else{
            header("LOCATION:updateCompositing.php?id=".$id."&error=".$err);
        }

    }else{
        header("LOCATION:compositing.php");
    }

?>