<?php
include '../Controller/EmployeC.php';
$userC = new UserC();
 session_start();
// Initialisation du message
$message = '';
$id_user = $_SESSION['id_user']; 
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    if (empty($_POST["mdp"]) && empty($_POST["confirm_mdp"])) {
        $message = "champ manquant";
    } else if ($_POST["mdp"] !== $_POST["confirm_mdp"]) {
        $message = "Les mots de passe ne correspondent pas.";
    } 
    else {
        // Créer un objet utilisateur avec les nouveaux mots de passe
        $user = new UserC();
       $pwd=$_POST['mdp'];
      $pwd1=$_POST['confirm_mdp'];
      $hashed_password = password_hash($pwd,PASSWORD_DEFAULT);
      $hashed_password1 = password_hash($pwd1,PASSWORD_DEFAULT);
        $userC->updateMdp($hashed_password, $hashed_password1, $id_user);
        // Affichage d'un message de succès ou d'erreur
        $message = "Mot de passe mis à jour avec succès.";
        header("Location: Connexion.php");
    }


    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
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
body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 500px;
            margin: 100px auto;
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
        .navbar {
            background-color: #15395A;
        }

        .orange-text {
            color: orange;
            text-align: center;
        }
        .text {
          
            text-align: center;
        }
    </style>

</head>
<body>
<!-- Barre de navigation en haut -->
<nav class="navbar navbar-expand-lg navbar-dark">
   
</nav>
<br>

<div class="text-center">
<img src="tayara.png"  class="text" alt="Votre logo" class="img-fluid" style="max-width: 200px;">
<h1 class="orange-text">Bienvenue à VieExplore</h1>
<h4 class="text">Explorez le monde avec nous !</h4>

    </div>
<div class="container" >
    <h2>Mise a jour de Mot de Passe  :</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="mb-3">
            <label for="mdp">Nouveau Mot de Passe:</label>
            <input type="password" id="mdp" name="mdp" placeholder="entrer Le nouveau mot de passe">
            <label for="confirm_mdp">confirm Mot de Passe:</label>
            <input type="password" id="confirm_mdp" name="confirm_mdp" placeholder="verifier Le nouveau mot de passe">
        </div>
        <button type="submit">Modifier</button>
    </form>
    <?php if (!empty($message)) : ?>
        <!-- Affichage du message -->
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
</div>
<!-- Barre de navigation en bas -->
<nav class="navbar fixed-bottom navbar-expand-lg navbar-dark">
   
</nav>

</body>
</html>
