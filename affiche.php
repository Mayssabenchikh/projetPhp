<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php
       //se connecter  a la base de donnees
       $connexion = new PDO("mysql:host=localhost;dbname=Entités","dsi2425","dsi2425");
       if($connexion)
       {
        //echo "connected";
        $req = "select * from users";
        $resultat = $connexion->query($req);
        if($resultat->rowCount()!=0)
        {
            echo "<h1> liste des users</h1>";
            echo '<div class="container">';
            echo '<table class="table table-striped">';
            echo "<thead>";
            echo "<tr><th>ID</th><th>Nom </th><th>email</th><th>password</th><th>phone</th></tr>";
            echo "</thead>";
            echo  "<tbody>";
            while($ligne=$resultat->fetch(pdo::FETCH_ASSOC))
            {
                $id = $ligne['user_id'];
                echo "<tr>";
                echo "<td>". $ligne['user_id']."</td>";
                echo "<td>". $ligne['name']."</td>";
                echo "<td>". $ligne['email']."</td>";
                echo "<td>". $ligne['password']."</td>";
                echo "<td>". $ligne['phone_num']."</td>";
                //echo '<td><a href="delete.php?id='.$id.'">supprimer</a></td>';
                echo "</tr>";
            }
            echo  "</tbody>";
            echo "</table>";
            echo "</div>";
           
        }
        else{
            echo "<br>Aucune ligne trouvee<br>";
        }
       }
       else{
        echo "pb de connexion";

       }

    ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>