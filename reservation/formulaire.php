<?php
require_once('connect.php');
$connexion = connect();


$id_event=$_GET['id'];
$req1="select date from events where event_id=$id_event;";
$resultat=$connexion->query($req1);
$date = $resultat->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Réservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="main.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    
<div class="form-container">
        <div class="form-header">
            <h2>Réservez Votre Place !</h2>
        </div>

        <form action="validation.php" method="post">

        <input type="hidden" name="event_id" value="<?php echo $id_event; ?>">
            
            <div class="form-group position-relative mb-3">
                <i class="fas fa-user"></i>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom" required>
            </div>

           
            <div class="form-group position-relative mb-3">
                <i class="fas fa-envelope"></i>
                <input type="email" class="form-control" id="email" name="email" placeholder="Votre e-mail" required>
            </div>

            
            <div class="form-group position-relative mb-3">
                <i class="fas fa-calendar-alt"></i>
                <input type="text" class="form-control" id="date" name="date" value="<?php echo $date['date']; ?>" readonly required>
            </div>

            <div class="form-group position-relative mb-3">
                <i class="fas fa-users"></i>
                <input type="number" class="form-control" id="nombre_personnes" name="nombre_personnes" min="1" placeholder="Nombre de personnes" required>
            </div>

            <div class="form-group mb-3">
                <textarea class="form-control" id="commentaires" name="commentaires" rows="4" placeholder="Commentaires ou demandes spéciales..."></textarea>
            </div>

            <button type="submit"  class="btn-gold">Réserver</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
