<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once "ReCAPTCHA/php/recaptchalib.php";

$secret = "6LcrRtshAAAAACWOU67QiV3HwaWRW-x5JencITUZ";
$response = null;
// Verificamos la clave secreta
$reCaptcha = new ReCaptcha($secret);
if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}

if ($response != null && $response->success) {
// Añade aquí el código que desees en el caso de que la validación sea correcta

    if (isset($_POST['sendmail'])) {
        $UserName = $_POST['name'];
        $Email = $_POST['email'];
        $Subject = $_POST['subject'];
        $Msg = $_POST['message'];
        $Tel = $_POST['phone'];


        if (empty($UserName) || empty($Email) || empty($Subject) || empty($Msg) || empty($Tel)) {
            header('location:contacto.php?error');
        } else {
            sendmail($Subject, $Msg, $UserName, $Email, $Tel);
        }
    } else {
        header("location:index.php");
    }


} else {
// Añade aquí el código que desees en el caso de que la validación no sea correcta o muestra
    header("location:contacto.php?error_recaptcha");
}

function sendmail(string $subject_input, string $message_input, string $name_input, string $email_input, string $tel_input)
{
    $name = 'CONTACTANOS';  //
    $pass = 'Pa$$w0rd.2022';
    $to = "info@xitacademy.xenturionit.com";  // REEMPLAZAR DATOS POR CORREO OFICIAL
    $subject = $subject_input;
    $from = "info@xitacademy.xenturionit.com"; // REEMPLAZAR DATOS POR CORREO OFICIAL
    $password = $pass; // REEMPLAZAR DATOS POR CORREO OFICIAL
    $MessageComplete = nl2br(" <b> Nombre: </b> $name_input  <b> \n Email: </b> $email_input \n <b> Asunto: </b>$subject_input \n <b> Mensaje: </b> $message_input \n <b> Celular: </b>$tel_input \n");
    $body = $MessageComplete;


    // Ignore from here

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail = new PHPMailer();

    // To Here

    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging
    $mail->Host = "usm1.noc41.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 465;  // port
    $mail->SMTPSecure = "ssl";  // tls or ssl
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($to); // enter email address whom you want to send
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {
        header("location:contacto.php?success");
    } else {
        header("location:contacto.php?error");
    }
}

?>
