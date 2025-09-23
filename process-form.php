<?php
// Load Composer's autoloader
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = trim($_POST['name']);
    $phone   = trim($_POST['phone']);
    $date    = trim($_POST['date']);
    $message = trim($_POST['message']);

    // Server-side validation
    if (strlen($name) < 3 || !preg_match('/^\d{10}$/', $phone) || strlen($message) < 5) {
        die("Invalid input. Please go back and correct the form.");
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tech.drdiptismilesuite@gmail.com'; 
        $mail->Password   = 'riuh qizd knti zqvq'; // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('tech.drdiptismilesuite@gmail.com', 'Website Form');
        $mail->addAddress('tech.drdiptismilesuite@gmail.com'); // Receiver

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'New Form Submission';
        $mail->Body    = "
            <h2>Form Submission Details</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Date:</strong> {$date}</p>
            <p><strong>Message:</strong> {$message}</p>
        ";

        if ($mail->send()) {
            echo "<script>alert('Form submitted successfully!'); window.location.href='index.html';</script>";
        } else {
            echo "<script>alert('Failed to send message.'); window.history.back();</script>";
        }
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>