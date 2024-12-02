<?php
$message = "welcome";
session_start();
if (!isset($_SESSION['id'])) {
    session_destroy();
    header("location:login.php");
    exit;
}

require_once('../connect.php');
$connexion = connect();

$id_event = $_POST['id_event'];
$id_user = $_SESSION['id'];

$req1 = "select places_dispo from events where event_id=$id_event;";
$max_place = $connexion->query($req1)->fetch(PDO::FETCH_ASSOC)['places_dispo'];

$nom = $_POST['nom'];
$mail = $_POST['email'];
$nbrplace = $_POST['nombre_personnes'];

function validnom($nom)
{
    $expr = "/^[a-zA-ZÀ-ÖØ-öø-ÿ\s'-]+$/";
    $res = preg_match($expr, $nom);
    return strlen($nom) <= 20 && $res;
}

function validmail($mail)
{
    return filter_var($mail, FILTER_VALIDATE_EMAIL) !== false;
}

$message = '';
$type = '';

if (validnom($nom) && validmail($mail)) {
    if ($nbrplace <= $max_place) {
        $req2 = "INSERT INTO reservations (user_id, event_id, places_num) VALUES ($id_user, $id_event, $nbrplace);";
        $res = $connexion->exec($req2);

        $req3 = "UPDATE events SET places_dispo = places_dispo - $nbrplace WHERE event_id = $id_event;";
        $connexion->exec($req3);

        $message = "Réservation confirmée !";
        $type = "success";
    } else {
        $message = $nbrplace > $max_place ? "Nombre de places insuffisants !" : "Complet !";
        $type = "warning";
    }
} else {
    $message = "Il y a une erreur dans vos informations.";
    $type = "error";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        Swal.fire({
            title: '<?php echo $type === "success" ? "Succès" : "Attention"; ?>',
            text: '<?php echo $message; ?>',
            icon: '<?php echo $type; ?>',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                <?php if ($type === "success") { ?>
                window.location.href = "dashboard.php"; 
                <?php } else { ?>
                window.history.back();
                <?php } ?>
            }
        });
    });

</script>
</body>
</html>


<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Assurez-vous que le chemin est correct

if ($type === "success") {
    try {
        // Récupérer les informations sur l'événement
        $req4 = "SELECT date, location FROM events WHERE event_id = $id_event;";
        $event = $connexion->query($req4)->fetch(PDO::FETCH_ASSOC);
        $event_date = $event['date'];
        $event_location = $event['location'];

        // Configurer PHPMailer
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'abderrahmenmayssa@gmail.com'; // Remplacez par votre adresse email
        $mail->Password = 'ojdy nqtv tvnf ivml'; // Mot de passe d'application Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Définir l'expéditeur et le destinataire
        $mail->setFrom('abderrahmenmayssa@gmail.com', 'Organisateur des évènements');
        $mail->addAddress($mail, $nom); // CORRECTION : Ajoutez le mail récupéré depuis le formulaire

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = 'Confirmation de Réservation';
        $mail->Body = "
            <h1>Bonjour, $nom !</h1>
            <p>Votre réservation a été confirmée avec succès ! Voici les détails :</p>
            <ul>
                <li><strong>Nombre de places :</strong> $nbrplace</li>
                <li><strong>Date de l'événement :</strong> $event_date</li>
                <li><strong>Localisation :</strong> $event_location</li>
            </ul>
            <p>Merci d'avoir réservé avec nous. Nous avons hâte de vous voir !</p>
        ";

        // Envoyer l'email
        $mail->send();



    } catch (Exception $e) {
        // Journaliser l'erreur et afficher une alerte
        error_log("Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}");
        echo "<script>
            Swal.fire({
                title: 'Erreur',
                text: 'Une erreur est survenue lors de l\'envoi de l\'email : {$mail->ErrorInfo}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>