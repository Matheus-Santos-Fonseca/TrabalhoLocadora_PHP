<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$feed=$_POST['feedText'];
#mesma coisa que o codigo de email, mudei nada alem do if de checar se o email existe, que aqui esta ausente
# F para quem tem o email admin@gmail.com
require 'vendor/autoload.php';
    
if (isset($feed)) {
$mail = new PHPMailer(true);

    try{
            //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'soueu4877@gmail.com';
        $mail->Password   = 'fvhujomqsybcfmqo';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;                                    
                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
        $mail->setFrom('soueu4877@gmail.com', 'Locadora Cefet');
        $mail->addAddress('11.greatdemonlord@gmail.com');
        $mail->addReplyTo('11.greatdemonlord@gmail.com');

                // Anexos
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
        $mail->isHTML(true);
        $mail->Subject = 'Teu site e trabalho é uma merda, cabelo é anão, juan é imigrante, gustavo é esquizofrenico';
        $mail->Body = 
        "<h1>Em tese, no contexto social atual da republica federativa brasileira</h1>
       							<p>" . $feed . "</p>
        <h1>O stf é uma merda</h1> <br><br> <p>Insira a pika aqui-></p><button>cu</button>";
                // alt body é bom para não cair em na caixa de spam, porém não tem html
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            header("Location: ../../index.php");
            exit();
        }
        catch (Exception $e) {
            echo "Errou...: {$mail->ErrorInfo}";
        }
    }
    else {
        echo "nn foi";
    }
    header("Location:../../index.php");
?>