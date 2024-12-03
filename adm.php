<?php
session_start();
require "config.php";

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
    $mysqlclient = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // Requêtes pour récupérer le nombre d'événements, réservations et utilisateurs
    $SQLquery_events = "SELECT COUNT(*) FROM events";
    $SQLquery_reservations = "SELECT COUNT(*) FROM reservations";
    $SQLquery_users = "SELECT COUNT(*) FROM users";

    // Exécution des requêtes et récupération des résultats
    $res_events = $mysqlclient->query($SQLquery_events);
    $res_reservations = $mysqlclient->query($SQLquery_reservations);
    $res_users = $mysqlclient->query($SQLquery_users);

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li>
                    <a href="#"> <i class="fa-solid fa-film"></i> 
                    <div class="title">EVENTY</div>
                    </a>
                </li>
                <li>
                    <a href="#"> <i class="fas fa-th-large"></i> 
                    <div class="title">dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="affiche2.php"> <i class="fa-solid fa-calendar-days"></i>
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
                    <div class="title">Log out</div>
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
                        <div class="number"> <p><?php echo $res_events->fetchColumn(); ?></p></div>
                        <div class="card-name">Events</div>
                    </div>
                    <div class="icon-box">
                    <i class="fa-solid fa-calendar"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="number"><p><?php echo $res_users->fetchColumn(); ?></p></div>
                        <div class="card-name">connect users</div>
                    </div>
                    <div class="icon-box">
                    <i class="fa-solid fa-users"></i> 
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="number"><p><?php echo $res_reservations->fetchColumn(); ?></p></div>
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
                            <td>Event name</td>
                            <td>date</td>
                            <td>location</td>
                            <td>places dispo</td>
                            <td>event owner</td>
                        </thead>
                        <?php
                            try {
                                // Récupération des événements depuis la base de données
                                $SQLquery = "SELECT * FROM events";
                                $events = $mysqlclient->query($SQLquery);

                                if ($events->rowCount() > 0) {
                                    foreach ($events as $event) {
                                        $id2 = $event['event_id'];
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($event['title']) . "</td>";
                                        echo "<td>" . htmlspecialchars($event['date']) . "</td>";
                                        echo "<td>" . htmlspecialchars($event['location']) . "</td>";
                                        echo "<td>" . htmlspecialchars($event['places_dispo']) . "</td>";
                                        echo '<td><a href="affiche2.php?id=' . $id2 . '"><i class="far fa-eye"></i></a></td>';
                                        echo '<td><a href="deleteev.php?id=' . $id2 . '"><i class="far fa-trash-alt"></i></a></td>';
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>Aucun événement trouvé.</td></tr>";
                                }
                            } catch (PDOException $e) {
                                echo "<tr><td colspan='5'>Erreur de connexion : " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                            }
                            ?>
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
                                // Récupération des utilisateurs depuis la base de données
                                $SQLquery = "SELECT * FROM users";
                                $users = $mysqlclient->query($SQLquery);

                                if ($users->rowCount() > 0) {
                                    foreach ($users as $user) {
                                        $id = $user['user_id'];
                                        echo "<tr>";
                                        echo '<td><div class="img-box-small"><img src="/assets/user.png" alt=""></div></td>';
                                        echo "<td>" . htmlspecialchars($user['user_id']) . "</td>";
                                        echo "<td>" . htmlspecialchars($user['name']) . "</td>";
                                        echo '<td><a href="affiche.php?id=' . $id . '"><i class="far fa-eye"></i></a></td>';
                                        echo '<td><a href="delete.php?id=' . $id . '"><i class="far fa-trash-alt"></i></a></td>';
                                        echo "</tr>";
                                    }
                                } else {
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
