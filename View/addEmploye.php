<?php

/*include '../Controller/EmployeC.php';
include '../Model/Employe.php';


$user2 = new UserC();

$user = new User(null, $_POST['nom_user'], $_POST['prenom_user'], $_POST['email_user'], $_POST['mdp'], $_POST['confirm_mdp'], null, $_POST['photo_user'] );
$user2 -> addEmploye($user);
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../Controller/EmployeC.php';
    include '../Model/Employe.php';

        // Vérifiez si un fichier a été téléchargé
        if (isset($_FILES['photo_user']) && $_FILES['photo_user']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "upload/"; // Chemin où enregistrer l'image (assurez-vous que le dossier existe)
            $targetFile = $targetDir . basename($_FILES['photo_user']['name']);
    
            // Déplacez le fichier téléchargé vers le dossier cible
            if (move_uploaded_file($_FILES['photo_user']['tmp_name'], $targetFile)) {

    $user2 = new UserC();

    $user = new User(
        null,
        $_POST['nom_user'] ?? null,
        $_POST['prenom_user'] ?? null,
        $_POST['email_user'] ?? null,
        $_POST['mdp'] ?? null,
        $_POST['confirm_mdp'] ?? null,
        null,
        $targetFile  // Chemin de l'image
    );

    $user2 -> addEmploye($user);

}
}
}



?>
<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <title>Formulaire d'inscription</title>
  <style>
    /* Style du conteneur pour l'image et le cercle */
    .user-photo-container {
      position: relative; /* Permet le positionnement de l'élément cercle */
      display: inline-block; /* Assure un alignement correct dans le formulaire */
      width: 150px; /* Ajuster la largeur selon vos besoins */
      height: 150px; /* Ajuster la hauteur selon vos besoins */
      border-radius: 50%; /* Crée un conteneur circulaire */
      overflow: hidden; /* Cache les parties débordantes de l'image */
      cursor: pointer; /* Affiche un curseur en forme de pointeur pour l'interaction */
    }

    /* Style de l'élément image */
    .user-photo {
      width: 100%; /* Étire l'image pour remplir le conteneur */
      height: 100%; /* Étire l'image pour remplir le conteneur */
      object-fit: cover; /* Garantit que l'image entière est visible, avec un rognage si nécessaire */
    }

    /* Style de l'élément cercle (optionnel) */
    .user-photo-container::after {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border-radius: 50%;
      background-color: rgba(0, 0, 0, 0.2); /* Superposition semi-transparente (optionnelle) */
    }
  </style>
</head>

<body>

  <form action="" method="POST" enctype="multipart/form-data">

 
    <div class="user-photo-container">
      <img  class="user-photo" src="111.jpg" alt="Photo de l'utilisateur">
    </div>
    <input type="file" id="photo_user" name="photo_user" style="display: none;" />
    <br>
    <label align="center" for="photo_user">Photo de l'utilisateur</label>
    <br> <br>
    <label for="nom_user">Nom :</label>
    <input type="text" name="nom_user">
    <br>
    <br>
    <label for="prenom_user">Prénom :</label>
    <input type="text" name="prenom_user">
    <br>
    <br>
    <label for="email_user">Email :</label>
    <input type="email" name="email_user">
    <br>
    <br>
    <label for="mdp">Mot de passe :</label>
    <input type="password" name="mdp">
    <br>
    <br>
    <label for="confirm_mdp">Confirmer mot de passe :</label>
    <input type="password" name="confirm_mdp">
    <br>
 <br>

    <input type="submit" value="S'inscrire">

  </form>

  <script>
    // Ajouter un écouteur d'événement pour déclencher la sélection de fichier en cliquant sur le cercle
    document.querySelector('.user-photo-container').addEventListener('click', function() {
      document.getElementById('photo_user').click();
    });
  </script>
</body>

</html>
