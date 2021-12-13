<?php

    // Function that cleans input to prevent XSS
    function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

    $score = null;

    // Check if form data is received
    if (!empty($_POST)) { // Form data received

        // Check if form data contains token
        $token = $_POST['g-recaptcha-response'];
        if (!empty($token)) { // Token received

            // Check for token
            $token = $_POST['g-recaptcha-response'];
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfV6pIdAAAAAIyFiEx9peDk0KlvpXjs1I8HV9cE&response={$token}");
            $result = json_decode($response);

            // Check if token is valid
            if ($result->success) { // Token is valid

                // Find score
                $score = (isset($result->score)) ? $result->score : false;

                // Check if score is high enough
                if ($score >= 0.5) { // Score is 0.5 or over - likely to be genuine
                    $genuine_request = true;

                } else { // Score is below 0.5 - not likely to be genuine
                    $genuine_request = false;
                    $report = "CAPTCHA score is below 0.5.";
                }

            } else { // Token is invalid
                $genuine_request = false;
                $report = "CAPTCHA token is invalid.";
            }

        } else { // Token not received
            $genuine_request = false;
            $report = "No CAPTCHA token.";
        }

    } else { // Form data not received
        $genuine_request = false;
        $report = "No form data.";
    }

    // Generate email content
    if ($genuine_request) { // Viewing request is genuine
        $to = "carlislestudentproperties@aol.co.uk, carlislestudentproperties@gmail.com";
        $email_subject = "Website Viewing Request";
        $email_body = null;

    } else { // Viewing request is unlikely to be genuine
        $to = "carlislestudentproperties@gmail.com";
        $email_subject = "CSP Non-Genuine Viewing Request";
        $email_body = "Report: $report\n\nForm content (if any):\n\n";
    }

    // Get form data from POST request
    $name = test_input(isset($_POST['name']) ? $_POST['name'] : null);
    $visitor_email = test_input(isset($_POST['email']) ? $_POST['email'] : null);
    $phone = test_input(isset($_POST['phone']) ? $_POST['phone'] : null);
    $properties = test_input(isset($_POST['properties']) ? $_POST['properties'] : null);
    $group = test_input(isset($_POST['group']) ? $_POST['group'] : null);
    $message = test_input(isset($_POST['message']) ? $_POST['message'] : null);
    $source_page = test_input(isset($_POST['request-page']) ? $_POST['request-page'] : null);

    // For a test, only send to admin, and label email as a 'TEST'
    // When testing the Viewing Request form, put 'admin' as the name
    if ($name == 'admin') {
        $to = "carlislestudentproperties@gmail.com";
        $email_subject = "TEST " . $email_subject;
    }

    // Put form data into email body
    $email_body .= "Score: $score\n".
        "Request made from: $source_page\n\n".
        "Name: $name\n".
        "Email: $visitor_email\n".
        "Phone: $phone\n".
        "Number of properties: $properties\n".
        "Group size: $group\n".
        "Message:\n$message\n";

    // Send email
    $header = "Reply-To: $visitor_email \r\n";
    mail($to,$email_subject,$email_body,$header);

    // Navigate to homepage
    echo '<script type="text/javascript">', 'location.href = "index.html?vr=1";', '</script>';

?>