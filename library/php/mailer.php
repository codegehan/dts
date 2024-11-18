<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';
$dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

// echo $_ENV['BASE_URI'];

class EmailSender
{
    private $mail;

    // Constructor to initialize PHPMailer with Gmail SMTP settings
    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        try {
            // Server settings
            $this->mail->isSMTP();                                            // Set mailer to use SMTP
            $this->mail->Host       = 'smtp.gmail.com';                       // Gmail SMTP server
            $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $this->mail->Username   = 'codegehan05172024@gmail.com';          // Gmail username (your email)
            $this->mail->Password   = 'bnyh yfut hgoj wdox';                  // Gmail password or App Password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable TLS encryption, `ssl` also supported
            $this->mail->Port       = 465;                                    // TCP port to connect to (TLS)
        } catch (Exception $e) {
            echo "Mailer Error: {$e->getMessage()}";
        }
    }

    // Method to send an email
    public function sendEmail($toEmail, $toName, $subject, $body)
    {
        try {
            // Recipients
            $this->mail->setFrom('codegehan05172024@gmail.com', 'CodeGehan Development');                      // Sender's email
            $this->mail->addAddress($toEmail, $toName);                       // Add a recipient
            // Content
            $this->mail->isHTML(true);                                        // Set email format to HTML
            $this->mail->Subject = $subject;                                  // Set subject
            $this->mail->Body    = $body;                                     // Set HTML body
            $this->mail->AltBody = strip_tags($body);                         // Set plain text body for non-HTML clients
            // Send the email
            $this->mail->send();
            echo json_encode(array("status"=> "success", "message" => "Message has been sent"));
        } catch (Exception $e) {
            echo json_encode(array("status"=> "error", "message" => "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}"));
        }
    }
}


// $toEmail = 'gehanatomost@gmail.com';
// $toName = 'Gehan Resalute';
// $subject = 'This is a test email for My Document Tracking Service';
// $body = 'This is a test email sent using Gmail SMTP with <b>PHPMailer</b>.';

// $emailSender = new EmailSender();
// $emailSender->sendEmail($toEmail, $toName, $subject, $body);
?>