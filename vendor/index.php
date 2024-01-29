<?php
require_once __DIR__ . '\autoload.php';

include "PHPMailer/PHPMailer/src/Exception.php";
include "PHPMailer/PHPMailer/src/PHPMailer.php";
include "PHPMailer/PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public function sendMail($title, $content, $email)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 2; // Enable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Corrected hostname
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'lesonkyac@gmail.com'; // SMTP username
            $mail->Password = 'xhgyfcry iafnnuss'; // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom('lesonkyac@gmail.com', 'JSonDev');
            $mail->addAddress($email); // Add a recipient

            //Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $title;
            $mail->Body = $content;

            $mail->send();
        } catch (Exception $e) {
        }
    }
}
