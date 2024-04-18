<?php

class Voyage {
  // Private properties with clear descriptions
  private  $id;
  private string $type;
  private string $destination;
  private  $dateDepart;  // Assuming date and time
  private  $dateRetour;  // Assuming date and time
  private $image;
  

  // Constructor with type hinting for parameters
  public function __construct($id, $type, $destination, $dateDepart, $dateRetour,$image) {
    $this->id = $id;
    $this->type = $type;
    $this->destination = $destination;
    $this->dateDepart = $dateDepart;
    $this->dateRetour = $dateRetour;
    $this->image = $image;
 
  }

  // Getter methods with clear names
  public function getId(): int {
    return $this->id;
  }

  public function getType(): string {
    return $this->type;
  }

  public function getDestination(): string {
    return $this->destination;
  }

  public function getDateDepart()  {
    return $this->dateDepart;
  }

  public function getDateRetour() {
    return $this->dateRetour;
  }
  public function getImage() {
    return $this->image;
}


  // Setter methods with clear names (optional)
  // ... (same structure as getters but with "set" prefix)
}
?>
