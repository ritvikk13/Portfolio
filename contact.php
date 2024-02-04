<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $comment = $_POST["comment"];

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;  // Enable verbose debug output (set to DEBUG_SERVER for development)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Specify the SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'rietseth@gmail.com';  // Replace with your Gmail address
        $mail->Password = 'jcsc oxfp pkkh dlii';  // Replace with your App Password (or regular Gmail password if not using two-factor authentication)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption

        $mail->Port = 587;  // TCP port to connect to

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('rietseth@gmail.com');  // Replace with your Gmail address

        // Content
        $mail->isHTML(true);  // Set to true if you want to send HTML-formatted emails
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "Name: $name<br>Email: $email<br><br>Comment:<br>$comment";

        $mail->send();
        header('Location: index.php?success=1');



    } catch (Exception $e) {
        echo "Oops! Something went wrong. Please try again later. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
