<?php

class Reclamations
{
    private ?int $id_reclamation = null;
    private ?string $id_user = null;
    private ?string $date_reclamation = null;
    private ?string $titre_reclamation = null;
    private ?string $contenu = null;
    private ?string $vue_par_admin = null;

    public function __construct($id_reclamation,$id_user,$date_reclamation,$titre_reclamation,$contenu,$vue_par_admin)
    {
        $this->id_reclamation= $id_reclamation;
        $this->id_user= $id_user;  
        $this->date_reclamation=$date_reclamation;
        $this->titre_reclamation=$titre_reclamation;
        $this->contenu= $contenu;
        $this->vue_par_admin= $vue_par_admin;
    }


    public function getIdReclamation()
    {
        return $this->id_reclamation;
    }




    
    public function getVueParAdmin()
    {
        return $this->vue_par_admin;
    }


    public function setVueParAdmin($vue_par_admin)
    {
        $this->vue_par_admin= $vue_par_admin;

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
