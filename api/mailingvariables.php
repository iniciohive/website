<?php
    $mail_host = "smtp.gmail.com";
    $mail_port = "587";
    $emails = getenv('Emails');
    $myArrayemails = json_decode($emails, true);
    $mail_sender_email = getenv('sender_mail'); //sender
    $mail_sender_password = getenv('sender_pass'); //sender
    $mail_sender_name = "Website Form";
?>