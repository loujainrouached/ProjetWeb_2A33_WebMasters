<?php
class commentaire
{
    private ?int $ID_commentaire = null;
    private ?string $id_article = null;
    private ?string $contenu_commentaire = null;
    private ?string $date_de_publication_ = null;


    

    public function __construct($id = null,$id1,$c,$d )
    {
        $this->ID_commentaire = $id;
        $this->id_article = $id1;
        $this->contenu_commentaire = $c;
        $this->date_de_publication_ = $d;
        
    }


    public function getId_commentaire()
    {
        return $this->ID_commentaire;
    }

    public function getid_article()
    {
        return $this->id_article;
    }

    public function getcontenu_commentaire()
    {
        return $this->contenu_commentaire;
    }


    public function setcontenu_commentaire($contenu_commentaire)
    {
        $this->contenu_commentaire = $contenu_commentaire;

        return $this;
    }


    public function getdate_de_publication_()
    {
        return $this->date_de_publication_;
    }


    public function setdate_de_publication_($date_de_publication_)
    {
        $this->date_de_publication_ = $date_de_publication_;

        return $this;
    }
}
