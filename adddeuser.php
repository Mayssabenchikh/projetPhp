<?php
require("config.php");
session_start(); 
try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=UTF8", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $passwd = trim($_POST['passwd']);
        $phone = trim($_POST['number']);

        $vreq = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $vreq->execute([$email]);

        if ($vreq->fetch()) {
            $_SESSION['message'] = "Cet email est déjà utilisé.";
            $_SESSION['message_type'] = "error";
        } else {
            $req = $pdo->prepare("INSERT INTO users (name, email, password, phone_num) VALUES (?, ?, ?, ?)");
            $req->execute([$name, $email, $passwd, $phone]);

            $_SESSION['message'] = "Utilisateur ajouté avec succès.";
            $_SESSION['message_type'] = "success";
            
        }

        header("Location:home.php");
        exit();
    }
catch (PDOException $e) {
    $_SESSION['message'] = "Erreur : " . htmlspecialchars($e->getMessage());
    $_SESSION['message_type'] = "error";
    header("Location: user.php");
    exit();
}
?>
