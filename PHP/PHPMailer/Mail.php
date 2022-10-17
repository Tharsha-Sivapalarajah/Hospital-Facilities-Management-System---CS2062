<?php
require 'PHPMailerAutoload.php';
require 'credential.php';

class Mail
{
    private PHPMailer $mail;

    public function __construct(string $to, string $subject, string $body)
    {
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = 4;
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = EMAIL;
        $this->mail->Password = PASS;
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 587;
        $this->mail->setFrom(EMAIL, 'Hospital Management');
        $this->mail->addAddress($to);
        $this->mail->isHTML(false);
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
    }

    public function send():bool
    {
        if(!$this->mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mail->ErrorInfo;
            return false;
        } else {
            echo 'Message has been sent';
            return true;
        }
    }
}

// $mail = new Mail("Kabilanen@gmail.com", "Test Subject", "Test Body");
// $mail->send();
// $mail = new PHPMailer(true);
// $mail->SMTPDebug = 4;                               // Enable verbose debug output

// $mail->isSMTP();                                      // Set mailer to use SMTP
// $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
// $mail->SMTPAuth = true;                               // Enable SMTP authentication
// $mail->Username = EMAIL;                 // SMTP username
// $mail->Password = PASS;                           // SMTP password
// $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
// $mail->Port = 587;                                    // TCP port to connect to

// $mail->setFrom(EMAIL, 'Hospital Management');
// $mail->addAddress('kabilanen@gmail.com', 'Jathavan');     // Add a recipient
// $mail->addAddress('ellen@example.com');               // Name is optional
// $mail->addReplyTo(EMAIL);
// $mail->addCC('jathavanm.19@cse.mrt.ac.lk');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
// $mail->isHTML(false);                                  // Set email format to HTML

// $mail->Subject = 'Facility Notification';
// $mail->Body    = 'Requird facilty details: ';
// $mail->AltBody = 'Requird facilty details: ';

// if(!$mail->send()) {
//     echo 'Message could not be sent.';
//     echo 'Mailer Error: ' . $mail->ErrorInfo;
// } else {
//     echo 'Message has been sent';
// }