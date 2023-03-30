<?php   
    require("mailfunction.php");

    $name = $_POST["name"];
    $phone = $_POST['phone'];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $html = file_get_contents('email.html');
    $html = str_replace('{{no_name}}', $name, $html);
    $html = str_replace('{{no_phone}}', $phone, $html);
    $html = str_replace('{{no_email}}', $email, $html);
    $html = str_replace('{{no_message}}', $message, $html);
    $status = mailfunction($html); //reciever

    if($status)
        echo '<center><h1>Thanks! We will contact you soon.</h1></center>';
    else
        echo '<center><h1>Error sending message! Please try again.</h1></center>';    
?>