<?php
class Guides
{
    private ?int $ID_guide = null;
    private ?string $Nom = null;
    private ?string $Prenom = null;
    private ?int $Age = null;
    private ?int $numTel = null;
    private ?string $Email  = null;
    private ?int $nbvoyages = null;
    private ?int $ID_pays = null;
    

    public function __construct($ID, $N, $P,$A,$n,$E,$nb,$IDe)
    {
        $this->ID_guide = $ID;
        $this->Nom = $N;
        $this->Prenom = $P;
        $this->Age = $A;
        $this->numTel = $n;
        $this->Email = $E;
        $this->nbvoyages = $nb;
        $this->ID_pays = $IDe;
        
    }


    public function getID_guide()
    {
        return $this->ID_guide;
    }


    public function getNom()
    {
        return $this->Nom;
    }


    public function setNom($Nom)
    {
        $this->Nom = $Nom;

        return $this;
    }


    public function getPrenom()
    {
        return $this->Prenom;
    }


    public function setPrenom($Prenom)
    {
        $this->Prenom = $Prenom;

        return $this;
    }
    
    public function getAge()
    {
        return $this->Age;
    }


    public function setAge($Age)
    {
        $this->Age = $Age;

        return $this;
    }

    public function getnumTel()
    {
        return $this->numTel;
    }

    public function setnumTel($numTel)
    {
        $this->numTel = $numTel;

        return $this;
    }
    
    public function getEmail()
    {
        return $this->Email;
    }

   
    public function setEmail($Email)
    {
        $this->Email = $Email;

        return $this;
    }
    public function getnbvoyages()
    {
        return $this->nbvoyages;
    }
    public function setnbvoyages($nbvoyages)
    {
        $this->nbvoyages = $nbvoyages;

        return $this;
    }
    public function getID_pays()
    {
        return $this->ID_pays;
    }


   

}
