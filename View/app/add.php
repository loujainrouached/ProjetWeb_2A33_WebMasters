<?php

if(isset($_POST['title'])){
    // Obtenez le chemin racine de votre projet en utilisant une constante magique
    $root_path = $_SERVER['DOCUMENT_ROOT'];

    // Inclure le fichier config en utilisant le chemin absolu
    require_once $root_path . "/Module_Reservation1/config.php";

    $title = $_POST['title'];

    if(empty($title)){
        header("Location: ../voyage_back.php?mess=error");
        exit(); // Arrêter l'exécution du script après la redirection
    } else {
        // Utiliser la connexion obtenue depuis config.php
        $conn = config::getConnexion();

        $stmt = $conn->prepare("INSERT INTO todos(title) VALUE(?)");
        $res = $stmt->execute([$title]);

        if($res){
            header("Location: ../reservation_back.php?mess=success"); 
            exit(); // Arrêter l'exécution du script après la redirection
        } else {
            header("Location: ../reservation_back.php");
            exit(); // Arrêter l'exécution du script après la redirection
        }
    }
} else {
    header("Location: ../reservation_back.php?mess=error");
    exit(); // Arrêter l'exécution du script après la redirection
}
?>
