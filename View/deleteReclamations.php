<?php
include '../Controller/ReclamationsC.php';
$ReclamationsC = new ReclamationsC();
$ReclamationsC->deleteReclamations($_GET["id_reclamation"]);
header('Location:listReclamations.php');
?>
