<?php
    $name = $_POST['name'];
    $visitor_email = $_POST['email'];
    $phone = $_POST['phone'];
    $properties = $_POST['properties'];
    $group = $_POST['group'];
    $message = $_POST['message'];

    $email_from = 'anyone@email.com';
	$email_subject = "Online Viewing Request";
	$email_body = "Name: $name\n".
	    "Email: $visitor_email\n".
	    "Phone: $phone\n".
	    "Number of properties: $properties\n".
	    "Group size: $group\n".
        "Message:\n$message\n";


    $to = "iamlogandavidson@gmail.com";
    $headers = "From: $email_from \r\n";
    $headers .= "Reply-To: $visitor_email \r\n";
    mail($to,$email_subject,$email_body,$headers);
?>