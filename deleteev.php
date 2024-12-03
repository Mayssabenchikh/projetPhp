<?php
    // require_once('../includes/header.php');
    // require_once('../connect.php');
    
    try {
        $connexion = new PDO("mysql:host=localhost;dbname=Entités", "dsi2425", "dsi2425");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier que l'ID est passé et qu'il est valide
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id2 = $_GET['id'];

            // Utilisation d'une requête préparée pour éviter l'injection SQL
            $req = "DELETE FROM events WHERE event_id = :id";
            $stmt = $connexion->prepare($req);
            
            // Lier le paramètre et exécuter la requête
            $stmt->bindParam(':id', $id2, PDO::PARAM_INT);
            $stmt->execute();
            
            // Vérifier si la suppression a été effectuée avec succès
            if ($stmt->rowCount() > 0) {
                // Rediriger après la suppression réussie
                header("Location: affiche2.php");
                exit;  // Arrêter l'exécution après la redirection
            } else {
                echo "Aucun événement trouvé avec cet ID.";
            }
        } else {
            echo "ID invalide.";
        }

    } catch (PDOException $e) {
        echo "Erreur de connexion ou d'exécution : " . $e->getMessage();
    }
    
    // require_once('../includes/footer.php');
?>
