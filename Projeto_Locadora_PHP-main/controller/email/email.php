<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    include_once('../conexao.php');
    $email_cliente = $_POST['email'];
    setcookie("email_recuperacao", $email_cliente, time()+1800, "/");

    $ConferirEmailExistente=mysqli_query($conexao,"select cpf from Cliente where email='".$_COOKIE['email_recuperacao']."';");
    #Busca uma linha na qual o email anteriormente inserido existe 
    if($ConferirEmailExistente->num_rows==1)
    { #se o email colocado existir no banco, a pessoa recebe o email para mudar senha



    $token = rand(100000, 999999);
    setcookie("token", $token, time() + (1800), "/"); // 1800 = 30 minutos
    //Load Composer's autoloader
    require 'vendor/autoload.php';
    
    if (isset($email_cliente)) {
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
            $mail->addAddress($email_cliente);
            $mail->addReplyTo($email_cliente);

                // Anexos
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);
                $mail->Subject = 'Recuperação de senha Locadora CEFET-RJ';
                $mail->Body    = "<h1>Olá use esse token</h1>". $token ."<h1>no site abaixo</h1> <br><br> <p>Inserir Link</p>";
                // alt body é bom para não cair em na caixa de spam, porém não tem html
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            header("Location: ../../view/recuperar.php");
            exit();
        }
        catch (Exception $e) {
            echo "Errou...: {$mail->ErrorInfo}";
        }
    }
    else {
        echo "nn foi";
    }



mysqli_close($conexao);

}#Fim do if criado ao por um email existente
else
{
mysqli_close($conexao);
header("Location:../../view/login.php");
}
?>