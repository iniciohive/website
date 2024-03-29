<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__ . '/../vendor/autoload.php';
require 'mailingvariables.php';

function mailfunction( $mail_msg, $attachment = false ) {

    $mail = new PHPMailer();
    $mail->isSMTP();

    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    $mail->Host = $GLOBALS[ 'mail_host' ];

    $mail->Port = $GLOBALS[ 'mail_port' ];

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->SMTPAuth = true;

    $mail->Username = $GLOBALS[ 'mail_sender_email' ];

    $mail->Password = $GLOBALS[ 'mail_sender_password' ];

    $mail->setFrom( $GLOBALS[ 'mail_sender_email' ], $GLOBALS[ 'mail_sender_name' ] );

    $mail->addAddress( $GLOBALS[ 'mail_reciever_email' ], $GLOBALS[ 'mail_reciever_name' ] );
    foreach ( $GLOBALS[ 'myArrayemails' ] as $ccRecipient ) {
        $mail->addCC( $ccRecipient );
    }

    $mail->Subject = 'Someone Contacted You!';

    $mail->isHTML( $isHtml = true );

    $mail->msgHTML( $mail_msg );

    if ( $attachment !== false ) {
        $mail->AddAttachment( $attachment );
    }

    $mail->AltBody = 'This is a plain-text message body';

    if ( !$mail->send() ) {
        return false;
    } else {
        return true;
    }
}

function checkrecaptcha( $response ) {
    if ( $response == '' ) {
        return false;
    }
    $secretKey = $GLOBALS[ 'secret_key' ];
    $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $response;
    $responseData = file_get_contents( $verifyUrl );
    $responseObject = json_decode( $responseData );
    return $responseObject->success ? true : false;
}

?>