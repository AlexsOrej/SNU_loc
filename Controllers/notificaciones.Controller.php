<?php
//importar los modelos necesarios
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
/** */
require_once 'Models/Sessioncheck.php';
require 'vendor/autoload.php';
require_once 'Models/Notificacion.php';
require_once 'Models/Proceso.php';
require_once 'Models/Usuario.php';
//nombre la clase
class NotificacionesController
{
  private $model;
  private $proceso;
  private $usuarios;

  public function __CONSTRUCT()
  {
    $this->model = new Notificacion();
    $this->proceso = new Proceso();
    $this->usuarios = new Usuario();
  }
  /*crear los metodos necesarios*/
  /*este metodo recibe los siguintes parametros el id= solicitud /pqrs /asunto y mensaje/ destinatario*/
  public function Notificar($asunto = null, $mensaje = null, $destinatario = null, $adjunto = null, $copias = null)
  {
    $mail = new PHPMailer(true);
    try {
      //Server settings
      //$mail->SMTPDebug = SMTP::DEBUG_SERVER; 
      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'firmacalidadpublicitario@gmail.com';   //SMTP username
      $mail->Password   = 'ddaoxcfytkbcsruc';                     //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
      //Recipients
      $mail->setFrom('CalidadSnu@calidadsnu.com', 'CalidadSNU');
      if (is_array($destinatario)) {
        foreach ($destinatario as $correo => $nombre) {
          $mail->addAddress($correo, $nombre);
        }
      } else {
        $mail->addAddress($destinatario, "");
      }
      $mail->addCC('firmacalidadpublicitario@gmail.com');
      //Attachments
      //$mail->addAttachment('/var/tmp/file.tar.gz');//Add attachments
      if (is_dir($adjunto)) {
        $nombreDoc = explode('/', $adjunto);
        $name = $nombreDoc[count($nombreDoc) - 1];
        $mail->addAttachment($adjunto, $name);
      }
      //Optional name
      //Content
      $mail->isHTML(true); //Set email format to HTML
      $mail->Subject = $asunto;
      $mail->Body = $mensaje;
      if ($mail->send()) {
        return true;
      }
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }

  public function Crud()
  {
    $notif = new Notificacion();
    $modulo = new Oferta();
    $usuario = new Usuario();
    $usuarios = $usuario->GetUsuarios($_SESSION['datos_cliente']->id);
    $modulos = $modulo->Index();
    $procesos = $this->proceso->getProcesosALL();

    if (isset($_REQUEST['id'])) {
      $notif = $this->model->Ver($_REQUEST['id']);
    }
    require_once 'Views/Layout/default.php';
    require_once 'Views/Notificaciones/notificar.php';
    require_once 'Views/Layout/foot.php';
    // require_once 'Views/Layout/filtro.php';

  }

  public function Registrar()
  {
    $notif = new Notificacion();
    $accion = array();
    isset($_REQUEST['registro']) ? array_push($accion, $_REQUEST['registro']) : '';
    isset($_REQUEST['revision']) ? array_push($accion, $_REQUEST['revision']) : '';
    isset($_REQUEST['respuesta']) ? array_push($accion, $_REQUEST['respuesta']) : '';
    $notif->id = $_REQUEST['id'];
    $partes = explode("-", $_REQUEST['responsable']);
    $notif->modulo_id = $_REQUEST['modulo_id'];
    $notif->usuario_id = $partes[0];
    $notif->proceso_id = $_REQUEST['proceso_id'];
    $notif->id > 0 ?
      $notif->email = $_REQUEST['email_'] :
      $notif->email = $partes[1];
    $notif->accion = $jsonString = json_encode($accion);
    $notif->id > 0 ? $notif->Actualizar($notif) : $notif->Registrar($notif);
  }



  public function Borrar()
  {
    $notif = new Notificacion();
    $notif->Eliminar($_REQUEST['id']);
  }


  /**NOTIFICACION DEL MODULO DOCUMENTAL */

  public function Index_notificaciones()
  {
    $notif = new Notificacion();
    $notifs = $notif->Index();

    require_once 'Views/Layout/default.php';
    require_once 'Views/Notificaciones/index.php';
    // print_r($notifs);
    require_once 'Views/Layout/foot.php';
    require_once 'Views/Layout/filtro.php';
  }
  /** FIN NOTIFICACION DEL MODULO DOCUMENTAL */
  /**NOTIFICAR LLEGADA PQRSF */
  public function Pqrsf()
  {
    $notif = new Notificacion();
    $notifs = $notif->Index();
    require_once 'Views/Layout/pqrs.php';
    require_once 'Views/Notificaciones/pqrsf.php';
    require_once 'Views/Layout/foot.php';
    require_once 'Views/Layout/filtro.php';
  }


  public function Notificar_pqrsf()
  {
    $notif = new Notificacion();
    $usuario = new Usuario();
    $asignados = $notif->AsignadosPqrs();
    $usuarios = $usuario->GetUsuarios($_SESSION['datos_cliente']->id);
    require_once 'Views/Layout/pqrs.php';
    require_once 'Views/Notificaciones/notificar_pqrsf.php';
    require_once 'Views/Layout/foot.php';
    require_once 'Views/Layout/filtro.php';
  }



  public function Registrar_pqrsf()
  {
    $selectedData = json_decode($_POST['data'], true);
    foreach ($selectedData as $data) {
      $notif = new Notificacion();
      $notif->modulo_id = 5;
      $notif->proceso_id = 0;
      $notif->usuario_id = $data['nombres'];
      $notif->email = $data['correo'];
      $notif->accion = '["registro"]';
      if ($notif->id > 0) {
        $notif->Actualizar($notif);
      } else {
        $notif->Registrar($notif);
      }
    }
    echo "Notificaciones registradas correctamente.";
  }

  function Notificar_pqrsf_quitar()
  {
    $notif = new Notificacion();

    if ($notif->Quitar($_REQUEST['userId'], 5)) {
      echo 'true';
    } else {
      echo 'false';
    }
  }

  public function Notificarcontrato()
  {

    $jsonData = file_get_contents("php://input");
    $requestData = json_decode($jsonData, true);
    $asunto = "IMPORTANTE  el area de talento humano le informa que hay un contrato es listo para firmar";
    $mensaje = $requestData['mensaje'];
    $Destinatarios = array(
      $requestData['contratante'] => '', $requestData['colaborador'] => ''
    );

    $Destinatario1 = $requestData['colaborador'];

    $result = $this->Notificar($asunto, $mensaje, $Destinatarios);
    // Construir el arreglo de respuesta
    $response = array(
      'success' => $result !== false, // Comprobamos si $result no es false
      'message' => $result !== false ? 'Notificación enviada exitosamente' : 'Error al enviar la notificación'
    );

    // Convertir el arreglo de respuesta a JSON y enviarlo de vuelta
    header('Content-Type: application/json');
    echo json_encode($response);
  }
}
