<?php
// Check for empty fields
if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "No arguments provided or invalid email!";
    return false;
}

// Sanitize input data
$name = strip_tags(trim($_POST['name']));
$email_address = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$phone = strip_tags(trim($_POST['phone']));
$message = trim($_POST['message']);

// Create the email and send the message
$to = 'w.dob@hotmail.com'; // Add your email address here
$email_subject = "Website Contact Form: $name";
$email_body = "You have received a new message from your website contact form.\n\n" .
              "Here are the details:\n\n" .
              "Name: $name\n\n" .
              "Email: $email_address\n\n" .
              "Phone: $phone\n\n" .
              "Message:\n$message";
$headers = "From: noreply@leksand.pl\n"; // Change this to your domain
$headers .= "Reply-To: $email_address\n";
$headers .= "Content-Type: text/plain; charset=UTF-8";

// Send the email
if (mail($to, $email_subject, $email_body, $headers)) {
    http_response_code(200);
    echo "Thank you! Your message has been sent.";
    return true;
} else {
    http_response_code(500);
    echo "Oops! Something went wrong and we couldn't send your message.";
    return false;
}
?>
