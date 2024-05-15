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
        $sql = "INSERT INTO pays (ID_pays,NomP, Capital, monuments) VALUES (:ID_pays, :NomP, :Capital, :monuments )";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'ID_pays' => $pays->getID_pays(),
                'NomP' => $pays->getNomP(),
                'Capital' => $pays->getCapital(),
                'monuments' => $pays->getmonuments()
                
                

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

    function updatePays($pays, $ID_pays)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE pays SET 
                    NomP = :NomP, 
                    Capital = :Capital,
                    monuments = :monuments
                    
                    
                 WHERE ID_pays = :ID_pays'
            );
    
            $query->execute([
                'ID_pays' => $ID_pays,
                'NomP' => $pays->getNomP(),
                'Capital' => $pays->getCapital(),
                'monuments' => $pays->getmonuments()
                
                
            ]);
    
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
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
    
  /*  public function affichePays() {
        try {
            $pdo = config::getConnexion();
            $query = $pdo->prepare("SELECT * FROM pays");
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }*/
    function searchPays($NomP)
    {
        $sql = "SELECT * FROM pays WHERE NomP LIKE :NomP";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':NomP', '%' . $NomP . '%', PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function tripmonuments($order = 'ASC') {
        $sql = "SELECT * FROM pays ORDER BY monuments $order";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:'. $e->getMessage());
        }
    }
    function getguides()
    {
        try {
            $pdo = config::getConnexion();
            $sql = "SELECT p.NomP AS country, COUNT(g.ID_guide) AS guide_count
                    FROM pays p
                    LEFT JOIN guides g ON p.ID_pays = g.ID_pays
                    GROUP BY p.ID_pays";
    
            $stmt = $pdo->query($sql);
    
            $labels = [];
            $data = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $labels[] = $row['country'];
                $data[] = $row['guide_count'];
            }
    
           
    
            return ['labels' => $labels, 'data' => $data];
        } catch (PDOException $e) {
            echo "Error executing the query: " . $e->getMessage();
            return ['labels' => [], 'data' => []];
        }
    }
}
    
    

    
    
