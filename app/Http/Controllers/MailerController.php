<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Models\Product;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailerController extends Controller {

    // =============== [ Email ] ===================
    public function email() {
        return view("site.home.email");
    }

    public function orcamento($id)
    {
        $products = Product::find($id);
        return view("site.home.orcamento", compact('products'));
    }

    // ========== [ Compose Email ] ================
    public function composeOrcamento (Request $request) {
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
            utf8_decode('* * * Solicitação de Orçamento: * * *' 
            . '<br>' .
            'Nome......: ' . $request->nomeContato 
            . '<br>' .
            'E-mail....: ' . $request->email 
            . '<br>' .
            'Telefone..: ' . $request->telefone 
            . '<br>' .
            'Código....: ' . $request->id 
            . '<br>' .
            'Produto...: ' . $request->produto
            . '<br>' .
            'Quantidade: ' . $request->qtde 
            . '<br>' .
            'Mensagem..: ' . $request->emailBody
            );

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