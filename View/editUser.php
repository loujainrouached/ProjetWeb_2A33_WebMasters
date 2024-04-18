<?php
include '../Controller/EmployeC.php';
include '../Model/Employe.php';

$error = "";

// Créer une instance du contrôleur
$UserC = new UserC();

if (
    isset($_POST["nom_user"]) &&
    isset($_POST["prenom_user"]) &&
    isset($_POST["email_user"]) &&
    isset($_POST["mdp"]) &&
    isset($_POST["confirm_mdp"]) &&
    isset($_POST["photo_user"]) &&
    isset($_POST['id_user'])
) {
    if (
        !empty($_POST["nom_user"]) &&
        !empty($_POST["prenom_user"]) &&
        !empty($_POST["email_user"]) &&
        !empty($_POST["mdp"]) &&
        !empty($_POST["confirm_mdp"]) &&
        !empty($_POST["photo_user"])
    ) {
        $user = new User(
            null,  // Assurez-vous que la structure de votre objet User correspond à ce constructeur
            $_POST['nom_user'],
            $_POST['prenom_user'],
            $_POST['email_user'],
            $_POST['mdp'],           // Considérer le hashage du mot de passe avant de l'enregistrer
            $_POST['confirm_mdp'],
            'default_value',
            $_POST['photo_user']
        );

        $UserC->updateUser($user, $_POST['id_user']);  // Utilisez $UserC au lieu de $User pour appeler updateUser
        header('Location:ListEmployes.php');  // Assurez-vous que le nom du fichier est correct
    } else {
        $error = "Missing information";
    }
}

// Gestion de l'affichage des données de l'utilisateur pour la mise à jour
$userData = null;
if (isset($_POST['id_user'])) {
    $userData = $UserC->showUser($_POST['id_user']);  // Récupérer les données de l'utilisateur via UserC
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mise à jour Utilisateur</title>
</head>
<body>
<button><a href="ListEmployes.php">Retour à la liste</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php if ($userData): ?>
    <form action="" method="POST">
        <input type="hidden" name="id_user" value="<?php echo $_POST['id_user']; ?>">
        <label for="nom_user">Nom :</label>
        <input type="text" name="nom_user" id="nom_user" value="<?php echo $userData['nom_user']; ?>">
        <br>
        <label for="prenom_user">Prénom :</label>
        <input type="text" name="prenom_user" id="prenom_user" value="<?php echo $userData['prenom_user']; ?>">
        <br>
        <label for="email_user">Email :</label>
        <input type="email" name="email_user" id="email_user" value="<?php echo $userData['email_user']; ?>">
        <br>   
        <label for="mdp">Mot de passe :</label>
        <input type="password" name="mdp" id="mdp">
        <br>        
        <label for="confirm_mdp">Confirmer le mot de passe :</label>
        <input type="password" name="confirm_mdp" id="confirm_mdp">
        <br>               
        <label for="photo_user">Photo de l'utilisateur :</label>
        <input type="file" name="photo_user" id="photo_user">
        <br>       
        <input type="submit" value="Mettre à jour">
    </form>
    <?php endif; ?>
</body>
</html>
