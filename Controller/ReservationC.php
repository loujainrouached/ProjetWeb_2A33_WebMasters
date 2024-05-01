<?php
require '../config.php';

class ReservationC {

    public function ajouterReservation($reservation) {
        $sql = "INSERT INTO Reservation (id_voyage, date_reservation, nombre_personnes, numero_personne) VALUES (?, ?, ?, ?)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                $reservation->getIdVoyage(),
                $reservation->getDateReservation(),
                $reservation->getNombrePersonnes(),
                $reservation->getNumeroPersonne()
            ]);

        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function listeReservation()
    {
    $sql = "SELECT * FROM Reservation";
     $db = config::getConnexion();
     try {
     $query = $db->prepare($sql);
     $query->execute();
     $result = $query->fetchAll(PDO::FETCH_ASSOC); 
    return $result;
                
    } catch(Exception $e) {
    die('Error: ' . $e->getMessage()); 
    }
    }


    public function getVoyageById($id) {
        try {
            $pdo = config::getConnexion();
            $query = $pdo->prepare("SELECT * FROM voyages WHERE id = :id");
            $query->execute(["id" => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

   
    public function updateReservation($id, $id_voyage, $nombre_personnes, $numero_personne)
    {
        $db = config::getConnexion(); 
        
        // Utilisez une requête SQL sans inclure le champ date_reservation
        $sql = "UPDATE Reservation SET id_voyage = :id_voyage, nombre_personnes = :nombre_personnes, numero_personne = :numero_personne WHERE id = :id";
     
        // Préparez la requête
        $query = $db->prepare($sql);
    
        // Liez les paramètres
        $query->bindParam(':id_voyage', $id_voyage);
        $query->bindParam(':nombre_personnes', $nombre_personnes);
        $query->bindParam(':numero_personne', $numero_personne);
        $query->bindParam(':id', $id);
    
        // Exécutez la requête SQL
        return $query->execute();
    }
    
    
    public function deleteReservation($id) {
        try {
            $sql = "DELETE FROM `Reservation` WHERE id = :id";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();
    
            // Redirect after successful deletion
            header("Location: user.php?msg=Data deleted successfully");
            exit(); // Terminate script execution after redirection
        } catch (PDOException $e) {
            // Handle any database-related errors
            die('Error:' . $e->getMessage());
        }
    }
    







}
?>
