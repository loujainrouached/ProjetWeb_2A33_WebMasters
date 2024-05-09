<?php
// notifications-data.php
require_once "./config.php";
require_once "./ReclamationsC.php";

$reclamationsC = new ReclamationsC();
$unreadClaims = $reclamationsC->listeReclamationsNonLues(); // Assuming this method exists and fetches unread claims

header('Content-Type: application/json');
echo json_encode([
    'notifications' => array_map(function ($claim) {
        return [
            'titre' => htmlspecialchars($claim['titre_reclamation'], ENT_QUOTES, 'UTF-8'),
            'date' => $claim['date_reclamation'] // Assuming 'date_reclamation' is a column in your db
        ];
    }, $unreadClaims)
]);
?>