<?php

$data['error'] = false;

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$website = $_POST['website'];
$message = $_POST['message'];

if (empty($name)) {
    $data['error'] = 'Please enter your name.';
} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $data['error'] = 'Please enter a valid email address.';
} elseif (empty($message)) {
    $data['error'] = 'The message field is required!';
} elseif (empty($phone)) {
    $data['error'] = 'Please enter your phone number.';
} else {
    // Construct email content
    $formcontent = "From: $name\nPhone: $phone\nWebsite: $website\nEmail: $email\nMessage: $message";

    // Recipient email address
    $recipient = "mustafawaqar488@gmail.com";

    // Email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";
    $headers .= "From: $email \r\n";
    $headers .= "Reply-To: $email \r\n";

    // Send email
    if (mail($recipient, 'Contact Form Submission', $formcontent, $headers)) {
        $data['error'] = false; // No error
    } else {
        $data['error'] = 'Sorry, an error occurred while sending the email.';
    }
}

echo json_encode($data);

?>
