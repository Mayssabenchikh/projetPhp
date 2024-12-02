<?php
require("config.php");

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=UTF8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $name = $_GET['name'];
    $email = $_GET['email'];
    $passwd = $_GET['passwd'];
    $phone = $_GET['number'];

    $vreq = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $vreq->execute([$email]);

    if ($vreq->fetch()) {
        echo "Cet email est déjà utilisé.";
    } else {
        $req = $pdo->prepare("INSERT INTO users (name, email, password, phone_num) VALUES (?, ?, ?, ?)");
        $req->execute([$name, $email, $passwd, $phone]);

        echo "Utilisateur ajouté avec succès.";
        header("location:home.php");
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
