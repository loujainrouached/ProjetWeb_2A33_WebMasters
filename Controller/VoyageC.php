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
    $db = config::getConnexion(); // Obtenez une instance de la connexion à la base de données

    // Préparez la requête SQL pour mettre à jour le voyage avec ou sans l'image
    $sql = "UPDATE voyage SET type = :type, destination = :destination, dateDepart = :dateDepart, dateRetour = :dateRetour, image = CASE WHEN :image IS NOT NULL THEN :image ELSE image END WHERE id = :id";

    // Préparez la requête SQL
    $stmt = $db->prepare($sql);

    // Liez les paramètres
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':destination', $destination);
    $stmt->bindParam(':dateDepart', $dateDepart);
    $stmt->bindParam(':dateRetour', $dateRetour);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':image', $image, PDO::PARAM_STR); // Assurez-vous que :image est lié en tant que chaîne de caractères

    // Exécutez la requête SQL
    return $stmt->execute();
}


public function deleteVoyage($id) {
    try {
        $sql = "DELETE FROM `Voyage` WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        // Redirect after successful deletion
        header("Location: element.php?msg=Data deleted successfully");
        exit(); // Terminate script execution after redirection
    } catch (PDOException $e) {
        // Handle any database-related errors
        die('Error:' . $e->getMessage());
    }
}




}