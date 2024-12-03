


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
    <input type="text" name="title"  required>
    <br>
    
    <label for="description">Description:</label>
    <input type="text" name="description" required><br>
    
    <label for="date">Date:</label>
    <input type="datetime-local" name="date" required><br>
    
    <label for="location">Lieu:</label>
    <input type="text" name="location" required><br>
    
    <label for="places_dispo">Places disponibles:</label>
    <input type="number" name="places_dispo" required><br>
    
    <label for="img">Image:</label>
    <input type="text" name="img" required><br>
    <input type="hidden" name="organisateur_id" value="<?php echo $_SESSION['user_id']; ?>">
    <input type="submit" value="Ajouter l'événement">
</form>

</body>
</html>

<?php



session_start();
if (isset($_SESSION['id'])) {
    //echo "ID de l'utilisateur connecté : " . $_SESSION['id'];
} else {
    echo "Aucun utilisateur connecté.";
}



require("config.php");

$title = $_POST['title'];
$description = $_POST['description'];
$date = $_POST['date'];
$location = $_POST['location'];
$places_dispo = $_POST['places_dispo'];
$img = $_POST['img'];
$organisateur_id = $_SESSION['id']; 

if (empty($title) || empty($description) || empty($date) || empty($location) || empty($places_dispo) || empty($img)) {
    echo "Tous les champs sont obligatoires. Veuillez remplir le formulaire correctement.";
    exit();
}

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $requete = "INSERT INTO events (title, description, date, location, places_dispo, img, organisateur_id) 
                VALUES (:title, :description, :date, :location, :places_dispo, :img, :organisateur_id)";
    $stmt = $pdo->prepare($requete);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':places_dispo', $places_dispo);
    $stmt->bindParam(':img', $img);
    $stmt->bindParam(':organisateur_id', $organisateur_id); // Associe l'utilisateur connecté
    $stmt->execute();

    $_SESSION['message'] = "Événement ajouté avec succès!";
    $_SESSION['message_type'] = "success";
    header("location:/home.php");
    exit();

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}


?>