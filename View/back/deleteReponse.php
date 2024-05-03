<?php
require_once __DIR__. '/../../Controller/ReponsesC.php';
$ReponsesC = new ReponsesC();
$ReponsesC->deleteReponses($_GET["id_reponse"]);
header('Location:form.php');
?>
