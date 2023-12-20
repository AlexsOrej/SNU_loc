
<?php
// Mostrar errores en pantalla
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Tu código PHP aquí


require_once '../model/Pqrs.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../../vendor/autoload.php';


class PqrsController
{

    private $model;
    private $notificacion;

    public function __CONSTRUCT()
    {
        $this->model = new Pqrs();
    }

    public function Index()
    {

        //require_once '../vista/header.php';
        require_once '../vista/pqrs/index.php';
        // require_once '../vista/footer.php';

    }

    public function Crud()
    {
        $alm = new Pqrs();

        if (isset($_REQUEST['id'])) {
            $alm = $this->model->Obtener($_REQUEST['id']);
            require_once '../vista/header.php';
        } else {
            require_once '../vista/vista_pqrs.php';
        }
        require_once '../vista/pqrs/pqrs-editar.php';
        require_once '../vista/footer.php';
    }

    public function Add()
    {
        date_default_timezone_set('America/Bogota');

        $alm = new Pqrs();

        $rand = range(1, 10000);
        shuffle($rand);

        $randValue = $rand[0];
        $alm->url = $_REQUEST['urlp'];
        $alm->nombres = $_REQUEST['nombres'];
        $alm->apellidos = $_REQUEST['apellidos'];
        $alm->tipo_peticion = $_REQUEST['tipo_peticion'];
        $alm->descripcion = $_REQUEST['descripcion'];
        $alm->n_contacto = $_REQUEST['n_contacto'];
        $alm->correo = $_REQUEST['correo'];
        $alm->estado = "abierto";
        $alm->radicado = "Rad-" . $randValue;
        $alm->fecha_registro = date('Y-m-d H:i:s');
        $alm->empresa = $_REQUEST['empresa'];
        $this->model->Registrar($alm);

        $radicadoValue = base64_encode("Rad-" . $randValue);


        $cliente = ucwords($alm->nombres . ' ' . $alm->apellidos) . '<br>' . $alm->empresa;
        $asunto = 'IMPORTANTE -> Ha sido registrado una peticion en el sistema de PQRSF';
        $mensaje = '<!DOCTYPE html>
                    <html lang="es">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Correo Electrónico</title>
                        <style>
                            /* Estilos generales */
                            body {
                                font-family: Arial, sans-serif;
                                line-height: 1.6;
                                margin: 0;
                                padding: 0;
                            }
                            .container {
                                max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                            }
                            h1 {
                                color: #007BFF;
                            }
                            p {
                                margin-bottom: 20px;
                            }
                            .button {
                                display: inline-block;
                                padding: 10px 20px;
                                font-size: 16px;
                                font-weight: bold;
                                text-align: center;
                                text-decoration: none;
                                border: none;
                                border-radius: 4px;
                                cursor: pointer;
                                transition: background-color 0.3s ease;
                            }
                            /* Estilos por defecto */
                            .button {
                                color: #ffffff;
                                background-color: #007BFF;
                            }

                            /* Estilos al pasar el cursor por encima */
                            .button:hover {
                                background-color: #0056b3;
                                color:white
                            }

                            /* Estilos al presionar el botón */
                            .button:active {
                                background-color: #003380;
                                color:white
                            }

                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <h1>Sistema de Notificaciones</h1>
                            <p>Buen día</p>                
                            <p>Ha sido registrado un(a) solicitud de <strong>' . $alm->tipo_peticion . '</strong> en el sistema de PQRSF</p>
                            <p>' . $cliente . '<br>' . $alm->descripcion . '<br>RADICADO:' . $alm->radicado . '</p>
                            <p>¡Gracias por leer este mensaje!</p>
                            <p>Saludos cordiales,</p>
                            <p>SNU</p>
                            <p><a class="button" href="https://calidadsnu.com/">Visitar SNU</a></p>
                        </div>
                    </body>
                    </html>';
        $correo = new PqrsController();
        $asignados = $this->model->NotificarA($this->model->Squema());

        foreach ($asignados as $value) {
            $destinatario = $value->email;
            $correo->Notificar($asunto, $mensaje, $destinatario);
        }

        header("Location: https://calidadsnu.com/snu/Contacto/start/index.php?url=" . urlencode($alm->url) . "&rad=" . $radicadoValue);
    }

    public function Eliminar()
    {
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }

    public function Notificar($asunto = null, $mensaje = null, $destinatario = null, $copias = null, $adjunto = null)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'firmacalidadpublicitario@gmail.com';                     //SMTP username
            $mail->Password   = 'ddaoxcfytkbcsruc';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //Recipients
            $mail->setFrom('CalidadSnu@calidadsnu.com', 'CalidadSNU');
            $mail->addAddress($destinatario, ''); //Add a recipient   
            $mail->addCC('firmacalidadpublicitario@gmail.com');
            //Attachments            
            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body = $mensaje;

            if ($mail->send()) {
                echo  'Mensaje fue enviado';
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
