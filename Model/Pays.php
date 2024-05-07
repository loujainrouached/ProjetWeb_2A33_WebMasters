<?php
class Pays
{
    private ?int $ID_pays = null;
    private ?string $NomP = null;
    private ?string $Capital = null;
    private ?int $monuments= null;
    private ?int $ID_guide = null;
    
    

    public function __construct($ID, $N, $P,$A,$n)
    {
        $this->ID_pays = $ID;
        $this->NomP = $N;
        $this->Capital = $P;
        $this->monuments = $A;
        $this->ID_guide = $n;
        
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

    public function getID_guide()
    {
        return $this->ID_guide;
    }

    public function setID_guide($ID_guide)
    {
        $this->ID_guide = $ID_guide;

        return $this;
    }
    
   

}
