<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';

class CorreoController
{
    // public function __CONSTRUCT()
    // {
    //     $this->model = new Correo();
    // }

    public function Correo()
    {

        include('Models/PHPMailer/configurar_mail.php');
        $to="alexsanderorejuela@gmail.com"; 
        $message="<h1>Correo electrónico PHP con datos adjuntos de BaulPHP</h1>"; 
        $mail->addAddress($to);
        $mail->addAddress('calidadsg@gmail.com');
        // $mail->addAddress('desarrollo@calidadsg.com');
        //$mail->setFrom('gestionhumana@sgvc.co', 'Gestion Humana');
        $mail->setFrom('calidadsg@gmail.com', 'Gestion Humana');
        $body = $message; //variable de formulario
        $mail->MsgHTML($body);
        $mail->Send();

        if (!$mail->send()) {
            "No se pudo enviar el correo. Intentelo más tarde.";
        } else {
            "Gracias por contactarnos.";
        }
    }
}
