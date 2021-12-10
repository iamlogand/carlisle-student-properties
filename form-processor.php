<?php
    if (!empty($_POST)) {

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $name = test_input($_POST['name']);
        $visitor_email = test_input($_POST['email']);
        $phone = test_input($_POST['phone']);
        $properties = test_input($_POST['properties']);
        $group = test_input($_POST['group']);
        $message = test_input($_POST['message']);

        $token = $_POST['g-recaptcha-response'];
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfV6pIdAAAAAIyFiEx9peDk0KlvpXjs1I8HV9cE&response={$token}");
        $result = json_decode($response);
        $score = $result->score;

        $email_from = 'website@carlislestudentproperties.co.uk';
        $email_subject = "Online Viewing Request";
        $email_body = "Name: $name\n".
            "Email: $visitor_email\n".
            "Phone: $phone\n".
            "Number of properties: $properties\n".
            "Group size: $group\n".
            "Message:\n$message\n\n".
            "CAPTCHA Report\nScore: $score\n".
            "1.0 is very likely a good interaction, 0.0 is very likely a bot.\n".
            "Scores below 0.5 are automatically rejected.\n";

//         If name is 'ADMIN' or score is low, send request email to dev/testing address, otherwise, send to both
        if ($name == 'ADMIN' || $score < 0.5) {
            $to = "carlislestudentproperties@gmail.com";
        } else {
            $to = "carlislestudentproperties@aol.co.uk, carlislestudentproperties@gmail.com";
        };

        $headers = "From: $email_from \r\n";
        $headers .= "Reply-To: $visitor_email \r\n";
        mail($to,$email_subject,$email_body,$headers);
        echo '<script type="text/javascript">',
            'location.href = "index.html";',
            '</script>'
        ;

    }
?>