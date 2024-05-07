<?php
include '../controller/PaysC.php';
$pays = new functions();
$pays->deletePays($_GET["ID_pays"]);
header('Location:listPays.php');