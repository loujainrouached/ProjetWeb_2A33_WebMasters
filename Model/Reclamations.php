<?php

class Reclamations
{
    private ?int $id_reclamation = null;
    private ?string $id_client = null;
    private ?string $date_reclamation = null;
    private ?string $titre_reclamation = null;
    private ?string $contenu = null;

    public function __construct($id_reclamation,$id_client,$date_reclamation,$titre_reclamation,$contenu)
    {
        $this->id_reclamation= $id_reclamation;
        $this->id_client= $id_client;  
        $this->date_reclamation=$date_reclamation;
        $this->titre_reclamation=$titre_reclamation;
        $this->contenu= $contenu;
    }


    public function getIdReclamation()
    {
        return $this->id_reclamation;
    }


    public function getIdClient()
    {
        return $this->id_client;
    }


    public function setIdClient($id_client)
    {
        $this->id_client= $id_client;

        return $this;
    }


    public function getDateReclamation()
    {
        return $this->date_reclamation;
    }


    public function setDateReclamation($date_reclamation)
    {
        $this->date_reclamation = $date_reclamation;

        return $this;
    }


    public function getTitreReclamation()
    {
        return $this->titre_reclamation;
    }


    public function setTitreReclamation($titre_reclamation)
    {
        $this->titre_reclamation = $titre_reclamation;

        return $this;
    }

    public function getContenu()
    {
        return $this->contenu;
    }


    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

}
