<?php
include '../Controller/EmployeC.php';
$UserC = new UserC();
$UserC -> deleteuser($_GET["id_user"]);
header('Location:listEmployes.php');
