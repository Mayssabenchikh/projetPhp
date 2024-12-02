<?php
/*require("config.php");
$adm_iden = $_POST['id'];
$password = $_POST['password'];
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($pdo) {
       // echo "Connected to the $db database successfully!";
        $requete = "select * from admin where adm_iden=:adm_iden and password=:password";//requette bch tkhdm baad 
        $pr=$pdo->prepare($requete );//yhadherha 
        $pr->execute([':adm_iden' => $adm_iden,':password'=>$password]);//execution selon parametre fournis
        $ligne = $pr->fetch(PDO::FETCH_ASSOC);
        if ($ligne) {
           // header("location:/log.html");
            $msg="welcome";
            $status="succes";

        } else{
            $msg="you don't have acces ";
            $status="erreur";
            header("location:/verifadm.php");

        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}*/
require("config.php");
session_start();
$adm_iden = $_POST['id'];
$passw= $_POST['password'];
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($pdo) {
        echo "Connected to the $db database successfully!";
        $requete = "select adm_iden,password from admin where adm_iden='$adm_iden' and password='$passw'";
        $resultat = $pdo->query($requete);

        if ($resultat->rowCount() == 0) {
            $msg="you don't have acces ";
            $_SESSION['message_erreur'] = $msg;
           // header("Location: adm.php");
            //$status="erreur";
            header("location:adminloginter.php");

        } else {
            $ligne = $resultat->fetch(PDO::FETCH_ASSOC);
            header("location:adm.php");
            //$msg="welcome to the admin interface";
            //$status="succes";
           

        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}