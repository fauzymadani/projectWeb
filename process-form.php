<?php
require 'vendor/autoload.php'; // Pastikan ini ditambahkan di atas kode PHP lainnya

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Kode selanjutnya...
if (isset($_REQUEST['name'], $_REQUEST['email'])) {
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $message = $_REQUEST['message'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Ganti dengan server SMTP yang kamu gunakan
        $mail->SMTPAuth = true;
        $mail->Username = 'fauzymadani3@gmail.com'; // Ganti dengan email kamu
        $mail->Password = 'jesw pfzw xxom qvvw'; // Ganti dengan password email kamu
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('fauzymadani3@gmail.com'); // Ganti dengan email penerima

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Contact Request From Website';
        $mail->Body    = $message;

        $mail->send();
        echo 'success';
    } catch (Exception $e) {
        echo 'error: ' . $mail->ErrorInfo;
    }
}
