<?php
include "../controller/ReclamationsC.php";

$c = new ReclamationsC();
$tab = $c->listReclamations();
die(json_encode($tab));
    foreach ($tab as $Reclamations) {
        $data['id_client'] = $Reclamations['id_client'];
        $data['date_reclamation'] = $Reclamations['date_reclamation'];
        $data['titre_reclamation'] = $Reclamations['titre_reclamation'];
        $data['contenu'] = $Reclamations['contenu'];
    }
    if (isset($data)) return(json_encode($data));
    else die(json_encode('Error!!'));
?>