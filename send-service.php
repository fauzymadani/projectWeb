<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';



header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email address']);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Ganti dengan server SMTP Anda
        $mail->SMTPAuth = true;
        $mail->Username = 'fauzymadani3@gmail.com'; // Ganti dengan alamat email Anda
        $mail->Password = 'jesw pfzw xxom qvvw'; // Ganti dengan kata sandi email Anda
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // Port SMTP

        // Pengirim dan penerima
        $mail->setFrom('fauzymadani3@gmail.com', 'Mailer');
        $mail->addAddress($email); // Alamat email yang dimasukkan oleh user

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = 'Test Email';
        $mail->Body = 'You have received a new email from ' . $email;

        // Kirim email
        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Email sent successfully']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
