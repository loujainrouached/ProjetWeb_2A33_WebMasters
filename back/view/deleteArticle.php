<?php
require_once __DIR__ . '/../Controller/articleC.php';
$articleC = new articleC();
$articleC->delete_article($_GET['id_article']);
header('Location:listeArticles.php');
?>
