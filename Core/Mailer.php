<?php

namespace Core;

use App\Config;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mailer
{
    public $address;
    public $name;
    public $subject = '';
    public $html = '';
    public $althtml = 'To read this email you need html support.';

    public function send()
    {

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = Config::MAIL_HOST;                  // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = Config::MAIL_USER;                     // SMTP username
            $mail->Password = Config::MAIL_PASSWORD;                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom(Config::SENDADDRESS, Config::SENDNAME);
            $mail->addAddress($this->address, $this->name);     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo(Config::SENDADDRESS, Config::SENDNAME);
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $this->subject;
            $mail->Body = $this->html;
            $mail->AltBody = $this->althtml;

            $mail->send();
            return "Message has been sent";
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function setaddress($address)
    {
        $this->address = $address;
    }

    public function setname($name)
    {
        $this->name = $name;
    }

    public function setsubject($subject)
    {
        $this->subject = $subject;
    }

    public function sethtml($html)
    {
        $this->html = $html;
    }

    public function setalthtml($althtml)
    {
        $this->althtml = $althtml;
    }

}