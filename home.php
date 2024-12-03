<?php

session_start();
$servername = "localhost";
$username = "dsi2425";
$password = "dsi2425";
$dbname = "Entités";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /*"SELECT *, users.name AS organisateur
                FROM events
        JOIN users ON events.oraginsater_id = users.user_id
        ORDER BY date asc";*/
        $sql = "SELECT events.*, users.name AS organisateur 
        FROM events 
        JOIN users ON events.organisateur_id = users.user_id 
        ORDER BY date desc";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $sql = "SELECT events.*, users.name AS organisateur FROM events 
            JOIN users ON events.organisateur_id = users.user_id 
            WHERE 1=1 ORDER BY date asc"; // Condition de base

    // Ajouter des conditions en fonction de la recherche
    if (!empty($_GET['title'])) {
        $title = "%" . $_GET['title'] . "%";
        $sql .= " AND events.title LIKE :title";
    }
    if (!empty($_GET['location'])) {
        $location = "%" . $_GET['location'] . "%";
        $sql .= " AND events.location LIKE :location";
    }
    if (!empty($_GET['event_date'])) {
        $event_date = date('Y-m-d', strtotime($_GET['event_date']));
        $sql .= " AND DATE(events.date) = :event_date";
    }

    // Préparer et exécuter la requête
    $stmt = $conn->prepare($sql);

    // Lier les valeurs de recherche si elles existent
    if (!empty($title)) {
        $stmt->bindValue(':title', $title);
    }
    if (!empty($location)) {
        $stmt->bindValue(':location', $location);
    }
    if (!empty($event_date)) {
        $stmt->bindValue(':event_date', $event_date);
    }

    $stmt->execute();
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $events = [];
}
 catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $events = [];
}
$conn = null;
?>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVENTY</title>
    <link rel="stylesheet" href="home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">

</head>

<body>
    <header>
        <nav class="navbar">
            <div class="navbar-left">
                <div class="logo">
                    <a href="#">EVENTY</a>
                </div>
                <ul class="navs">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#event-container">Events</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <form action="home.php" method="get">
                <div class="search-bar">
                    <div class="search-box">
                        <input type="text" name="title" placeholder="Search in Title...">
                        <input type="text" name="location" placeholder="Search in Location...">
                        <input type="datetime-local" name="event_date" id="event_date">
                        <input type="hidden" name="search_type" id="search_type" value="everything">
                        <button type="submit" class="fa-solid fa-magnifying-glass"></button>
                    </div>
                </div>
            </form>
            <ul class="nav-links">
    <!--<li><a href="./upload.php">Add Events</a></li>-->
    <li><span id="us"><i class="fa-solid fa-user"></i>
        <?php 
         

        if (isset($_SESSION['name'])) {
            echo $_SESSION['name'];
            echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>';
            echo '<li><a href="upload.php"><span class="glyphicon glyphicon-plus"></span> Add Event</a></li>';
        } else {
            echo '<li><a href="loog.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
        }
        if (isset($_SESSION['id']) && $_SESSION['id'] == 1) {
            echo '<li><a href="adm.php"><span class="glyphicon glyphicon-cogs"></span> Admin Dashboard</a></li>';
        }
        ?>
    </span></li>
</ul>

        </nav>
    </header>
    <main>
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/assets/e2.jpg" class="d-block w-100" alt="Event 1">
            <div class="carousel-caption d-none d-md-block">
               
            </div>
        </div>
        <div class="carousel-item">
            <img src="/assets/e1.jpg" class="d-block w-100" alt="Event 2">
            <div class="carousel-caption d-none d-md-block">
                
            </div>
        </div>
        <div class="carousel-item">
            <img src="/assets/e3.jpg" class="d-block w-100" alt="Event 3">
            <div class="carousel-caption d-none d-md-block">
                
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

        <section id="event-container" class="events">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <div class="event-card"
                        data-title="<?php echo htmlspecialchars(strtolower($event['title'])); ?>"
                        data-location="<?php echo htmlspecialchars(strtolower($event['location'])); ?>"
                        data-date="<?php echo htmlspecialchars($event['date']); ?>">
                        <img src="<?php echo htmlspecialchars($event['img']); ?>" alt="Event Image">
                        <div class="event-card-content">
                            <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                            <p><strong>Description: </strong><?php echo htmlspecialchars($event['description']); ?></p>
                            <p><strong>Organized by: </strong><?php echo htmlspecialchars($event['organisateur']); ?></p>
                            <p><strong>Date: </strong><?php echo date("F j, Y", strtotime($event['date'])); ?></p>
                            <p><strong>Location: </strong><?php echo htmlspecialchars($event['location']); ?></p>
                            <p><strong>Available Places: </strong><?php echo htmlspecialchars($event['places_dispo']); ?></p>
                            <a href="./reservations/formulaire.php?id=<?php echo htmlspecialchars($event['event_id']); ?>" class="btn btn-primary">Réserver</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No events available at the moment. Please check back later.</p>
            <?php endif; ?>
        </section>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </main>
    <footer>
        <div class='contactcontainer' id='contact'>
            <div class='concont'>
                <div class="titreg">
                    <h1>Nous rejoindre</h1>
                </div>
                <div class="partg">
                    <div class="parton">
                        <div>
                            <h3 class='ico'><i class="fa-solid fa-phone"></i> Tél</h3><span>+216 11 22 33 44
                            </span>
                        </div>
                    </div>
                    <div class="parttw">
                        <div>
                            <h3 class='ico'> <i class="fa-solid fa-envelope"></i> Email</h3>
                            <span>EVENTY@eventy.io</span>
                        </div>
                    </div>
                    <div class="partth">
                        <div class="soc">
                            <h3 class='ico'><i class="fa-solid fa-globe"></i> Social Media</h3><span><i class="fa-brands fa-instagram"></i>Eventy</span><span><i class="fa-brands fa-facebook"></i>EVENTY</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class='copy'>
                <hr id="ligne" />
                <span>Copyright 2024 © All Right Reserved</span>
            </div>
        </div>
    </footer>


    <script src="app.js"></script>
</body>

</html>