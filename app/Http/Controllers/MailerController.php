<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailerController extends Controller {

    // =============== [ Email ] ===================
    public function email() {
        return view("email");
    }

    // ========== [ Compose Email ] ================
    public function composeEmail(Request $request) {
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try {

            //Configurações
            $email= 'edilson@luna.ppg.br';
            $pass= 'Simpatic21@'; 
            $nomeLoja= 'Luna Design - Jogos';

            // Email server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.'.substr(strstr($email, '@'), 1);
            $mail->SMTPAuth = true;
            $mail->Username = $email;   //  sender username
            $mail->Password = $pass;       // sender password
            $mail->Port = 587;                          // port - 587/465

            $mail->setFrom($email, $nomeLoja);
            
            $mail->addAddress($email);

            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = $request->emailSubject;
            $mail->Body    = 
            'E-mail..: ' . $request->emailContact 
            . '<br><br>' .
            'Mensagem: ' . $request->emailBody;

            // $mail->AltBody = plain text version of email body;

            if( !$mail->send() ) {
                return back()->with("failed", "Error, mensagem não enviada.")->withErrors($mail->ErrorInfo);
            }
            
            else {
                return back()->with("success", "E-mail enviado com sucesso.");
            }

        } catch (Exception $e) {
             return back()->with('error','Error, messagem não enviada.');
        }
    }
}