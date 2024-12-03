<?php
session_start();
require("config.php");

$login = $_POST['login'];
$passw = $_POST['password'];

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $requete = "SELECT * FROM users WHERE email = :email AND password = :password";
    $stmt = $pdo->prepare($requete);
    $stmt->bindParam(':email', $login, PDO::PARAM_STR);
    $stmt->bindParam(':password', $passw, PDO::PARAM_STR); 
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        $_SESSION['message'] = "Email ou mot de passe incorrect";
        $_SESSION['message_type'] = "error";
        header("location:/loog.php");
        exit();
    } else {
        $ligne = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id'] = $ligne['user_id']; 
        $_SESSION['name'] = $ligne['name'];
        header("location:/home.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
