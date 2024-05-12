<?php

if(isset($_POST['id'])){
    $root_path = $_SERVER['DOCUMENT_ROOT'];

    // Inclure le fichier config en utilisant le chemin absolu
    require_once $root_path . "/Module_Reservation1/config.php";

    $id = $_POST['id'];

    if(empty($id)){
       echo 'error';
    }else {
        $todos = $conn->prepare("SELECT id, checked FROM todos WHERE id=?");
        $todos->execute([$id]);

        $todo = $todos->fetch();
        $uId = $todo['id'];
        $checked = $todo['checked'];

        $uChecked = $checked ? 0 : 1;

        $res = $conn->query("UPDATE todos SET checked=$uChecked WHERE id=$uId");

        if($res){
            echo $checked;
        }else {
            echo "error";
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../voyage_back.php?mess=error");
}