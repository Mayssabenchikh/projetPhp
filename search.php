<?php
$host = 'localhost';
$db = 'Entités';
$user = 'dsi2425';
$pass = 'dsi2425';

try {
    // Connexion à la base de données
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connexion échouée : " . $e->getMessage());
}

// Récupérer les paramètres de la requête
$title = isset($_GET['title']) ? $_GET['title'] : '';  
$location = isset($_GET['location']) ? $_GET['location'] : '';
$event_date = isset($_GET['event_date']) ? $_GET['event_date'] : '';

// Construire la requête de base
$sql = "SELECT * FROM events WHERE 1=1";

// Ajouter les conditions de filtre selon les paramètres fournis
if (!empty($title)) {
    $sql .= " AND title LIKE :title";
}

if (!empty($location)) {
    $sql .= " AND location LIKE :location";
}

if (!empty($event_date)) {
    // Convertir la date en format 'Y-m-d' pour la comparaison
    $event_date = date('Y-m-d', strtotime($event_date));
    $sql .= " AND DATE(date) = :event_date";
}

$stmt = $conn->prepare($sql);

// Lier les valeurs des paramètres de recherche
if (!empty($title)) {
    $stmt->bindValue(':title', '%' . htmlspecialchars($title) . '%');
}

if (!empty($location)) {
    $stmt->bindValue(':location', '%' . htmlspecialchars($location) . '%');
}

if (!empty($event_date)) {
    $stmt->bindValue(':event_date', $event_date);
}

// Exécuter la requête
$stmt->execute();

// Vérifier si des résultats sont trouvés
if ($stmt->rowCount() > 0) {
    echo "<h2>Résultats de recherche :</h2>";
    // Afficher les résultats
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<p><strong>Description :</strong> " . htmlspecialchars($row['description']) . "</p>";
        echo "<p><strong>Lieu :</strong> " . htmlspecialchars($row['location']) . "</p>";
        echo "<p><strong>Date :</strong> " . htmlspecialchars($row['date']) . "</p>";
        echo "<p><strong>Places disponibles :</strong> " . htmlspecialchars($row['places_dispo']) . "</p>";
        
        // Vérifier si une image est associée à l'événement
        if (!empty($row['img'])) {
            echo "<p><strong>Image :</strong><br><img src='" . htmlspecialchars($row['img']) . "' alt='Image de l'événement' style='max-width: 300px;'></p>";
        }

        echo "</div><hr>";
    }
} else {
    // Aucun événement trouvé
    echo "<p>Aucun événement trouvé.</p>";
}

$conn = null;
?>
