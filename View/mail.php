<?php
include '../Controller/GuideC.php';
include '../view/index1.html';

include '../config.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:\xampp\htdocs\webmasters\view\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\webmasters\view\PHPMailer\src\SMTP.php';
require 'C:\xampp\htdocs\webmasters\view\PHPMailer\src\Exception.php';

if (isset($_POST["mail"])) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ademmarghli@gmail.com';
    $mail->Password = 'olpa ebss qxzq rmcj';
    //$mail->SMTPSecure = 'tls';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    $mail->setFrom('ademmarghli@gmail.com');
  //$mail->addAddress('');
  $email_p = ($_POST['mail']);
  $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "mission ";
    $mail->Body = 'bonjour Mr/Mme plus informations ve vous etre envoyés a propos votre prochain voyage et mission ,<br><br>' . $_POST["nom"] .'<br>Cordialement,<br>L\'équipe de VieXplore';
    
    // Send the email
    $mail->send();
}
?>