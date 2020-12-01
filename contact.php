<?php

 
// EDIT THE 2 LINES BELOW AS REQUIRED
$email_to = "contact@melissadacosta.fr";
$email_subject = "Le formulaire d'envoi";

$errors = [];


if(isset($_POST['email']) && $_POST['email'] !== '')
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
else $errors[] = 'error_email';
    
if(isset($_POST['name']) && $_POST['name'] !== '')
    $name = filter_input(INPUT_POST, 'name');
else $errors[] = 'error_name';

if(isset($_POST['message']) && $_POST['message'] !== '') 
    $message = filter_input(INPUT_POST, 'message');
else $errors[] = 'error_message';

if (count($errors) >0){
    foreach ($errors as $value){
        if($value == 'error_email')
            echo 'L\'adresse mail n\'est pas valide. ';
        if($value == 'error_name')
            echo 'Le nom n\'est pas valide. ';
        if($value == 'error_message')
            echo 'Le message n\'est pas valide. ';
    }
} else {
    $email_message = "Détail.\n\n";
    $email_message .= "Nom: ".$name."\n";
    $email_message .= "Message: ".$message."\n";
    $email_message .= "Email: ".$email."\n";
 
    // create email headers
    $headers = 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    // mail($email_to, $email_subject, $email_message, $headers);
    

    if(!@mail($email_to, $email_subject, $email_message, $headers)) { 
        echo ' Le mail ne peut pas partir '; 
    } else {
        echo 'Votre message à été envoyé, je vous contacterai très bientôt';
    }
}