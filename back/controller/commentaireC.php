<?php
require_once __DIR__.'/../config.php';

class commentaireC
{     

    public function liste_commentaire()
    {
        $sql = "SELECT * FROM commentaire";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            $result = array(); // Initialize the $result variable as an empty array
            foreach($liste as $l){
            $data["ID_commentaire"]=$l["ID_commentaire"];
            $data["id_article"]=$l["id_article"];
            $data["contenu_commentaire"]=$l["contenu_commentaire"];
            $data["date_de_publication_"]=$l["date_de_publication_"];
             $result[]=$data;
            }
            return $result;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function delete_commentaire($ide)
    {
        $sql = "DELETE FROM commentaire WHERE ID_commentaire = :ID_commentaire";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':ID_commentaire', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    

public function add_commentaire($commentaire)
{
    $sql = "INSERT INTO commentaire (ID_commentaire, id_article, contenu_commentaire, date_de_publication_) VALUES (:ID_commentaire, :id_article, :contenu_commentaire, :date_de_publication_)";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            ':ID_commentaire' => $commentaire->getID_commentaire(),
            ':id_article' => $commentaire->getid_article(),
            ':contenu_commentaire' => $commentaire->getContenu_commentaire(),
            ':date_de_publication_' => $commentaire->getDate_de_publication_()
        ]);
        echo "Comment added successfully.";
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage(); // Or log the error
        // Debug output
        echo "Debug: id_article = " . $commentaire->getid_article();
    }
}



    function showcommentaire($id)
    {
        $sql = "SELECT * from articles.commentaire where ID_commentaire = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $commentaire = $query->fetch();
            return $commentaire;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updatecommentaire($commentaire, $id)
    {   

                $sql = 'UPDATE commentaire SET 
                    contenu_commentaire = :contenu_commentaire, 
                    date_de_publication_ = :date_de_publication_
                WHERE ID_commentaire= :id';
            
            $db = config::getConnexion();
                        try {
            $query = $db->prepare($sql);
            $query->execute([
                'contenu_commentaire' => $commentaire->getcontenu_commentaire(),
                'date_de_publication_' => $commentaire->getdate_de_publication_(),
                ':id' => $id
            ]);
                
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    
}
