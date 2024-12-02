
<?php
    //require_once('../includes/header.php');
    //require_once('../connect.php');
    $connexion = new PDO("mysql:host=localhost;dbname=Entités", "dsi2425", "dsi2425");
    if($connexion)
    {
     //echo "connected";
     $id = $_GET['id'];
     $req = "delete from users where user_id=$id";
     $nb = $connexion->exec($req);
     //echo "Editeur ajoute avec succes...!<br>";
     //header("location:adm.php");
     header("location:affiche.php");

     echo $nb;
     
    }
    else{
     echo "pb de connexion";

    }
    //require_once('../includes/footer.php');

    ?>

