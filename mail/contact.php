<?php
if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400); // Bad Request
    echo "Please fill in all required fields and provide a valid email address.";
    exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$to = "alibasti2021@gmail.com"; // Change this email to yours
$subject = "$m_subject: $name";
$body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\n\nEmail: $email\n\nSubject: $m_subject\n\nMessage: $message";
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";

if(mail($to, $subject, $body, $headers)) {
    http_response_code(200); // OK
    echo "Your message has been sent successfully.";
} else {
    error_log("Mail sending failed for: $email"); // Log the error
    http_response_code(500); // Internal Server Error
    echo "There was a problem sending your message. Please try again later.";
}
?>
