
    


<?php
require '../config.php';
class UserC
{
    public function getByEmail($email_user) {
      //  $pdo = new PDO('mysql:host=localhost;dbname=votre_base_de_donnees', 'votre_nom_utilisateur', 'votre_mot_de_passe');

        $stmt = $pdo->prepare('SELECT * FROM table_users WHERE email_user = :email_user');
        $stmt->execute(['email_user' => $email_user]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user; // Retourne l'utilisateur trouvé ou null s'il n'existe pas
    }
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
                nature_user = :nature_user, 
                photo_user = :photo_user
            WHERE id_user = :id_user');

        $query->execute([
            'id_user' => $id,
            'nom_user' => $user->getnom_user(),
            'prenom_user' => $user->getprenom_user(),
            'email_user' => $user->getemail_user(),
            'mdp' => $user->getmdp(),
            'confirm_mdp' => $user->getconfirm_mdp(),
            'nature_user' => $user->getnature_user(),
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

public function generateRandomCode($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, $max)];
    }
    return $code;
}


public function loginUser1($email)
{
    $sql = "SELECT * FROM table_users WHERE  email_user = :email_user";
    $db = config::getConnexion();
    
    try {
        $query = $db->prepare($sql);
        $query->execute(['email_user' => $email]);
        $user = $query->fetch();

        // Check if user exists and password matches
        if ($user ) {
            // Vérification du type d'utilisateur après une connexion réussie
         
            // Retourner true si la connexion est réussie
            return true;
        } else {
            // Retourner false si la connexion a échoué
            return false;
        }
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}
public function loginUser($email, $mdp)
{
    $sql = "SELECT * FROM table_users WHERE  email_user = :email_user";
    $db = config::getConnexion();
    
    try {
        $query = $db->prepare($sql);
        $query->execute(['email_user' => $email]);
        $user = $query->fetch();

        // Check if user exists and password matches
        if ($user && password_verify($mdp, $user['mdp'])) {
            // Démarrer la session
            session_start();
            
            // Stocker les informations de l'utilisateur dans la session
          $_SESSION['id_user'] = $user['id_user']; 
         $_SESSION['nature_user'] = $user['nature_user']; 
         if ($_SESSION['nature_user'] === 'Admin') {
         header("Location: ListEmployes.php");
           exit(); 
         } else if ($_SESSION['nature_user'] === 'Client') {
          header("Location: front.php");
           exit(); 
         }
        } else {
            // Retourner false si la connexion a échoué
            return false;
        }
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}
/*public function loginUser($email, $mdp)
{
    $sql = "SELECT * FROM table_users WHERE email_user = :email_user";
    $db = config::getConnexion();
    
    try {
        $query = $db->prepare($sql);
        $query->execute(['email_user' => $email]);
        $user = $query->fetch();

        // Check if user exists and password matches
        if ($user && password_verify($mdp, $user['mdp'])) {
            // Démarrer la session
            session_start();
            
            // Stocker les informations de l'utilisateur dans la session
            $_SESSION['id_user'] = $user['id_user'];
              // Afficher l'ID de l'utilisateur connecté
              echo "L'ID de l'utilisateur connecté est : " . $_SESSION['id_user'];
            // Redirection en fonction du type d'utilisateur
           if ($user['nature_user'] == 'admin') {
                // Si l'utilisateur est un administrateur, redirige vers back.php
                header("Location: ListEmployes.php");
            } else {
                // Sinon, redirige vers front.php
                header("Location: login.php");
            }
            exit(); // Assure que le script s'arrête après la redirection
        } else {
            // Retourner false si la connexion a échoué
            return false;
        }
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}*/



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

public function afficherParEmail($email)
{
    $sql = "SELECT * FROM table_users WHERE email_user = :email";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC); 
        return $result;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

public function afficherParAdmin()
{
    $sql = "SELECT * FROM table_users WHERE nature_user = 'Admin'";
    $db = config::getConnexion();
    try {
        $query = $db->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC); 
        return $result;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
public function afficherParClient()
{
    $sql = "SELECT * FROM table_users WHERE nature_user = 'client'";
    $db = config::getConnexion();
    try {
        $query = $db->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC); 
        return $result;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

/*public function addEmploye($user)
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
}*/

public function addEmploye($user)
{
    $db = config::getConnexion();
     // Vérification des champs obligatoires
    if (empty($user->getnom_user()) || empty($user->getprenom_user()) || empty($user->getemail_user()) || empty($user->getmdp()) || empty($user->getconfirm_mdp())) {
        echo "<div class='error-message'>Error: Tous les champs obligatoires doivent être remplis.</div>";
        return; // Arrêter l'exécution de la fonction
    }
    
 // Vérification du mot de passe
 /* if ($user->getmdp() !== $user->getconfirm_mdp()) {
    echo "Error: Le mot de passe et la confirmation du mot de passe ne correspondent pas.";
    return; // Arrêter l'exécution de la fonction
}*/

    
    // Vérification de l'unicité de l'adresse e-mail
   $existingUser = $db->prepare("SELECT COUNT(*) as count FROM table_users WHERE email_user = :email_user");
    $existingUser->bindValue(':email_user', $user->getemail_user());
    $existingUser->execute();
    $result = $existingUser->fetch(PDO::FETCH_ASSOC);
    
   if ($result['count'] > 0) {
        echo "Error: Cette adresse e-mail est déjà utilisée.";
        return; // Arrêter l'exécution de la fonction
    }

    $sql = "INSERT INTO table_users (nom_user, prenom_user, email_user, mdp, confirm_mdp, nature_user, photo_user) VALUES (:nom_user, :prenom_user, :email_user, :mdp, :confirm_mdp, :nature_user, :photo_user)";
  
    
    try {
       

        $query = $db->prepare($sql);
        
        $query->bindValue(':nom_user', $user->getnom_user());
        $query->bindValue(':prenom_user', $user->getprenom_user());
        $query->bindValue(':email_user', $user->getemail_user());
        $query->bindValue(':mdp', $user->getmdp());
        $query->bindValue(':confirm_mdp', $user->getconfirm_mdp());
        $query->bindValue(':nature_user', $user->getnature_user());
        $query->bindValue(':photo_user', $user->getphoto_user());
        
        $query->execute();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}





public function addlogin($user)
{
 
    $db = config::getConnexion();
    
    // Vérification des champs obligatoires
   if (empty($user->getnom_user()) || empty($user->getprenom_user()) || empty($user->getemail_user()) || empty($user->getmdp()) || empty($user->getconfirm_mdp())) {
        echo " Tous les champs obligatoires doivent être remplis.";
        return; // Arrêter l'exécution de la fonction
    }
    
   // Vérification du mot de passe
   /* if ($user->getmdp() !== $user->getconfirm_mdp()) {
        echo "Error: Le mot de passe et la confirmation du mot de passe ne correspondent pas.";
        return; // Arrêter l'exécution de la fonction
    }*/
    
    // Vérification de l'unicité de l'adresse e-mail
   $existingUser = $db->prepare("SELECT COUNT(*) as count FROM table_users WHERE email_user = :email_user");
    $existingUser->bindValue(':email_user', $user->getemail_user());
    $existingUser->execute();
    $result = $existingUser->fetch(PDO::FETCH_ASSOC);
    
    if ($result['count'] > 0) {
        echo "Error: Cette adresse e-mail est déjà utilisée.";
        return; // Arrêter l'exécution de la fonction
    }

    // Définir la nature de l'utilisateur comme "client"
   $user->setnature_user("client");
   
    // Insertion de l'utilisateur dans la base de données
    $sql = "INSERT INTO table_users (nom_user, prenom_user, email_user, mdp, confirm_mdp, nature_user, photo_user) VALUES (:nom_user, :prenom_user, :email_user, :mdp, :confirm_mdp, :nature_user, :photo_user)";
    
    try {
        $query = $db->prepare($sql);
        
        $query->bindValue(':nom_user', $user->getnom_user());
        $query->bindValue(':prenom_user', $user->getprenom_user());
        $query->bindValue(':email_user', $user->getemail_user());
        $query->bindValue(':mdp', $user->getmdp());
        $query->bindValue(':confirm_mdp', $user->getconfirm_mdp());
        $query->bindValue(':nature_user', $user->getnature_user());
        $query->bindValue(':photo_user', $user->getphoto_user());
        
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
