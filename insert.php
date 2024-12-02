<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $connexion = new PDO("mysql:host=localhost;dbname=Entités", "dsi2425", "dsi2425");
    if ($connexion) {
        $name = $_GET['name'];
        $email = $_GET['email'];
        $passwd = $_GET['passwd'];
        $phone = $_GET['number'];
        
        $req = "INSERT INTO users (name, email, password, phone_num) VALUES ('$name', '$email', '$passwd', '$phone');";
        
        $nb = $connexion->exec($req);
        header("location:affiche.php");
        echo $nb;
    } else {
        echo "pb de connexion";
    }
    ?>
</body>
</html>