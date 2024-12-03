<?php
    try {
        $connexion = new PDO("mysql:host=localhost;dbname=Entités", "dsi2425", "dsi2425");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if($connexion) {
            // Get the 'id' parameter from the URL and validate it
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

            if ($id > 0) {
                // Prepare the DELETE query using a prepared statement
                $req = "DELETE FROM users WHERE user_id = :id";
                $stmt = $connexion->prepare($req);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                // Execute the statement and check if any row was affected
                $stmt->execute();

                // Redirect to affiche.php after successful deletion
                header("Location: affiche.php");
                exit; // Always use exit after header to stop further script execution
            } else {
                echo "Invalid ID provided.";
            }
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
