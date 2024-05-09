<?php
require_once __DIR__ . '/../../back/Controller/commentaireC.php';
$commentaireC = new commentaireC();
$commentaireC->delete_commentaire($_GET['ID_commentaire']);
header('Location:blog.php');
?>
