<?php


function connect()
{
    require_once '../config.php';
    $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

try {
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $pdo = new PDO($dsn, $user, $password, $options);;
return $pdo;
} catch (PDOException $e) {
echo $e->getMessage();
        return null;
}
//connexion a une base de donnees

}