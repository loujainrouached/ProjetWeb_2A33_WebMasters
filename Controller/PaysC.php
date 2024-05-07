<?php
include "../Model/Pays.php";
require_once '../config.php'; // Use require_once instead of require

// ... rest of your code


class functions
{
    public function listPays()
    {
        $sql = "SELECT * FROM pays";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addPays($pays)
    {
        $sql = "INSERT INTO pays (ID_pays,NomP, Capital, monuments, ID_guide) VALUES (:ID_pays, :NomP, :Capital, :monuments, :ID_guide )";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'ID_pays' => $pays->getID_pays(),
                'NomP' => $pays->getNomP(),
                'Capital' => $pays->getCapital(),
                'monuments' => $pays->getmonuments(),
                'ID_guide' => $pays->getID_guide()
                

            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deletePays($ID_pays)
    {
        $sql = "DELETE FROM pays WHERE ID_pays = :ID_pays";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':ID_pays', $ID_pays);

        try {
            $req->execute();
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }
/*
    function showPays($ide)
    {
        $sql = "SELECT * from Pays where ID_Pays = :ID_Pays";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['ID_Pays' => $ID_Pays]);
            $Pays = $query->fetch();
            return $Pays;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }*/
/*
    function updatePays($Pays, $ID_pays)
    {
        try {
            $db = configP::getConnexion();
            $query = $db->prepare(
                'UPDATE Pays SET 
                    NomP = :NomP, 
                    Capital = :Capital,
                    monuments = :monuments,
                    ID_guide = :ID_guide
                    
                 WHERE ID_pays = :ID_pays'
            );
    
            $query->execute([
                'ID_Pays' => $ID_Pays,
                'NomP' => $Pays->getNomP(),
                'Capital' => $Pays->getCapital(),
                'monuments' => $Pays->getmonuments(),
                'ID_guide' => $Pays->getID_guide()
                
            ]);
    
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }*/
    /*
    public function affichecomments($idblog) {
        try {
            $pdo = config::getConnexion();
            $query = $pdo->prepare("SELECT * FROM comment WHERE idblog = :id");
            $query->execute(["id" => $idblog]);
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }*/
    
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