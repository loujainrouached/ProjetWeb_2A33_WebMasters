<?php

require '../config.php';

class VoyageC{

public function listeVoyage()
{
$sql = "SELECT * FROM Voyage";
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



public function ajoutVoyage($voyage) {
    $sql = "INSERT INTO Voyage (type, destination, dateDepart, dateRetour, image)
    VALUES (:type, :destination, :dateDepart, :dateRetour, :image)";

    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'type' => $voyage->getType(),
            'destination' => $voyage->getDestination(),
            'dateDepart' => $voyage->getDateDepart(),
            'dateRetour' => $voyage->getDateRetour(),
            'image' => $voyage->getImage(),
            
        ]);
       
} catch (Exception $e) 
{
echo 'Error: ' . $e->getMessage();
}
}
    
public function updateVoyage($id, $type, $destination, $dateDepart, $dateRetour, $image)
{
    $db = config::getConnexion(); 
    
    $sql = "UPDATE voyage SET type = :type, destination = :destination, dateDepart = :dateDepart, dateRetour = :dateRetour, image = CASE WHEN :image IS NOT NULL THEN :image ELSE image END WHERE id = :id";

   
    $query = $db->prepare($sql);

    // Liez les paramètres
    $query->bindParam(':type', $type);
    $query->bindParam(':destination', $destination);
    $query->bindParam(':dateDepart', $dateDepart);
    $query->bindParam(':dateRetour', $dateRetour);
    $query->bindParam(':id', $id);
    $query->bindParam(':image', $image, PDO::PARAM_STR); // Assurez-vous que :image est lié en tant que chaîne de caractères

    // Exécutez la requête SQL
    return $query->execute();
}


public function deleteVoyage($id) {
    try {
        $sql = "DELETE FROM `Voyage` WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        // Redirect after successful deletion
        header("Location: voyage_back.php?msg=Data deleted successfully");
        exit(); // Terminate script execution after redirection
    } catch (PDOException $e) {
        // Handle any database-related errors
        die('Error:' . $e->getMessage());
    }
}



function getReservationData()
{
    try {
        // Obtenez une instance de connexion PDO en appelant la méthode statique getConnexion de la classe config
        $pdo = config::getConnexion();

        $sql = "SELECT v.destination, COUNT(r.id) AS nombre_reservations
                FROM reservation r
                INNER JOIN voyage v ON r.id_voyage = v.id
                GROUP BY v.destination";

        // Exécution de la requête SQL
        $stmt = $pdo->query($sql);

        // Préparation des données pour le graphique
        $labels = [];
        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $labels[] = $row['destination'];
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