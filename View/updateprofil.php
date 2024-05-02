<?php
include '../Controller/EmployeC.php';
include '../Model/Employe.php';

session_start(); // Démarrez la session

// Vérifiez si l'utilisateur est connecté en vérifiant s'il y a une session utilisateur
if (!isset($_SESSION['id_user'])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header('Location: login.php'); // Remplacez login.php par la page de connexion réelle
    exit; // Arrêtez l'exécution du script après la redirection
}

// Créez une instance du contrôleur
$UserC = new UserC();

// Récupérez les données de l'utilisateur à partir de la session
$userData = $UserC->showUser($_SESSION['id_user']);

// Vérifiez si les données de l'utilisateur sont récupérées avec succès
if (!$userData) {
    // Redirigez l'utilisateur vers une page d'erreur ou affichez un message d'erreur
    echo "Erreur : Impossible de charger les données de l'utilisateur.";
    exit; // Arrêtez l'exécution du script après l'affichage du message d'erreur
}

// Vérifiez si le formulaire a été soumis pour la mise à jour des données utilisateur
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si toutes les données nécessaires sont présentes dans le formulaire
    if (
        isset($_POST["nom_user"]) &&
        isset($_POST["prenom_user"]) &&
        isset($_POST["email_user"]) &&
        isset($_POST["mdp"]) &&
        isset($_POST["confirm_mdp"]) &&
        isset($_POST["photo_user"]) &&
        isset($_POST['id_user'])
    ) {
        // Vérifiez si les mots de passe correspondent
        if ($_POST["mdp"] == $_POST["confirm_mdp"]) {
            
            // Hasher le mot de passe
            $hashed_password = password_hash($_POST["mdp"], PASSWORD_DEFAULT);

            // Créez un objet utilisateur avec les données mises à jour
            $user = new User(
                null,
                $_POST['nom_user'],
                $_POST['prenom_user'],
                $_POST['email_user'],
                $hashed_password, // Utilisez le mot de passe hashé
                $hashed_password, // Utilisez le mot de passe hashé
                $userData['nature_user'], // Utilisez la nature de l'utilisateur existante
                $_POST['photo_user']
            );

            // Mettez à jour les données de l'utilisateur dans la base de données
            $UserC->updateUser($user, $_POST['id_user']);

            // Redirigez l'utilisateur vers la page de profil après la mise à jour
            header('Location: profil.php');
            exit; // Arrêtez l'exécution du script après la redirection
        } 
        else {
            // Affichez un message d'erreur si les mots de passe ne correspondent pas
            echo "Erreur : Les mots de passe ne correspondent pas.";
        }
    } else {
        // Affichez un message d'erreur si des informations manquent dans le formulaire
        echo "Erreur : Des informations sont manquantes dans le formulaire.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil</title>


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
    </style>

<meta charset="utf-8">


<title>user about me section - Bootdey.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    	body{margin-top:20px;}
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
    padding: 120px 0;
    overflow: hidden;
    background: #fff;
}
.mb-2-3, .my-2-3 {
    margin-bottom: 2.3rem;
}

.section-title {
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 10px;
    position: relative;
    display: inline-block;
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

    </style>
    
</head>
<body>
<body>
    <section class="bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-style1 border-0">
                        <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                            <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                                <h3 class="h2 text-white mb-0">Modifier le Profil :</h3>
                            </div>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <input type="hidden" name="id_user" value="<?php echo $userData['id_user']; ?>">
                                <div class="mb-2-3">
                                    <label for="nom_user" class="form-label">Nom :</label>
                                    <input type="text" name="nom_user" id="nom_user" class="form-control" value="<?php echo $userData['nom_user']; ?>">
                                </div>
                                <div class="mb-2-3">
                                    <label for="prenom_user" class="form-label">Prénom :</label>
                                    <input type="text" name="prenom_user" id="prenom_user" class="form-control" value="<?php echo $userData['prenom_user']; ?>">
                                </div>
                                <div class="mb-2-3">
                                    <label for="email_user" class="form-label">Email :</label>
                                    <input type="email" name="email_user" id="email_user" class="form-control" value="<?php echo $userData['email_user']; ?>">
                                </div>
                                <div class="mb-2-3">
                                    <label for="mdp" class="form-label">Mot de passe :</label>
                                    <input type="password" name="mdp" id="mdp" class="form-control">
                                </div>
                                <div class="mb-2-3">
                                    <label for="confirm_mdp" class="form-label">Confirmer le mot de passe :</label>
                                    <input type="password" name="confirm_mdp" id="confirm_mdp" class="form-control">
                                </div>
                                <div class="mb-2-3">
                                    <label for="photo_user" class="form-label">Photo de l'utilisateur :</label>
                                    <input type="file" name="photo_user" id="photo_user" class="form-control">
                                </div>
                                <div class="mb-2-3">
                                    <label for="nature_user" class="form-label">Nature de l'utilisateur :</label>
                                    <input type="text" name="nature_user" id="nature_user" class="form-control" value="<?php echo $userData['nature_user']; ?>" disabled>
                                </div>
                                <div class="mb-2-3">
                                    <input type="submit" value="Mettre à jour" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</body>
</html>
