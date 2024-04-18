<?php
require '../config.php';
class UserC
{
    public function updateUser($user, $id)
{
    try {
    $db = config::getConnexion();
    $query = $db->prepare('UPDATE table_users SET 
                nom_user = :nom_user, 
                prenom_user = :prenom_user, 
                email_user = :email_user, 
                mdp = :mdp, 
                confirm_mdp = :confirm_mdp, 
                photo_user = :photo_user
            WHERE id_user = :id_user');

        $query->execute([
            'id_user' => $id,
            'nom_user' => $user->getnom_user(),
            'prenom_user' => $user->getprenom_user(),
            'email_user' => $user->getemail_user(),
            'mdp' => $user->getmdp(),
            'confirm_mdp' => $user->getconfirm_mdp(),
            'photo_user' => $user->getphoto_user()
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    }
     catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}



    
public function showUser($id)
{
    $sql = "SELECT * from table_users where id_user = :id_user";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindValue(':id_user', $id);
        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC); // Utiliser FETCH_ASSOC pour un tableau associatif
        return $user; // Retourner directement l'utilisateur trouvé
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}












    public function userExists($email)
    {
        $db = config::getConnexion();
        
        $sql = "SELECT COUNT(*) as count FROM table_users WHERE email_user = :email_user";
        $query = $db->prepare($sql);
        $query->bindValue(':email_user', $email);
        
        try {
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            
            // Si le compte est supérieur à zéro, cela signifie que l'utilisateur existe
            return $result['count'] > 0;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
    

public function listeEmploye()
{
$sql = "SELECT * FROM table_users";
$db = config::getConnexion();
try{
    $query =$db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC); 
    return $result;

}catch(Exception $e){
    die('Error: ' . $e->getMessage());
}
} 








/*public function addEmploye($user)
{
    $sql = "INSERT INTO table_users (nom_user, prenom_user, email_user, mdp, confirm_mdp, photo_user) VALUES (:nom_user, :prenom_user, :email_user, :mdp, :confirm_mdp, :photo_user)";
    $db = config::getConnexion();
    
    try {
        $query = $db->prepare($sql);
        
        $query->bindValue(':nom_user', $user->getnom_user());
        $query->bindValue(':prenom_user', $user->getprenom_user());
        $query->bindValue(':email_user', $user->getemail_user());
        $query->bindValue(':mdp', $user->getmdp());
        $query->bindValue(':confirm_mdp', $user->getconfirm_mdp());
        $query->bindValue(':photo_user', $user->getphoto_user());
        
        $query->execute();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}*/
public function addEmploye($user)
{
    $db = config::getConnexion();
    
    // Vérification des champs obligatoires
    if (empty($user->getnom_user()) || empty($user->getprenom_user()) || empty($user->getemail_user()) || empty($user->getmdp()) || empty($user->getconfirm_mdp())) {
        echo "Error: Tous les champs obligatoires doivent être remplis.";
        return; // Arrêter l'exécution de la fonction
    }
    
    // Vérification du mot de passe
    if ($user->getmdp() !== $user->getconfirm_mdp()) {
        echo "Error: Le mot de passe et la confirmation du mot de passe ne correspondent pas.";
        return; // Arrêter l'exécution de la fonction
    }
    
    // Vérification de l'unicité de l'adresse e-mail
    $existingUser = $db->prepare("SELECT COUNT(*) as count FROM table_users WHERE email_user = :email_user");
    $existingUser->bindValue(':email_user', $user->getemail_user());
    $existingUser->execute();
    $result = $existingUser->fetch(PDO::FETCH_ASSOC);
    
    if ($result['count'] > 0) {
        echo "Error: Cette adresse e-mail est déjà utilisée.";
        return; // Arrêter l'exécution de la fonction
    }
    
   
    // Insertion de l'utilisateur dans la base de données
    $sql = "INSERT INTO table_users (nom_user, prenom_user, email_user, mdp, confirm_mdp, photo_user) VALUES (:nom_user, :prenom_user, :email_user, :mdp, :confirm_mdp, :photo_user)";
    
    try {
        $query = $db->prepare($sql);
        
        $query->bindValue(':nom_user', $user->getnom_user());
        $query->bindValue(':prenom_user', $user->getprenom_user());
        $query->bindValue(':email_user', $user->getemail_user());
        $query->bindValue(':mdp', $user->getmdp());
        $query->bindValue(':confirm_mdp', $user->getconfirm_mdp());
        $query->bindValue(':photo_user', $user->getphoto_user()); // Stockage du contenu binaire de l'image
        
        $query->execute();
        echo "L'utilisateur a été ajouté avec succès.";
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


function deleteuser($ide)
{
    $sql = "DELETE FROM table_users WHERE id_user = :id_user";
    $db = config::getConnexion();
    $req = $db->prepare($sql);
    $req->bindValue(':id_user', $ide);

    try {
        $req->execute();
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}


}
