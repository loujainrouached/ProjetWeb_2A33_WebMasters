<?php
require_once '../config.php'; // Use require_once instead of require


class articleC
{

    public function liste_article()
    {
        $sql = "SELECT * FROM articles";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            foreach($liste as $l){
            $data["id_article"]=$l["id_article"];   
             $data["titre_article"]=$l["titre_article"];
             $data["contenu_article"]=$l["contenu_article"];
             $data["date_de_publication"]=$l["date_de_publication"];
             $result[]=$data;
            }
            return $result;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function delete_article($ide)
    {
        $sql = "DELETE FROM articles WHERE id_article = :id_article";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_article', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    

    function add_article($article)
    {
        $sql = "INSERT INTO articles (id_article, titre_article, contenu_article, date_de_publication) VALUES (:id_article, :titre_article, :contenu_article, :date_de_publication)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            
            $query->bindValue(':id_article', $article->getid_article());
            $query->bindValue(':titre_article', $article->gettitre_article());
            $query->bindValue(':contenu_article', $article->getcontenu_article());
            $query->bindValue(':date_de_publication', $article->getdate_de_publication());
            
            $query->execute();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showarticle($id)
    {
        $sql = "SELECT * from articles.articles where id_article = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $article = $query->fetch();
            return $article;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updatearticle($article, $id)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE articles SET 
                    titre_article = :titre_article, 
                    contenu_article = :contenu_article, 
                    date_de_publication = :date_de_publication
                WHERE id_article= :id'
            );
            
            $query->execute([
                'titre_article' => $article->gettitre_article(),
                'contenu_article' => $article->getcontenu_article(),
                'date_de_publication' => $article->getdate_de_publication(),
                ':id_article' => $id
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }


}
