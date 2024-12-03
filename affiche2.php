<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="theme.css" >
</head>
<body>
    <?php
       //se connecter  a la base de donnees
       $connexion = new PDO("mysql:host=localhost;dbname=Entités","dsi2425","dsi2425");
       if($connexion)
       {
        //echo "connected";
        $req = "select * from events";
        $resultat = $connexion->query($req);
        if($resultat->rowCount()!=0)
        {
            echo "<h1> liste des evenements</h1>";
            echo '<div class="container">';
            echo '<table class="table table-striped">';
            echo "<thead>";
            echo "<tr><th>ID</th><th>event name</th><th>desc</th><th>date</th><th>places</th><th>location</th><th>organisateur</th><th>pics</th></tr>";
            echo "</thead>";
            echo  "<tbody>";
            while($ligne=$resultat->fetch(pdo::FETCH_ASSOC))
            {
                $id2 = $ligne['event_id'];
                echo "<tr>";
                echo "<td>". $ligne['event_id']."</td>";
                echo "<td>". $ligne['title']."</td>";
                echo "<td>". $ligne['description']."</td>";
                echo "<td>". $ligne['date']."</td>";
                echo "<td>". $ligne['places_dispo']."</td>";
                echo "<td>". $ligne['location']."</td>";
                echo "<td>". $ligne['organisateur_id']."</td>";
                echo "<td>". $ligne['img']."</td>";
                echo '<td><a href="affiche2.php?id=' . $id2 . '"><i class="far fa-trash-alt"></i></a></td>';
                echo '<td><a href="deleteev.php?id='.$id2.'">supprimer</a></td>';
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