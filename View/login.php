<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../Controller/EmployeC.php';
    include '../Model/Employe.php';
// Initialisation du message
$message = '';
if (empty($_POST['nom_user']) || empty($_POST['prenom_user']) || empty($_POST['email_user']) || empty($_POST['mdp']) || empty($_POST['confirm_mdp']) || empty($_FILES['photo_user'])) {
    $message = "Tous les champs doivent être remplis.";
} else {
    // Vérifiez si les mots de passe correspondent
    if ($_POST['mdp'] !== $_POST['confirm_mdp']) {
        $message = "Les mots de passe ne correspondent pas.";
    } 
        // Vérifiez si un fichier a été téléchargé
        if (isset($_FILES['photo_user']) && $_FILES['photo_user']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "users/"; // Chemin où enregistrer l'image (assurez-vous que le dossier existe)
            $targetFile = $targetDir . basename($_FILES['photo_user']['name']);
        }
    
            // Déplacez le fichier téléchargé vers le dossier cible
              // Déplacez le fichier téléchargé vers le dossier cible
              if (move_uploaded_file($_FILES['photo_user']['tmp_name'], $targetFile)) {

                $user2 = new UserC();
            
                $pwd=$_POST['mdp'];
                $pwd1=$_POST['confirm_mdp'];
            
                $hashed_password = password_hash($pwd,PASSWORD_DEFAULT);
                $hashed_password1 = password_hash($pwd1,PASSWORD_DEFAULT);
                $user = new User(
                    null,
                    $_POST['nom_user'] ?? null,
                    $_POST['prenom_user'] ?? null,
                    $_POST['email_user'] ?? null,
                    $hashed_password,
                    $hashed_password1,
                    null,
                    $targetFile  // Chemin de l'image
                );
            
    $user2 -> addlogin($user);

}
}
}
?>

<style>
    /* Style pour rendre les icônes cliquables */
    .icon {
        cursor: pointer;
        margin-right: 5px;
    }
      /* CSS pour l'animation de glissement vers le bas */
      @keyframes slideDown {
            from {
                margin-top: -100%;
                opacity: 0;
            }
            to {
                margin-top: 0%;
                opacity: 1;
            }
        }

        /* Appliquer l'animation à la division contenant le contenu */
        .slideDown {
            animation: slideDown 0.5s ease forwards;
        }
</style>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style_css.css"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">    
<title>Formulaire d'inscription</title>
  <style>
         /* CSS pour l'animation de glissement vers le bas */
         @keyframes slideDown {
            from {
                margin-top: -100%;
                opacity: 0;
            }
            to {
                margin-top: 0%;
                opacity: 1;
            }
        }

        /* Appliquer l'animation à la division contenant le contenu */
        .slideDown {
            animation: slideDown 0.5s ease forwards;
        }
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
    label {
    display: inline-block;
    width: 200px; /* Adjust as needed */
    text-align: right;
    padding-right: 12px; /* Add some space between label and input */
  }
  .form-container {
    border: 2px solid #4682B4;
    border-radius: 4px;
    padding: 10px; /* Ajoutez un espacement intérieur pour plus de clarté */
  }
  body{margin-top:3px;}
.card-style1 {
    box-shadow: 0px 0px 10px 0px rgb(89 75 128 / 9%);
}
.border-0 {
    border: 0!important;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 0.25rem;
}

section {
    padding: 70px 0;
    overflow: hidden;
    background: #fff;
}
.mb-2-3, .my-2-3 {
    margin-bottom: 2.3rem;
}


.text-primary {
    color: #ceaa4d !important;
}
.text-secondary {
    color: #15395A !important;
}
.font-weight-600 {
    font-weight: 600;
}
.display-26 {
    font-size: 1.3rem;
}

@media screen and (min-width: 992px){
    .p-lg-7 {
        padding: 4rem;
    }
}
@media screen and (min-width: 768px){
    .p-md-6 {
        padding: 3.5rem;
    }
}
@media screen and (min-width: 576px){
    .p-sm-2-3 {
        padding: 2.3rem;
    }
}
.p-1-9 {
    padding: 1.9rem;
}

.bg-secondary {
    background: #15395A !important;
}
@media screen and (min-width: 576px){
    .pe-sm-6, .px-sm-6 {
        padding-right: 3.5rem;
    }
}
@media screen and (min-width: 576px){
    .ps-sm-6, .px-sm-6 {
        padding-left: 3.5rem;
    }
}
.pe-1-9, .px-1-9 {
    padding-right: 1.9rem;
}
.ps-1-9, .px-1-9 {
    padding-left: 1.9rem;
}
.pb-1-9, .py-1-9 {
    padding-bottom: 1.9rem;
}
.pt-1-9, .py-1-9 {
    padding-top: 1.9rem;
}
.mb-1-9, .my-1-9 {
    margin-bottom: 1.9rem;
}
@media (min-width: 992px){
    .d-lg-inline-block {
        display: inline-block!important;
    }
}
.rounded {
    border-radius: 0.25rem!important;
}
body {
            background-color: #274472;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 500px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        h2 {
            color: #15395A;
            margin-bottom: 30px;
        }
        label {
            color: #15395A;
            font-weight: bold;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        button[type="submit"] {
            background-color: #15395A;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0b2e4d;
        }
        .message {
            color: #dc3545;
            margin-top: 20px;
        }
        .signup-link {
            color: #15395A;
        }
        .orange-text {
            color: orange;
            text-align: center;
        }
        .text {
            color: white;
            text-align: center;
        }
  </style>
</head>

<body>
    <br>
    <br>
<div class="text">
<img src="tayara.png"  class="text" alt="Votre logo" class="img-fluid" style="max-width: 200px;">
<h1 class="orange-text">Bienvenue à VieExplore</h1>
<h4 class="text">Explorez le monde avec nous !</h4>

    </div>
<form action="" method="POST" enctype="multipart/form-data" id="form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="user-photo-container text-center">
                    <img class="user-photo" src="111.jpg" alt="Photo de l'utilisateur">
                </div>
                <input type="file" id="photo_user" name="photo_user" style="display: none;" />
                <label id="imageError" style="color: red;"></label>
                <label id="imageCorrect" style="color: green;"></label>
            </div>
        </div>
        <table class="table text-start align-middle table-bordered table-hover mb-0">
            <tbody>
                <tr>
                    <td><label for="nom_user">Nom :</label></td>
                    <td><input type="text" name="nom_user" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="prenom_user">Prénom :</label></td>
                    <td><input type="text" name="prenom_user" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="email_user">Email :</label></td>
                    <td><input type="email" name="email_user" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="mdp">Mot de passe :</label></td>
                    <td><input type="password" name="mdp" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="confirm_mdp">Confirmer mot de passe :</label></td>
                    <td><input type="password" name="confirm_mdp" class="form-control"></td>
                </tr>
                <tr>
                <?php if (!empty($message)) : ?>
        <!-- Affichage du message -->
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
    </tr>
            </tbody>
        </table>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <br>
                <input type="submit" value="S'inscrire" class="btn btn-primary">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <br>
                <a href="connexion.php" class="btn btn-primary">Connexion</a>
            </div>
        </div>
    </div>
</form>

   

</tbody>
 </table>
 </html>
  <script>
    // Ajouter un écouteur d'événement pour déclencher la sélection de fichier en cliquant sur le cercle
    document.querySelector('.user-photo-container').addEventListener('click', function() {
      document.getElementById('photo_user').click();
    });


    document.getElementById("form").addEventListener("submit", function(e) {
    var hasError = false; 
    // Validation de l'image
    var photo_user = document.getElementById("photo_user");
    var imageError = document.getElementById("imageError");
    var imageCorrect = document.getElementById("imageCorrect");

    imageCorrect.textContent = '';
    imageError.textContent = '';

    var fileName = photo_user.value;
    var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
    if (fileName && (fileExtension === 'jpg' || fileExtension === 'jpeg' || fileExtension === 'png')) {
        imageCorrect.textContent = "Correct.";
    } else {
        imageError.textContent = "Le format de l'image doit être JPEG ou PNG.";
        hasError = true; // Définir hasError à true si la validation échoue
    }   
     // Empêcher la soumission du formulaire si une validation a échoué
     if (hasError) {
        e.preventDefault();
    }
}
    );
  </script>

