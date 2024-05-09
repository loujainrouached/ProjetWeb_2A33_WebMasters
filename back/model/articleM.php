<?php
class article
{
    private ?int $id_article = null;
    private ?string $titre_article = null;
    private ?string $contenu_article = null;
    private ?string $date_de_publication = null;

    public function __construct($t, $c, $d,$id = null )
    {
        $this->titre_article = $t;
        $this->contenu_article = $c;
        $this->date_de_publication = $d;
        $this->id_article = $id;
    }


    public function getId_article()
    {
        return $this->id_article;
    }


    public function gettitre_article()
    {
        return $this->titre_article;
    }


    public function settitre_article($titre_article)
    {
        $this->titre_article = $titre_article;

        return $this;
    }


    public function getcontenu_article()
    {
        return $this->contenu_article;
    }


    public function setcontenu_article($contenu_article)
    {
        $this->contenu_article = $contenu_article;

        return $this;
    }


    public function getdate_de_publication()
    {
        return $this->date_de_publication;
    }


    public function setdate_de_publication($date_de_publication)
    {
        $this->date_de_publication = $date_de_publication;

        return $this;
    }
}
