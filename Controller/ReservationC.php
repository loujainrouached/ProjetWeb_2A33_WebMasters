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



}
?>
