<?php
include "../Model/Guide.php";
require_once '../config.php'; // Use require_once instead of require

// ... rest of your code


class functions
{
    public function listGuide()
    {
        $sql = "SELECT * FROM guides";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addGuide($Guide)
    {
        $sql = "INSERT INTO guides (ID_guide,Nom, Prenom, Age, numTel, Email, nbvoyages) VALUES (:ID_guide, :Nom, :Prenom, :Age, :numTel, :Email, :nbvoyages)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'ID_guide' => $Guide->getID_guide(),
                'Nom' => $Guide->getNom(),
                'Prenom' => $Guide->getPrenom(),
                'Age' => $Guide->getAge(),
                'numTel' => $Guide->getnumTel(),
                'Email' => $Guide->getEmail(), 
                'nbvoyages' => $Guide->getnbvoyages()

            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deleteGuide($ID_guide)
    {
        $sql = "DELETE FROM guides WHERE ID_guide = :ID_guide";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':ID_guide', $ID_guide);

        try {
            $req->execute();
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function updateGuide($guides, $ID_guide)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE guides SET 
                    Nom = :Nom, 
                    Prenom = :Prenom,
                    Age = :Age,
                    numTel = :numTel,
                    Email = :Email,
                    nbvoyages = :nbvoyages
                 WHERE ID_guide = :ID_guide'
            );
    
            $query->execute([
                'ID_guide' => $ID_guide,
                'Nom' => $guides->getNom(),
                'Prenom' => $guides->getPrenom(),
                'Age' => $guides->getAge(),
                'numTel' => $guides->getnumTel(),
                'Email' => $guides->getEmail(),
                'nbvoyages' => $guides->getnbvoyages()
            ]);
    
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function afficheGuide($ID_pays) {
        try {
            $pdo = config::getConnexion();
            $query = $pdo->prepare("SELECT * FROM guides WHERE ID_pays = :ID");
            $query->execute(["ID" => $ID_pays]);
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function affichePays() {
        try {
            $pdo = config::getConnexion();
            $query = $pdo->prepare("SELECT * FROM pays");
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
   
    
}