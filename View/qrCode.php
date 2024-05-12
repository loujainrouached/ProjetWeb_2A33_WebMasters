<?php

include './phpqrcode/qrlib.php';



if (isset($_POST['id_voyage'], $_POST['date_reservation'], $_POST['nombre_personnes'], $_POST['numero_personne'])) {
    // Purify the data
    $id_voyage = htmlspecialchars(trim($_POST['id_voyage']));
    $date_reservation = htmlspecialchars(trim($_POST['date_reservation']));
    $nombre_personnes = htmlspecialchars(trim($_POST['nombre_personnes']));
    $numero_personne = htmlspecialchars(trim($_POST['numero_personne']));

    // Format data with labels
    $data = "ID Voyage: $id_voyage\n";
    $data .= "Date de réservation: $date_reservation\n";
    $data .= "Nombre de personnes: $nombre_personnes\n";
    $data .= "Numéro de personne: $numero_personne";

    // Filename
    $filename = $id_voyage . '_' . $date_reservation . '.png';

    if (!file_exists($filename)) {
        // Generate QR code
        QRcode::png($data, $filename);
        $success = "Fichier généré💪🎉✨⭐🎊🏆 ";
    } else {
        $errors = "Fichier déjà généré ! ❌ ";
    }
}
?>
