

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Add Events</title>
    <link rel="stylesheet" href="upload.css">
</head>
<body>
    
    <form action="upload.php" method="POST" enctype="multipart/form-data">
    <h2>Ajouter un événement </h2>
    <label for="title">Titre de l'événement:</label>
    <input type="text" name="title" required><br>
    
    <label for="description">Description:</label>
    <input type="text" name="description" required><br>
    
    <label for="date">Date:</label>
    <input type="datetime-local" name="date" required><br>
    
    <label for="location">Lieu:</label>
    <input type="text" name="location" required><br>
    
    <label for="places_dispo">Places disponibles:</label>
    <input type="number" name="places_dispo" required><br>
    
    <label for="img">Image:</label>
    <input type="text" name="img_url" required><br>
    
    <input type="submit" value="Ajouter l'événement">
</form>

</body>
</html>
<?php
$host = 'localhost';
$db = 'Entités';
$user = 'dsi2425';
$pass = 'dsi2425';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $places_dispo = $_POST['places_dispo'];
    $imgUrl = $_POST['img_url']; 
    
    $sql = "INSERT INTO events (title, description, date, location, places_dispo, img) 
            VALUES (:title, :description, :date, :location, :places_dispo, :img)";
    
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':places_dispo', $places_dispo, PDO::PARAM_INT);
    $stmt->bindParam(':img', $imgUrl, PDO::PARAM_STR); 

    if ($stmt->execute()) {
        header("Location: home.php");
        exit;
    } else {
        echo "<h3 class='error'>Erreur lors de l'ajout de l'événement.</h3>";
    }
    
}

$conn = null;
?>
