<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailHelper
{
    /**
     * Mengirim email reset password.
     *
     * @param string $toEmail Alamat email penerima.
     * @param string $toName Nama penerima.
     * @param string $token Token reset password.
     * @return bool True jika email berhasil dikirim, false jika gagal.
     */
    public static function sendPasswordResetEmail($toEmail, $toName, $token)
    {
        $mailConfig = require __DIR__ . '/../config/mail.php';
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = $mailConfig['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $mailConfig['username'];
            $mail->Password   = $mailConfig['password'];
            $mail->SMTPSecure = $mailConfig['encryption'];
            $mail->Port       = $mailConfig['port'];

            // Recipients
            $mail->setFrom($mailConfig['from_email'], $mailConfig['from_name']);
            $mail->addAddress($toEmail, $toName);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Atur Ulang Kata Sandi Akun Sinar Jaya Anda';
            $resetLink = BASEURL . 'auth/resetPassword/' . $token;
            $mail->Body    = "
                <h2>Permintaan Atur Ulang Kata Sandi</h2>
                <p>Halo " . htmlspecialchars($toName) . ",</p>
                <p>Kami menerima permintaan untuk mengatur ulang kata sandi akun Anda. Klik tombol di bawah ini untuk melanjutkan.</p>
                <p style='text-align: center;'>
                    <a href='" . $resetLink . "' style='background-color: #0f4bd9; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; display: inline-block;'>Atur Ulang Kata Sandi</a>
                </p>
                <p>Tautan ini akan kedaluwarsa dalam 15 menit.</p>
                <p>Jika Anda kesulitan mengklik tombol di atas, salin dan tempel URL di bawah ini ke browser web Anda:</p>
                <p><a href='" . $resetLink . "'>" . $resetLink . "</a></p>
                <p>Jika Anda tidak meminta pengaturan ulang kata sandi, abaikan saja email ini.</p>
                <br>
                <p>Terima kasih,</p>
                <p>Tim Sinar Jaya</p>
            ";
            $mail->AltBody = 'Untuk mengatur ulang kata sandi Anda, silakan kunjungi tautan berikut: ' . $resetLink;

            $mail->send();
            return true;
        } catch (Exception $e) {
            // Mencatat error ke file log PHP untuk debugging jika terjadi masalah.
            error_log("PHPMailer Error: Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }
}
