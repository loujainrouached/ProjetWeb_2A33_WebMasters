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
    



    function getMonthlyReservationData()
    {
        try {
            // Obtenez une instance de connexion PDO en appelant la méthode statique getConnexion de la classe config
            $pdo = config::getConnexion();
    
            // Exécutez une requête SQL pour obtenir le nombre de réservations pour chaque mois
            $sql = "SELECT COUNT(*) AS nombre_reservations, MONTH(date_reservation) AS mois
                    FROM reservation
                    WHERE YEAR(date_reservation) = YEAR(CURRENT_DATE())
                    GROUP BY MONTH(date_reservation)";
    
            // Exécution de la requête SQL
            $stmt = $pdo->query($sql);
    
            // Préparation des données pour le graphique
            $labels = [];
            $data = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Utilisez la fonction date() pour obtenir le nom du mois à partir de son numéro
                $mois = date('F', mktime(0, 0, 0, $row['mois'], 1));
                $labels[] = $mois;
                $data[] = $row['nombre_reservations'];
            }
    
            // Retourner les données sous forme de tableau associatif
            return ['labels' => $labels, 'data' => $data];
        } catch (PDOException $e) {
            // En cas d'erreur, afficher le message d'erreur
            echo "Erreur d'exécution de la requête : " . $e->getMessage();
            // Retourner une valeur par défaut (par exemple, un tableau vide)
            return ['labels' => [], 'data' => []];
        }
    }
    



}
?>
