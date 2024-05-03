<?php

require __DIR__.'/../config.php';

class ReclamationsC
{

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
        $sql = "INSERT INTO reclamations( id_client, date_reclamation, titre_reclamation, contenu) VALUES ( :id_client, :date_reclamation, :titre_reclamation, :contenu)";
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
   
}