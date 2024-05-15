<?php
class Pays
{
    private ?int $ID_pays = null;
    private ?string $NomP = null;
    private ?string $Capital = null;
    private ?int $monuments= null;
    
    
    

    public function __construct($ID, $N, $P,$A)
    {
        $this->ID_pays = $ID;
        $this->NomP = $N;
        $this->Capital = $P;
        $this->monuments = $A;
        
        
    }


    public function getID_pays()
    {
        return $this->ID_pays;
    }


    public function getNomP()
    {
        return $this->NomP;
    }


    public function setNomP($NomP)
    {
        $this->NomP = $NomP;

        return $this;
    }


    public function getCapital()
    {
        return $this->Capital;
    }


    public function setCapital($Capital)
    {
        $this->Capital = $Capital;

        return $this;
    }
    
    public function getmonuments()
    {
        return $this->monuments;
    }


    public function setmonuments($monuments)
    {
        $this->monuments = $monuments;

        return $this;
    }

   
    
   

}
