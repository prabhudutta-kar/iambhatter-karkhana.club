<?php

// configure
$from = 'sudolivz@md-in-17.webhostbox.net'; 
$sendTo = 'hello@karkhana.club';
$subject = 'New message from Contact Form';
$fields = array('template-contactform-name' => 'Name', 'template-contactform-email' => 'Email', 'template-contactform-phone' => 'Phone', 'template-contactform-subject' => 'Subject', 'template-contactform-service' => 'Services' , 'template-contactform-message' => 'Message'); // array variable name => Text to appear in email
$okMessage = 'We have received your message. Thank you for contacting us, We will get back to you soon!';
$errorMessage = 'There was an error while submitting the form. Please try again later';

// let's do the sending

try
{
    $emailText = "New Visitor Message";

    foreach ($_POST as $key => $value) {

        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    mail($sendTo, $subject, $emailText, "From: " . $from);

    $responseArray = array('type' => 'success', 'template-contactform-message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'template-contactform-message' => $errorMessage);
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
else {
    echo $responseArray['template-contactform-message'];
}
?>