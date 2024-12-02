<?php
session_start();
require "config.php";

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
    $mysqlclient = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $SQLquery_events = "SELECT * FROM events";
    $res_events = $mysqlclient->prepare($SQLquery_events);
    $res_events->execute();

    $SQLquery_reservations = "SELECT * FROM reservations";
    $res_reservations = $mysqlclient->prepare($SQLquery_reservations);
    $res_reservations->execute();

    $SQLquery_users = "SELECT * FROM users";
    $res_users = $mysqlclient->prepare($SQLquery_users);
    $res_users->execute();

} catch (PDOException $e) {
    $error = "Connection failed: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="cssadm.css">
   <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>-->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li>
                    <a href="#"> <i class="fa-solid fa-film"></i></i> 
                    <div class="title">EVENTY</div>
                    </a>
                </li>
                <li>
                    <a href="#"> <i class="fas fa-th-large"></i> 
                    <div class="title">dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="#"> <i class="fa-solid fa-calendar-days"></i>
                    <div class="title">Events</div>
                    </a>
                </li>
                <li>
                    <a href="affiche.php"> <i class="fa-solid fa-users"></i> 
                    <div class="title">Users</div>
                    </a>
                </li>
                <li>
                    <a href="logoutadm.php"> <i class="fa-solid fa-right-from-bracket"></i> 
                    <div class="title">Log out

                    </div>
                    </a>
                </li>
                

            </ul>
        </div>
        <div class="main">
            <div class="top-bar">
               
               
                <div class="user">
                    <img src="/assets/219986.png" alt="">
                </div>
            </div>
            <div class="cards">
                <div class="card">
                    <div class="card-content">
                        <div class="number"> <p><?php echo $res_events->rowCount() ?></p></div>
                        <div class="card-name">Events</div>
                        
                    </div>
                    <div class="icon-box">
                    <i class="fa-solid fa-calendar"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="number"><p><?php echo $res_users->rowCount() ?></p></div>
                        <div class="card-name">connect users</div>
                        
                    </div>
                    <div class="icon-box">
                    <i class="fa-solid fa-users"></i> 
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="number"><p><?php echo $res_reservations->rowCount() ?></p></div>
                        <div class="card-name">Reservation</div>
                        
                    </div>
                    <div class="icon-box">
                    <i class="fa-solid fa-list-check"></i>
                    </div>
                </div>
                
            </div>
            <div class="tables">
                <div class="last">
                    <div class="heading">
                        <h2>Events</h2>
                        <a href="#" class="btn">view all</a>
                    </div>
                    <table class="tt">
                        <thead>
                            <td>Name</td>
                            <td>doc</td>
                            <td>cond</td>
                            <td>actions</td>
                        </thead>
                        <tbody>
                            <tr>
                                <td>*</td>
                                <td>*</td>
                                <td>*</td>
                                <td>
                                    <i class="far fa-eye"></i>
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>*</td>
                                <td>*</td>
                                <td>*</td>
                                <td>
                                    <i class="far fa-eye"></i>
                                   
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="visiting">
                <div class="heading">
                        <h2>users</h2>
                        
                    </div>
                    <table class="tt2">
                        <thead>
                            <td></td>
                            
                            <td>id</td>
                            <td>name</td>
                            


                            
                        </thead>

                        <tbody>
                            <?php
                            try {
                              
                                $connexion = new PDO("mysql:host=localhost;dbname=Entités", "dsi2425", "dsi2425");
                                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                $req = "SELECT * FROM users";
                                $resultat = $connexion->query($req);

                                if ($resultat->rowCount() > 0) {
                                    // Affichage des lignes dynamiques
                                    while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                                        $id = $ligne['user_id'];
                                        echo "<tr>";
                                        echo '<td><div class="img-box-small"><img src="/assets/user.png" alt=""></div></td>';
                                        echo "<td>" . htmlspecialchars($ligne['user_id']) . "</td>";
                                        echo "<td>" . htmlspecialchars($ligne['name']) . "</td>";
                                        echo '<td><a href="affiche.php?id=' . $id . '"><i class="far fa-eye"></i></a></td>';
                                        //echo '<td><a href="delete.php?id=' . $id . '"><i class="far fa-trash-alt"></i></a></td>';
                                        echo "</tr>";
                                    }
                                } else {
                                    // Affichage d'une ligne vide si aucun utilisateur n'est trouvé
                                    echo "<tr><td colspan='4'>Aucun utilisateur trouvé.</td></tr>";
                                }
                            } catch (PDOException $e) {
                                echo "<tr><td colspan='4'>Erreur de connexion : " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                            }
                            ?>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
