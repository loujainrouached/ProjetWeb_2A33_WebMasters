

<!DOCTYPE html>
<html lang="en">
<head>
   
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
    box-shadow: 0px 0px 50px 0px rgb(89 75 128 / 9%);
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

.blue-icon {
    color: #274472;
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
    <div class="slideDown">
    



<section class="bg-light">
<div class="container">
<div class="row">
<div class="col-lg-12 mb-4 mb-sm-5">
<div class="card card-style1 border-0">
<div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
<div class="row align-items-center">

<div class="col-lg-6 px-xl-10">
<div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
<h3 class="h2 text-white mb-0">Profil actuel :</h3>
</div>
<ul class="list-unstyled mb-1-9">

  
<?php
include "../Controller/EmployeC.php";

// Vérifiez si une action de suppression a été déclenchée via GET
if (isset($_GET['action']) && $_GET['action'] == 'supp' && isset($_GET['id_user'])) {
    // Créez une instance de la classe UserC
    $user1 = new UserC();

    // Appelez la fonction de suppression deleteuser() avec l'ID de l'utilisateur à supprimer
    $user1->deleteuser($_GET['id_user']);

    // Redirection vers la page de connexion après la suppression
    header("Location: connexion.php");
    exit;
}

// profil.php

// Démarrer la session pour accéder aux données de l'utilisateur
session_start();

// Vérifier si l'utilisateur est connecté en vérifiant si l'ID de l'utilisateur est présent dans la session
if(isset($_SESSION['id_user'])) {
    // Connexion à la base de données
    $db = config::getConnexion();

    // Récupérer les informations de l'utilisateur à partir de la base de données en utilisant l'ID stocké dans la session
    $userId = $_SESSION['id_user'];
  //  $nom_user = $_SESSION['nom_user']; 
    $sql = "SELECT * FROM table_users WHERE id_user = :id_user";
    $query = $db->prepare($sql);
    $query->execute(['id_user' => $userId]);
    $user = $query->fetch();

    // Vérifier si des données ont été récupérées avec succès
    if($user !== false) {
        // Afficher les détails de l'utilisateur
    //    echo "<h2>Profil de l'utilisateur</h2>";

      // Afficher les détails de l'utilisateur
//echo "<h2>Profil de l'utilisateur</h2>";

// Afficher la liste des détails de l'utilisateur
echo "<ul class='list-unstyled mb-1-9'>";
echo "<li class='mb-2 mb-xl-3 display-28'><span class='display-26 text-secondary me-2 font-weight-600'>Nom d'utilisateur :</span>" . $user['nom_user'] . "</li>";
echo "<li class='mb-2 mb-xl-3 display-28'><span class='display-26 text-secondary me-2 font-weight-600'>Prénom d'utilisateur :</span>" . $user['prenom_user'] . "</li>";
echo "<li class='mb-2 mb-xl-3 display-28'><span class='display-26 text-secondary me-2 font-weight-600'>Email :</span>"  . $user['email_user'] . "</li>";
echo "<li class='mb-2 mb-xl-3 display-28'><span class='display-26 text-secondary me-2 font-weight-600'>nature de user :</span>"  . $user['nature_user'] . "</li>";
echo "</ul>";

// Afficher le bouton de suppression de compte et de modification des données

echo "<button onclick='deleteUser(" . $user['id_user'] . ")' class='btn-delete'>Supprimer ce compte</button>";
echo "<a href='updateprofil.php?id=" . $user['id_user'] . "'><button class='btn-update'>Modifier vos données</button></a>";
    } else {
        // Afficher un message d'erreur si aucun utilisateur n'a été trouvé
        echo "Aucun utilisateur trouvé.";
    }
} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit;
}
?>

</ul>






<script>
function deleteUser(id_user) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
        window.location.href = "profil.php?action=supp&id_user=" + id_user;
    }
}
</script>

</html>