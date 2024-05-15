<?php




class ReponsesC
{

    public function listReponses()
    {
        $sql = "SELECT * FROM reponses";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            foreach($liste as $l)
            {     
              $data["id_reponse"]=$l["id_reponse"];
              $data["date_reponse"]= $l["date_reponse"]; 
              $data["rep"]= $l["rep"];  
              $data["id_reclamation"]= $l["id_reclamation"];   
              $result[]=$data;
  
            }
           // return $result;

        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteReponses($id_reponse)
    {
        $sql = "DELETE FROM reponses WHERE id_reponse = :id_reponse";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_reponse', $id_reponse);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }



public function addReponse($Reponses)
{   
    $sql = "INSERT INTO reponses (id_reponse, date_reponse,rep,id_reclamation) VALUES (:id_reponse,:date_reponse,:rep,:id_reclamation)";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'id_reponse' => $Reponses->getIdReponse(),
            'date_reponse' => $Reponses->getDateReponse(),
            'rep' => $Reponses->getRep(),
            'id_reclamation'=> $Reponses->getIdReclamation() 
        ]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage(); 
    }

}



    function showReponse($id_reponse)
    {
        $sql = "SELECT * from reponses where id_reponse = $id_reponse";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $Reponses = $query->fetch();
            return $Reponses;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function updateReponse($Reponses, $idr)
{
    $sql = 'UPDATE reponses SET 
            date_reponse = :date_reponse, 
            rep = :rep
            WHERE id_reponse = :id_reponse';

    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'date_reponse' => $Reponses->getDateReponse(),
            'rep' => $Reponses->getRep(),
            'id_reponse' => $idr

        ]);
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

}
