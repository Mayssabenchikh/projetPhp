<?php
$host = 'localhost';
$db = 'Entités';
$user = 'dsi2425';
$pass = 'dsi2425';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connexion échouée : " . $conn->connect_error);
}

$category = isset($_GET['category']) ? $_GET['category'] : '';
$location = isset($_GET['location']) ? $_GET['location'] : '';
$event_date = isset($_GET['event_date']) ? $_GET['event_date'] : '';

$sql = "SELECT * FROM events WHERE 1=1";

if (!empty($category)) {
  $sql .= " AND category LIKE '%" . $conn->real_escape_string($category) . "%'";
}

if (!empty($location)) {
  $sql .= " AND location LIKE '%" . $conn->real_escape_string($location) . "%'";
}

if (!empty($event_date)) {
  $event_date = date('Y-m-d H:i:s', strtotime($event_date)); 
  $sql .= " AND date >= '" . $conn->real_escape_string($event_date) . "'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<h2>Résultats de recherche :</h2>";
  while ($row = $result->fetch_assoc()) {
      echo "<div>";
      echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
      echo "<p><strong>Description :</strong> " . htmlspecialchars($row['description']) . "</p>";
      echo "<p><strong>Lieu :</strong> " . htmlspecialchars($row['location']) . "</p>";
      echo "<p><strong>Date :</strong> " . htmlspecialchars($row['date']) . "</p>";
      echo "<p><strong>Places disponibles :</strong> " . htmlspecialchars($row['places_dispo']) . "</p>";
      echo "</div><hr>";
  }
} else {
  echo "<p>Aucun événement trouvé.</p>";
}

$conn->close();
?>