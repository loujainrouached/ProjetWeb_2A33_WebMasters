<?php
require '../config.php';
class ConnexionC
{

    public function authenticate($email, $password) {
        // Accéder à la base de données pour récupérer l'utilisateur par email
        $user = $this->getemail_user($email);
        
        // Vérifier si l'utilisateur existe et si le mot de passe correspond
        return ($user && password_verify($password, $user['password']));
    }
                                                        
}
