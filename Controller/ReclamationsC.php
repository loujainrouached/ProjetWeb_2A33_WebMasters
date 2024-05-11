<?php

require_once __DIR__.'/../config.php';

class ReclamationsC

{
    public function listReclamationsAdmin()
    {
        $sql = "SELECT * FROM reclamations";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            $this->markAllReclamationsAsSeen();
            $res = []; 
            foreach($liste as $l)
            {
             $data["id_reclamation"]=$l["id_reclamation"];   
             $data["id_client"]=$l["id_client"];
             $data["date_reclamation"]=$l["date_reclamation"];
             $data["titre_reclamation"]=$l["titre_reclamation"];
             $data["contenu"]=$l["contenu"];
             $res[]=$data;
            }
            return $res;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    private function markAllReclamationsAsSeen()
    {
        $sql = "UPDATE reclamations SET vue_par_admin = 1";
        $db = config::getConnexion();
        try {
            $db->exec($sql);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    
    public function listReclamations()
    {
        $sql = "SELECT * FROM reclamations";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            foreach($liste as $l)
            {
             $data["id_reclamation"]=$l["id_reclamation"];   
             $data["id_client"]=$l["id_client"];
             $data["date_reclamation"]=$l["date_reclamation"];
             $data["titre_reclamation"]=$l["titre_reclamation"];
             $data["contenu"]=$l["contenu"];
             $result[]=$data;
            }
            return $result;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteReclamations($ide)
    {
        $sql = "DELETE FROM reclamations WHERE id_reclamation = :id_reclamation";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_reclamation', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    

    function addReclamations($Reclamations)
    {
        $sql = "INSERT INTO reclamations( id_client, date_reclamation, titre_reclamation, contenu,vue_par_admin) VALUES ( :id_client, :date_reclamation, :titre_reclamation, :contenu,0)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_client' => $Reclamations->getIdClient(),
                'date_reclamation' => $Reclamations->getDateReclamation(),
                'titre_reclamation' => $Reclamations->getTitreReclamation(),
                'contenu' => $Reclamations->getContenu(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        
    }


    function showReclamations($id_reclamation)
    {
        $sql = "SELECT * from reclamations where id_reclamation = $id_reclamation";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $Reclamations = $query->fetch();
            return $Reclamations;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }



    function updateReclamation($reclamation, $id) {
        $sql = 'UPDATE reclamations SET 
        id_client = :id_client, 
        date_reclamation = :date_reclamation, 
        titre_reclamation = :titre_reclamation,
        contenu = :contenu
        WHERE id_reclamation = :id_reclamation';

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_reclamation' => $reclamation->getIdReclamation(),
                'id_client' => $reclamation->getIdClient(),
                'date_reclamation' => $reclamation->getDateReclamation(),
                'titre_reclamation' => $reclamation->getTitreReclamation(),
                'contenu' => $reclamation->getContenu(),
            ]);
        }
        catch (PDOException $e) {
            $e->getMessage();
        }
    }


    public function afficheReponse($id_reclamation) {
        try  {
            $pdo = new PDO("mysql:host=localhost;dbname=reclamations", "root", ""); // Replace with your connection details
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $query = $pdo->prepare("SELECT * FROM reponses WHERE id_reclamation=:id_reclamation");
            $query->execute(['id_reclamation' => $id_reclamation]);
            return $query->fetchAll();
    
        } catch(PDOException $e) {
            // Log or handle the error appropriately
            echo $e->getMessage();
             // Return an empty array in case of error
        }
    
    }
    public function afficheReclamation() {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=reclamations", "root", ""); // Replace with your connection details
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $query = $pdo->prepare("SELECT * FROM reclamations");
            $query->execute();
            return $query->fetchAll();
            // Debugging: Output the retrieved IDEVALs
            
            
    
        } catch(PDOException $e) {
            // Log or handle the error appropriately
            echo $e->getMessage();
           
        }
    
    }

    function getReponses()
    {
        try {
            $pdo = config::getConnexion();
            $sql = "SELECT r.titre_reclamation AS title, COUNT(rp.id_reclamation) AS reponse_count
                    FROM reclamations r
                    LEFT JOIN reponses rp ON r.id_reclamation = rp.id_reclamation
                    GROUP BY r.id_reclamation";
    
            $stmt = $pdo->query($sql);
    
            $labels = [];
            $data = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $labels[] = $row['title'];
                $data[] = $row['reponse_count'];
            }
    
           
    
            return ['labels' => $labels, 'data' => $data];
        } catch (PDOException $e) {
            echo "Error executing the query: " . $e->getMessage();
            return ['labels' => [], 'data' => []];
        }
    }


    public function countUnreadReclamations()
{
    $sql = "SELECT COUNT(*) AS count FROM reclamations WHERE vue_par_admin = 0";
    $db = config::getConnexion();
    try {
        $stmt = $db->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}



public function listUnreadReclamationsAdmin()
{
    $sql = "SELECT * FROM reclamations WHERE vue_par_admin = 0";
    $db = config::getConnexion();
    try {
        $stmt = $db->query($sql);
        $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rec;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}
public function getReponsesForReclamation($id_reclamation)
{
    $sql = "SELECT * FROM reponses WHERE id_reclamation=:id_reclamation";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute(['id_reclamation' => $id_reclamation]);
        $reponses = $query->fetchAll(PDO::FETCH_ASSOC);
        return $reponses;
    } catch (PDOException $e) {
        // Log or handle the error appropriately
        echo $e->getMessage();
        return []; // Retourne un tableau vide en cas d'erreur
    }
}




    
    

   

   
    

    
   
}