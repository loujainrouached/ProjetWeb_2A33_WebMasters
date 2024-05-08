<?php
include '../controller/GuideC.php';
$guide = new functions();
$guide->deleteGuide($_GET["ID_guide"]);
header('Location:typography.php');
