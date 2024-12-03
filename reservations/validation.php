<?php
session_start();
if (!isset($_SESSION['id'])) {
    session_destroy();
    header("location:login.php");
    exit;
}

require_once('../connect.php');
require_once('../vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$connexion = connect();

// Préparer et valider les entrées
$id_event = (int)$_POST['event_id'];
$id_user = (int)$_SESSION['id'];
$nom = trim($_POST['nom']);
$mail = trim($_POST['email']);
$nbrplace = (int)$_POST['nombre_personnes'];

// Validation des champs
function validnom($nom) {
    $expr = "/^[a-zA-ZÀ-ÖØ-öø-ÿ\s'-]+$/";
    return (strlen($nom) <= 20 && preg_match($expr, $nom));
}

function validmail($mail) {
    return filter_var($mail, FILTER_VALIDATE_EMAIL) !== false;
}

if (validnom($nom) && validmail($mail)) {
    // Requête préparée pour éviter les injections SQL
    $stmt = $connexion->prepare("SELECT places_dispo FROM events WHERE event_id = :event_id");
    $stmt->bindParam(':event_id', $id_event, PDO::PARAM_INT);
    $stmt->execute();
    $max_place = $stmt->fetch(PDO::FETCH_ASSOC)['places_dispo'];

    if ($nbrplace <= $max_place) {
        // Requête préparée pour l'insertion de la réservation
        $stmt2 = $connexion->prepare("INSERT INTO reservations (user_id, event_id, places_num, reservation_date) VALUES (:user_id, :event_id, :places_num, sysdate())");
        $stmt2->bindParam(':user_id', $id_user, PDO::PARAM_INT);
        $stmt2->bindParam(':event_id', $id_event, PDO::PARAM_INT);
        $stmt2->bindParam(':places_num', $nbrplace, PDO::PARAM_INT);
        $stmt2->execute();

        // Mise à jour du nombre de places disponibles
        $stmt3 = $connexion->prepare("UPDATE events SET places_dispo = places_dispo - :places_num WHERE event_id = :event_id");
        $stmt3->bindParam(':places_num', $nbrplace, PDO::PARAM_INT);
        $stmt3->bindParam(':event_id', $id_event, PDO::PARAM_INT);
        $stmt3->execute();

        // Envoyer l'email via PHPMailer
        try {
            $mail_send = new PHPMailer(true);
            $mail_send->isSMTP();
            $mail_send->Host = 'smtp.gmail.com'; // Serveur SMTP de Gmail
            $mail_send->SMTPAuth = true;
            $mail_send->Username = 'abderrahmenmayssa@gmail.com'; // Remplacez par votre email Gmail
            $mail_send->Password = 'ojdy nqtv tvnf ivml'; // Utilisez un mot de passe d'application si vous avez l'authentification 2FA
            $mail_send->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail_send->Port = 587; // Port SMTP standard pour STARTTLS

            // Debug SMTP pour vérifier les erreurs
            $mail_send->SMTPDebug = 2; // Niveau de débogage (1: Erreurs, 2: Tous les messages)

            // Destinataire
            $mail_send->setFrom('abderrahmenmayssa@gmail.com', 'admin');
            $mail_send->addAddress($mail, $nom); // L'email de l'utilisateur

            // Contenu de l'email
            $mail_send->isHTML(true);
            $mail_send->Subject = 'Confirmation de votre réservation';
            $mail_send->Body ="Dear $nom,Thank you for choosing Eventy for your events! We're excited to confirm that your reservation  of $nbrplace places for the event has been successfully processed.
If you have any questions or need to make changes to your reservation, feel free to reach out to us. Thank you again for your trust, and we look forward to seeing you at your event!
Best regards, The Eventy Team";

            // Envoi de l'email
            $mail_send->send();

            // Redirection après l'envoi de l'email
            header("Location: ../home.php");
            exit();
        } catch (Exception $e) {
            // Gestion des erreurs d'envoi d'email
            exit('Erreur lors de l\'envoi de l\'email: ' . $e->getMessage());
        }
    } else {
        // Si les places ne sont pas suffisantes, redirection vers la page précédente
        exit('Erreur: Le nombre de places demandées dépasse le nombre disponible.');
    }
} else {
    // Si les informations sont invalides, redirection vers la page précédente
    exit('Erreur: Nom ou email invalide.');
}
?>
