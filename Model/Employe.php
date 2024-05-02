<?php

class User
{
    private  $id_user;
    private  $nom_user;
    private  $prenom_user;
    private  $email_user;
    private  $mdp;
    private  $confirm_mdp;
    private  $nature_user;
    private  $photo_user;


    public function  __construct ($id_user, $nom_user , $prenom_user ,  $email_user , $mdp , $confirm_mdp , $nature_user , $photo_user)
{
    $this->id_user = $id_user ;
    $this->nom_user = $nom_user ;
    $this->prenom_user = $prenom_user ;
    $this->email_user = $email_user ;
    $this->mdp = $mdp ;
    $this->confirm_mdp = $confirm_mdp ;
    $this->nature_user = $nature_user ;
    $this->photo_user = $photo_user ;
}


public function getid_user()
{
return $this->id_user;
}
public function setid_user($id_user)
{
    $this->id_user = $id_user;
}




public function getnom_user()
{
return $this->nom_user;
}
public function setnom_user($nom_user)
{
    $this->nom_user = $nom_user;
}


public function getprenom_user()
{
    return $this->prenom_user;
}
public function setprenom_user($prenom_user)
{
    $this->prenom_user = $prenom_user;
}


public function getemail_user()
{
    return $this->email_user;
}
public function setemail_user($email_user)
{
    $this->email_user = $email_user;
}


public function getmdp()
{
    return $this->mdp;
}
public function setmdp($mdp)
{
    $this->mdp = $mdp;
}

public function getconfirm_mdp()
{
    return $this->confirm_mdp;
}
public function setconfirm_mdp($confirm_mdp)
{
    $this->confirm_mdp = $confirm_mdp;
}

public function getnature_user()
{
    return $this->nature_user;
}
public function setnature_user($nature_user)
{
    $this->nature_user = $nature_user;
}

public function getphoto_user()
{
    return $this->photo_user;
}
public function setphoto_user($photo_user)
{
    $this->photo_user = $photo_user;
}

}