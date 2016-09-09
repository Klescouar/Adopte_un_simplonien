<?php
session_start();

$destinataire = 'gaereg.ml@gmail.com';
// Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a plusieurs adresses
$expediteur = $_POST['email'];
$copie = $_POST['email'];
$copie_cachee = $_POST['email'];
$objet = "Lentreprise ".$_POST['entreprise']." de la ville de ".$_POST['ville']." vous à contacté";
$headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
$headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
$headers .= 'From: '.$_POST['nom'].'<'.$expediteur.'>'."\n"; // Expediteur
$headers .= 'Delivered-to: '.$destinataire."\n"; // Destinataire
$headers .= 'Cc: '.$copie."\n"; // Copie Cc
$headers .= 'Bcc: '.$copie_cachee."\n\n"; // Copie cachée Bcc
$message = $_POST['message'];
if (mail($destinataire, $objet, $message, $headers)) // Envoi du message
{
    $_SESSION['message'] = 'Message envoyé';
}
else // Non envoyé
{
    $_SESSION['message'] = "Votre message n'a pas pu être envoyé";
}

header('location: ../#/contact')
?>
