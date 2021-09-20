<?php
if(!isset($email)){
    header('location: login.php');
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

// $mail->SMTPDebug = 2;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'itsdigilife@gmail.com';                 // SMTP username
$mail->Password = 'vfzaqiwgzuzarexc';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('itsdigilife@gmail.com', 'DigiLife');
$mail->addAddress($email);             // Name is optional
// $mail->addReplyTo('info@example.com', 'Information');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'DigiLife - Password Reset Request';
$mail->Body    = '<html>
<body>
    <p>dear '.$name.',<br><br>Please <a href="http://localhost/satyajit/reset_password.php?token='.$token.'">click here</a> to reset your password.
    <br><br>Once you'."'".'ve reset your password, you can login our page <a href="http://localhost/satyajit/login.php">from here</a></p>
</body>
</html>';

if ($mail->send()) {
    session_start();
    $_SESSION['mailed'] = true;
    header('location:login.php');
} else {
    $invalid_email = true;
}
?>