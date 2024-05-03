<?php
class Reponses
{
    private ?int $id_reponse = null;
    private ?string $date_reponse = null;
    private ?string $rep = null;
    private ?int $id_reclamation = null;
    
    public function __construct($id_reponse=null,$date_reponse,$rep,$id_reclamation)
    {
        
        $this->id_reponse = $id_reponse;
        $this->date_reponse = $date_reponse;
        $this->rep= $rep;
        $this->id_reclamation= $id_reclamation;
        
        
       
    }
    
    public function getIdReclamation()
    {
        return $this->id_reclamation; 
    }
   

    public function getIdReponse()
    {
        return $this->id_reponse; 
    }

    public function getRep() 
    {
        return $this->rep;
    }

    public function setRep($rep)
    {
        $this->rep = $rep;
        return $this;
    }

    public function getDateReponse() 
    {
        return $this->date_reponse;
    }

    public function setDateReponse($date_reponse)
    {
        $this->date_reponse = $date_reponse;

        return $this;
    }
}

