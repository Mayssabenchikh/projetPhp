<?php

require("config.php");
$login = $_POST['login'];
$passw = $_POST['password'];
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($pdo) {
        echo "Connected to the $db database successfully!";
        $requete = "select email,password from users where email='$login' and password='$passw'";
        $resultat = $pdo->query($requete);

        if ($resultat->rowCount() == 0) {
            header("location:/log.html");

        } else {
            $ligne = $resultat->fetch(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['nom']=$ligne['nom'];
            $_SESSION['id']=$ligne['id'];
            header("location:/home.php");

        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
