<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
  //Server settings
  $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
  $mail->isSMTP(); // Send using SMTP
  $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
  $mail->SMTPAuth = true; // Enable SMTP authentication
  $mail->Username = 'dhiraj.test.mail@gmail.com'; // SMTP username
  $mail->Password = 'Ch@ngeMe123'; // SMTP password
  // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

  //Recipients
  $mail->setFrom('dhiraj.patra@gmail.com', 'Mailer');
  $mail->addAddress($_POST['email'], $_POST['name']); // Add a recipient
  $mail->addAddress('dhiraj.patra@gmail.com'); // Name is optional
  $mail->addReplyTo($_POST['email'], $_POST['name']);

  // Attachments
  // $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
  // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name

  // Content
  $mail->isHTML(true); // Set email format to HTML
  $mail->Subject = $_POST['subject'];
  $mail->Body = $_POST['message'];
  $mail->AltBody = $_POST['message'];

  $mail->send();
  echo 'Message has been sent';
  exit;
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  exit;
}