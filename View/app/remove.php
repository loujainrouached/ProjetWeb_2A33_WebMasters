<?php
require_once "config.php";

if(isset($_POST['id'])){
    $id = $_POST['id'];

    if(empty($id)){
       echo 0; // L'ID est vide, retourne 0 (erreur)
    } else {
        try {
            $conn = config::getConnexion(); // Assurez-vous que la connexion est correctement configurée

            $stmt = $conn->prepare("DELETE FROM todos WHERE id=?");
            $res = $stmt->execute([$id]);

            if($res){
                echo 1; // Suppression réussie, retourne 1 (succès)
            } else {
                echo 0; // La suppression a échoué, retourne 0 (erreur)
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage(); // Affiche l'erreur PDO s'il y en a une
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../voyage_back.php?mess=error");
    exit(); // Arrêter l'exécution du script après la redirection
}
?>
