<?php
    $name = test_input($_POST['name']);
    $visitor_email = test_input($_POST['email']);
    $phone = test_input($_POST['phone']);
    $properties = test_input($_POST['properties']);
    $group = test_input($_POST['group']);
    $message = test_input($_POST['message']);

    $email_from = 'website@carlislestudentproperties.co.uk';
	$email_subject = "Online Viewing Request";
	$email_body = "Name: $name\n".
	    "Email: $visitor_email\n".
	    "Phone: $phone\n".
	    "Number of properties: $properties\n".
	    "Group size: $group\n".
        "Message:\n$message\n";

// Send email to carlislestudentproperties@aol.co.uk
    $to = "carlislestudentproperties@aol.co.uk, carlislestudentproperties@gmail.com";
    $headers = "From: $email_from \r\n";
    $headers .= "Reply-To: $visitor_email \r\n";
    mail($to,$email_subject,$email_body,$headers);
    echo '<script type="text/javascript">',
        'location.href = "index.html";',
        '</script>'
    ;

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>