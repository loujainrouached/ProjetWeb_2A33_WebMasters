<?php

class Reservation {
    private $id;
    private $id_voyage;
    private $date_reservation;
    private $nombre_personnes;
    private $numero_personne;
    private $id_user;


    public function __construct($id,$id_voyage, $date_reservation, $nombre_personnes, $numero_personne, $id_user)
    {
        $this->id = $id;
        $this->id_voyage = $id_voyage;
        $this->date_reservation = $date_reservation;
        $this->nombre_personnes = $nombre_personnes;
        $this->numero_personne = $numero_personne;
        $this->id_user = $id_user;
        
    }

    public function getid_user()
    {
    return $this->id_user;
    }
    public function setid_user($id_user)
    {
        $this->id_user = $id_user;
    }

       // Getter et Setter pour $id
       public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    // Getter et Setter pour $id_voyage
    public function getIdVoyage() {
        return $this->id_voyage;
    }

    public function setIdVoyage($id_voyage) {
        $this->id_voyage = $id_voyage;
    }

    // Getter et Setter pour $date_reservation
    public function getDateReservation() {
        return $this->date_reservation;
    }

    public function setDateReservation($date_reservation) {
        $this->date_reservation = $date_reservation;
    }

    // Getter et Setter pour $nombre_personnes
    public function getNombrePersonnes() {
        return $this->nombre_personnes;
    }

    public function setNombrePersonnes($nombre_personnes) {
        $this->nombre_personnes = $nombre_personnes;
    }

    // Getter et Setter pour $numero_personne
    public function getNumeroPersonne() {
        return $this->numero_personne;
    }

    public function setNumeroPersonne($numero_personne) {
        $this->numero_personne = $numero_personne;
    }
}


?>