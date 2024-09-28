<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Cek apakah email valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Buat instance PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Pengaturan server SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Sesuaikan dengan server SMTP kamu
            $mail->SMTPAuth = true;
            $mail->Username = 'fauzymadani3@gmail.com'; // Email pengirim
            $mail->Password = 'jesw pfzw xxom qvvw'; // Password email pengirim
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Penerima email
            $mail->setFrom($email, 'Subscriber');
            $mail->addAddress('fauzymadani3@gmail.com'); // Email tujuan

            // Konten email
            $mail->isHTML(true);
            $mail->Subject = 'Newsletter Subscription';
            $mail->Body    = 'You have a new subscriber: ' . $email;

            // Kirim email
            $mail->send();

            // Kembalikan respons sukses dalam format JSON
            echo json_encode(["status" => "success", "message" => "Message has been sent"]);
        } catch (Exception $e) {
            // Jika gagal, kembalikan pesan error dalam format JSON
            echo json_encode(["status" => "error", "message" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
        }
    } else {
        // Jika email tidak valid, kembalikan pesan error
        echo json_encode(["status" => "error", "message" => "Invalid email address."]);
    }
}
