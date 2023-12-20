<?php
// importar los modelos necesarios
require_once 'Models/database.php';
require_once 'Models/Model.php';
require_once 'Models/Pqrsf.php';
require_once 'Models/Proceso.php';
require_once 'Models/Respuesta.php';
require_once 'Models/Satisfacion.php';
require_once 'Models/Satisfacion01.php';
require_once 'Models/Grafico.php';
require_once 'Controllers/notificaciones.Controller.php';
require_once 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

//nombre la clase
class PqrsfController
{

  private $model;

  public function __CONSTRUCT()
  {
    $this->model = new Pqrsf();
    $tblSegmentos = new Model();
    $tblSegmentos->TblSegmentos('segmentos');
  }

  public function Index()
  {
    $cliente = $_SESSION['datos_cliente']->id;
    $graByEst = $this->model->GrafByEst($cliente);
    $graBytipo = $this->model->GrafByTipo($cliente);
    $totalBytipo = $this->model->TotalByTipo($cliente);
    $totalporcategoria = $this->model->TotalPorCategoria();
    $totalsatisfacion = $this->model->TotalSatisfacion();
    $promedioasignacion = $this->model->PromedioAsignacion();
    $promediorespuesta = $this->model->PromedioRespuesta();
    $porcentaje = new Grafico();
    $procesos = new Proceso();

    require_once 'Views/Layout/pqrs.php';
    require_once 'Views/Pqrsf/index.php';
    require_once 'Views/Layout/foot.php';
  }

  public function Estados()
  {
    $estado = $_REQUEST['estado'];
    $cliente = $_SESSION['datos_cliente']->id;
    $pqrsByest = $this->model->ByEstado($cliente, $estado);
    $uuid = $this->guidv4();
    require_once 'Views/Pqrsf/estado.php';
    require_once 'Views/Layout/filtro.php';
  }
  public function Tipo()
  {
    $tipo = $_REQUEST['tipo'];
    $cliente = $_SESSION['datos_cliente']->id;
    $pqrsBytipo = $this->model->ByTipo($cliente, $tipo);
    require_once 'Views/Pqrsf/tipo.php';
    require_once 'Views/Layout/filtro.php';
  }

  /**RESUMEN */
  public function Resumen()
  {
    $proceso = new Proceso();
    $procesos = $proceso->getProceso0();
    $pqrs = new Pqrsf();
    $Pqr = $this->model->Obtener($_REQUEST['id']);
    $respuesta = new Respuesta();
    $respuesta = $respuesta->Obtener($Pqr->id);
    $satisfacion = new Satisfacion01;
    @$satisfacion = $satisfacion->Obtener($respuesta->id);
    require_once 'Views/Pqrsf/resumen.php';
  }
  /**SATISFACION */
  public function Satisfacion()
  {
    $satisfacion = new Satisfacion01();
    $respuesta = new Respuesta();
    $respuesta = $respuesta->Obtener($_REQUEST['pqrs_id']);
    if (@$_REQUEST['id'] > 0) {
      $satisfacion = $satisfacion->Obtener($_REQUEST['id']);
    }
    require_once 'Views/Pqrsf/satisfacion.php';
  }
  public function CrudSatisfacion()
  {
    $satisfacion = new Satisfacion01();
    $satisfacion->id = $_REQUEST['id'];
    $satisfacion->empresa_id = $_REQUEST['empresa_id'];
    $satisfacion->estado_cliente = $_REQUEST['satisfacion'];
    $satisfacion->sugerencia = $_REQUEST['observacion'];
    $satisfacion->respuesta_id = $_REQUEST['respuesta_id'];
    $satisfacion->created = date('Y-m-d H:i:s');
    $satisfacion->AddSatisfacion($satisfacion);
  }
  /**ASIGNAR**/
  public function Asignar()
  {
    $proceso = new Proceso();
    $_SESSION['user']->rol_id == 1 ? $procesos = $proceso->getProceso0() : $procesos = $proceso->getProceso();
    require_once 'Views/Pqrsf/asignar.php';
  }

  public function addAsignar()
  {
    date_default_timezone_set('America/Bogota');
    $asignar = new Pqrsf();
    $asignar->id = $_REQUEST['id'];
    $asignar->responsable = $_REQUEST['responsable'];
    $_REQUEST['email'];
    $asignar->f_asignacion = date('Y-m-d H:i:s');
    $asignar = $this->model->Asignar($asignar);
    $this->NotificarAsignacion($_REQUEST['email']);
  }
  /**ASIGNAR */

  /*RESPUESTA*/
  public function Responder()
  {
    $pqrs = new Pqrsf();
    $proceso = new Proceso();
    $respuesta = new Respuesta();
    $procesos = $proceso->getProceso0();
    $segmento = $this->model->ObtenerSegmento();
    if (isset($_REQUEST['id'])) {
      $pqrs = $this->model->Obtener($_REQUEST['id']);
      if ($pqrs->estado == 'revision') {
        $respuesta = $respuesta->Obtener($pqrs->id);
      }
    }
    require_once 'Views/Pqrsf/respuesta.php';
  }
  public function AddRespuesta()
  {
    $respuesta = new Respuesta();
    $respuesta->pqrs_id = $_REQUEST['pqrs_id'];
    $respuesta->proceso_id = $_REQUEST['proceso_id'];
    $respuesta->accion = $_REQUEST['accion'];
    $respuesta->respuesta = $_REQUEST['respuesta'];
    $respuesta->clasificacion_id = $_REQUEST['clasificacion_id'];
    $respuesta->identificacion = $_REQUEST['identificacion'];
    $respuesta->estado = $_REQUEST['estado'];
    $respuesta->respuesta_id = $_REQUEST['respuesta_id'];
    $respuesta->usuario = $_SESSION['user']->FullName;

    // print_r($respuesta);
    $_REQUEST['respuesta_id'] > 0 ?
      $respuesta->ValRespuesta($respuesta) :
      $respuesta->AddRespuesta($respuesta);
  }
  /*RESPUESTA*/
  public function Add()
  {
    $alm = new Pqrs();
    $rand = range(1, 10000);
    shuffle($rand);
    foreach ($rand as $val) {
      $val;
    }
    $alm->url = $_REQUEST['urlp'];
    $alm->nombres = $_REQUEST['nombres'];
    $alm->apellidos = $_REQUEST['apellidos'];
    $alm->tipo_peticion = $_REQUEST['tipo_peticion'];
    $alm->descripcion = $_REQUEST['descripcion'];
    $alm->n_contacto = $_REQUEST['n_contacto'];
    $alm->correo = $_REQUEST['correo'];
    $alm->estado = "abierto";
    $alm->radicado = "Rad-" . $val;
    $alm->fecha_registro = date('Y-m-d');
    $alm->empresa = $_REQUEST['empresa'];
    $this->model->Registrar($alm);
    $i = "Rad-" . $val;
    $valc = base64_encode("Rad-" . $val);
    header("Location: https://documental.calidadsg.com/pqrs/start/index.php?url=" . urlencode($alm->url) . "&rad=" . $valc);
  }
  public function Notificar()
  {
    $pqrs = new Pqrsf();
    $pqrs = $this->model->Obtener($_REQUEST['id']);
    $respuesta = new Respuesta();
    $respuesta = $respuesta->Obtener($pqrs->id);
    /**
     * TODO: enviar correo, actualizar el estado de la solicitud a cerrado
     *Se recibe el id de la solictud, se consultan los datos del usuario y solicitud */
    $destinatario = $pqrs->email;
    $asunto = "Contesto su solicitud";
    echo $cuerpo = '<!doctype html>
        <html>
          <head>
            <meta name="viewport" content="width=device-width" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Transactional Email</title>
         </head>
          <body class="" style="background-color: #f6f6f6;
                font-family: sans-serif;
                -webkit-font-smoothing: antialiased;
                font-size: 14px;
                line-height: 1.4;
                margin: 0;
                padding: 0;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
                text-align: justyfi;
                text-coloyr: black;
                ">            
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
                width: 100%; ">
              <tr>
                <td>&nbsp;</td>
                <td class="container" style="display: block;
                margin: 0 auto !important;
                /* makes it centered */
                max-width: 580px;
                padding: 10px;
                width: 580px; 
                text-align: justify;">
                  <div class="content" style="box-sizing: border-box;  display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
        
                    <!-- START CENTERED WHITE CONTAINER -->
                    <table role="presentation" class="main" style=" background: #ffffff; border-radius: 3px; width: 100%;">
                    <tr>
                      <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                        <img src="https://calidadsnu.com/snu/Assets/img/uploads/colegio/' . $_SESSION['datos_cliente']->filename . '" width="165" alt="Logo" style="width:80%;max-width:165px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                      </td>
                    </tr>                    
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                        <td class="wrapper" style="box-sizing: border-box; padding: 20px;">
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>
                                <p style="text-align: justify; color:gray">Señor@ <br>' . ucwords($pqrs->nombres . ' ' . $pqrs->apellidos) . '</p>
                                
                                <p style="text-align: justify; color:gray">Para nosotros fue muy importante la solicitud radicada con <strong>N°' . $pqrs->radicado . '</strong><br> en la fecha ' . $pqrs->fecha_registro . ' deseamos comunicarte por este medio que la respuesta a tu solicitud es la siguiente:<br>' . $respuesta->respuesta . '<br>Si la respuesta entregada satisface tu solicitud</p>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                  <tbody>
                                    <tr>
                                      <td align="left">
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate;
                                            mso-table-lspace: 0pt;
                                            mso-table-rspace: 0pt;
                                            width: 100%; ">
                                          <tbody>
                                            <tr>
                                              <td> <a href="https://calidadsnu.com/snu/Contacto/cliente/index.php?pqrs=' . $_REQUEST['id'] . '&resp=' . $respuesta->id . '" target="_blank" style="background-color: #ffffff;
                                            border: solid 1px #3498db;
                                            border-radius: 5px;
                                            box-sizing: border-box;
                                            color: #3498db;
                                            cursor: pointer;
                                            display: inline-block;
                                            font-size: 14px;
                                            font-weight: bold;
                                            margin: 0;
                                            padding: 12px 25px;
                                            text-decoration: none;
                                            text-transform: capitalize;">CLIC AQUI</a> </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>                                
                                <p  style="color:gray">Que tengas un grandioso día</p>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>        
                    <!-- END MAIN CONTENT AREA -->
                    </table>
                    <!-- END CENTERED WHITE CONTAINER -->
        
                    <!-- START FOOTER -->
                 <center><div class="footer" style="  padding-top: 10px;  color: #999999; font-size: 12px;" >
                      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="" style="text-align: center;">
                            <span class="apple-link">Calidadsg, calle 20 27 49, el recreo palmira, Valle del Cauca</span>
                            <br>  
                          </td>
                        </tr>
                        <tr>
                       <td class="content-block powered-by" style=" padding-bottom: 10px; padding-top: 10px;  color: #999999; font-size: 12px; text-align: center;">
                            Powered by <a href="www.calidadsg.com" style="padding-bottom: 10px; padding-top: 10px;  color: #00000;font-size: 12px; text-align: center;">calidadsg.com</a>.
                          </td>
                        </tr>
                      </table>
                    </div>
                  </center>
                    <!-- END FOOTER -->
                  </div>
                </td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </body>
        </html>';
    $this->model->CerrarPqrd($_REQUEST['id']);
    $respuestas = new Respuesta();
    $respuestas->CerrarRespuesta($respuesta->id);
    $email = new NotificacionesController();
    $directorio = "Assets/SoportesPqrs/" . $_REQUEST['id'] . "/"; // Reemplaza 'ruta_de_la_carpeta' con la ruta de la carpeta que quieres inspeccionar
    $msn = "";
    $file = "";
    // Obtén una lista de archivos y directorios dentro de la carpeta
    if (is_dir($directorio)) {
      $archivos = scandir($directorio);
      // Imprime los nombres de los archivos con enlaces
      foreach ($archivos as $archivo) {
        if ($archivo != '.' && $archivo != '..') {
          $file = $directorio . $archivo;
          $nombreDoc = explode('/', $file);
          $name = $nombreDoc[count($nombreDoc) - 1];
          $msn = 'El archivo adjunto se envio ' . $name;
        }
      }
    }
    try {
      if ($email->Notificar($asunto, $cuerpo, $destinatario, $file)) {
        echo '<div class="text-center">Mensaje fue enviado ' . $msn . '</div>';
      }
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {}";
    }
  }

  public function NotificarAsignacion($email)
  {
    $pqrs = new Pqrsf();
    $pqrs = $this->model->Obtener($_REQUEST['id']);
    /**
     * TODO: enviar correo, Notifica al funcionario cual fue la asignacion
     *Se recibe el id de la solictud, se consultan los datos del usuario y solicitud*/

    $destinatario = $email;
    $asunto = "Le fue asiganada una solicitud";
    $cuerpo = '<!doctype html>
        <html>
          <head>
            <meta name="viewport" content="width=device-width" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Transactional Email</title>
         </head>
          <body class="" style="background-color: #f6f6f6;
                font-family: sans-serif;
                -webkit-font-smoothing: antialiased;
                font-size: 14px;
                line-height: 1.4;
                margin: 0;
                padding: 0;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
                text-align: justyfi;
                text-coloyr: black;
                ">            
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
                width: 100%; ">
              <tr>
                <td>&nbsp;</td>
                <td class="container" style="display: block;
                margin: 0 auto !important;
                /* makes it centered */
                max-width: 580px;
                padding: 10px;
                width: 580px; 
                text-align: justify;">
                  <div class="content" style="box-sizing: border-box;  display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
         <!-- START CENTERED WHITE CONTAINER -->
                    <table role="presentation" class="main" style=" background: #ffffff; border-radius: 3px; width: 100%;">
        
                    <tr>
                      <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                        <img src="https://calidadsnu.com/snu/Assets/img/uploads/colegio/' . $_SESSION['datos_cliente']->filename . '" width="165" alt="Logo" style="width:80%;max-width:165px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                      </td>
                    </tr>                    
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                        <td class="wrapper" style="box-sizing: border-box; padding: 20px;">
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>
                            <p style="text-align: justify; color:gray">Señor@ <br>' . ucwords($pqrs->responsable) . '</p>
                               <p style="text-align: justify; color:gray">
                               Hemos recibido a travez  de nuestra plataforma de PQRSF una solictud la cual le fue asignada para dar respuesta.<BR>
                               Los datos de la solicitud son los siguientes:
                               <ul>
                                    <li>TIPO DE SOLICITUD: ' . ucwords($pqrs->tipo_peticion) . '</li>
                                    <li>SOLICITANTE: ' . ucwords($pqrs->nombres . ' ' . $pqrs->apellidos) . '</li>
                                    <li>IDENTIFICACION: ' . $pqrs->identificacion . '</li>
                                    <li>CORREO: ' . $pqrs->email . '</li>
                                    <li>NO.CONTACTO: ' . $pqrs->n_contacto . '</li>
                                    <li> DESCRIPCION: ' . $pqrs->descripcion . '</li>
                                    <li> FECHA DE REGISTRO: ' . $pqrs->fecha_registro . '</li>
                                    <li>N° RADICADO: ' . $pqrs->radicado . '</li>
                                </ul>
                                     <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                  <tbody>
                                    <tr>
                                      <td align="left">                                        
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>                                
                                <p  style="color:gray">Que tenga un grandioso día</p>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>        
                    <!-- END MAIN CONTENT AREA -->
                    </table>
                    <!-- END CENTERED WHITE CONTAINER -->
        
                    <!-- START FOOTER -->
                 <center><div class="footer" style="  padding-top: 10px;  color: #999999; font-size: 12px;" >
                      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="" style="text-align: center;">
                            <span class="apple-link">Calidadsg, calle 20 27 49, el recreo palmira, Valle del Cauca</span>
                            <br>  
                          </td>
                        </tr>
                        <tr>
                       <td class="content-block powered-by" style=" padding-bottom: 10px; padding-top: 10px;  color: #999999; font-size: 12px; text-align: center;">
                            Powered by <a href="www.calidadsg.com" style="padding-bottom: 10px; padding-top: 10px;  color: #00000;font-size: 12px; text-align: center;">calidadsg.com</a>.
                          </td>
                        </tr>
                      </table>
                    </div>
                  </center>
                    <!-- END FOOTER -->
                  </div>
                </td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </body>
        </html>';
    $email = new NotificacionesController();
    try {
      if ($email->Notificar($asunto, $cuerpo, $destinatario)) {
        echo 'Mensaje fue enviado';
      }
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {}";
    }
  }


  function guidv4($data = null)
  {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);
    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
  }

  public function Eliminar()
  {
    $this->model->Eliminar($_REQUEST['id']);
    header('Location: index.php');
  }


  /**SEGMENTOS*/
  public function Segmento()
  {
    $versegmento = new Pqrsf();
    if (isset($_REQUEST['id'])) {
      $versegmento = $this->model->VerSegmento($_REQUEST['id']);
    }
    $segmento = $this->model->ObtenerSegmento();
    require_once 'Views/Layout/pqrs.php';
    require_once 'Views/Pqrsf/segmentos.php';
    require_once 'Views/Layout/foot.php';
  }

  public function RegistrarSegmento()
  {
    if ($_REQUEST['id'] > 0) {
      $this->model->EditarSegmento($_REQUEST['segmento'], $_REQUEST['id']);
    } else {
      if ($this->model->RegistrarSegmento($_REQUEST['segmento']))
        echo 'ok';
      else
        echo "error";
    }
  }
  public function QuitarSegmento()
  {
    $this->model->QuitarSegmento($_REQUEST['id']);
  }

  /**FIN SEGMENTOS */



  /** inicio reportes */

  public function Export()
  {
    $spreadsheet = new Spreadsheet();
    $spreadsheet->getProperties()->setCreator("Snu")
      ->setLastModifiedBy('Snu')
      ->setTitle('Archivo generado desde Snu')
      ->setDescription('Reporte de PQRSF exportados desde Snu');

    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle("Pqrsf");
    $encabezado = ["id", "pqrs_id", "proceso_id", "accion",  "solicitud", "respuesta", "clasificacion_id", "estado", "soporte", "fecha", "usuario"];
    $sheet->fromArray($encabezado, null, 'A1');

    $data = $this->model->ReportePqrsf();
    $numeroDeFila = 2;
    foreach ($data as $pqrs) {
      $id = $pqrs->id;
      $pqrs_id = $pqrs->pqrs_id;
      $proceso_id = $pqrs->proceso_id;
      $accion = $pqrs->accion;
      $solicitud = $pqrs->solicitud;
      $respuesta = $pqrs->respuesta;
      $clasificacion_id = $pqrs->clasificacion_id;
      $estado = $pqrs->estado;
      $soporte = $pqrs->soporte;
      $fecha = $pqrs->fecha;
      $usuario = $pqrs->usuario;

      $sheet->setCellValue('A' . $numeroDeFila, $id);
      $sheet->setCellValue('B' . $numeroDeFila, $pqrs_id);
      $sheet->setCellValue('C' . $numeroDeFila, $proceso_id);
      $sheet->setCellValue('D' . $numeroDeFila, $accion);
      $sheet->setCellValue('E' . $numeroDeFila, $solicitud);
      $sheet->setCellValue('F' . $numeroDeFila, $respuesta);
      $sheet->setCellValue('G' . $numeroDeFila, $clasificacion_id);
      $sheet->setCellValue('H' . $numeroDeFila, $estado);
      $sheet->setCellValue('I' . $numeroDeFila, $soporte);
      $sheet->setCellValue('J' . $numeroDeFila, $fecha);
      $sheet->setCellValue('K' . $numeroDeFila, $usuario);
      $numeroDeFila++;
    }
    $writer = new Xlsx($spreadsheet);
    $writer->save('ReportePqrs' . date('Y-m-d') . '.xlsx');

    // Redireccionamos para que descargue el archivo generado
    header("Location: ReportePqrs" . date('Y-m-d') . ".xlsx");
  }
  public function Reportepqrsf()
  {

    // print_r($this->model->ReportePqrsf());
    require_once 'Views/Layout/pqrs.php';
    require_once 'Views/Pqrsf/reportepqrsf.php';
    // Determinar la acción a realizar según el parámetro 'export' en la solicitud POST

    if (isset($_REQUEST['export'])) {
      // Acción de exportación
      $ctr_pqrs = new PqrsfController();
      $ctr_pqrs->Export();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Verificar si se ha enviado el formulario
      if (isset($_FILES['excel_file'])) {
        // Obtener la ruta temporal del archivo subido
        $file = $_FILES['excel_file']['tmp_name'];
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $result = [];
        foreach ($sheet->getRowIterator() as $row) {
          // Obtener los datos de las celdas
          $cellIterator = $row->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(false);
          // Obtener los valores de las celdas
          $data = [];
          foreach ($cellIterator as $cell) {
            $data[] = $cell->getValue();
          }
          $result =  $this->model->UpdateDataFromExcel($data);
        }
        print_r($result);
      }
    }
    require_once 'Views/Layout/foot.php';
  }
  public function Soporte()
  {
    $pqr = $this->model->Obtener($_REQUEST['id']);
    require_once 'Views/Pqrsf/soporte.php';
  }
  public function GuardarSoporte()
  {
    // print_r($_FILES["soporte"]);
    $destinationFolder = "Assets/SoportesPqrs/" . $_REQUEST['id_pqrsf'] . "/";
    $fileType = $_FILES["soporte"]["type"];
    $allowedFormats = array('image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    $maxFileSize = 5242880; // Tamaño máximo permitido en bytes
    $uploadOk = 1;
    // Comprobamos si el archivo es una imagen y si no excede el tamaño máximo
    if ($_FILES["soporte"]["size"] > $maxFileSize) {
      echo "El archivo es demasiado grande, valida que sea menor de 5 megabytes";
      $uploadOk = 0;
    }

    if (!is_dir($destinationFolder)) {
      // Si el directorio de destino no existe, se crea
      mkdir($destinationFolder, 0777, true);
    }

    // Permitir ciertos formatos de archivo
    if (!in_array($fileType, $allowedFormats)) {
      echo "Solo se permiten archivos de tipo JPG, JPEG, PNG, PDF , WORD Y EXCEL.";
      $uploadOk = 0;
    }

    if ($uploadOk == 0) {
      echo "Lo sentimos, tu archivo no fue cargado.";
    } else {
      $originalName = $_FILES["soporte"]["name"];
      $fileExtension = pathinfo($originalName, PATHINFO_EXTENSION);
      $newFileName = $_REQUEST['nombre'] . '.' . $fileExtension;
      $uploadDirectory = $destinationFolder . $newFileName;
      if (move_uploaded_file($_FILES["soporte"]["tmp_name"], $uploadDirectory)) {
        echo "El archivo " . htmlspecialchars(basename($_FILES["soporte"]["name"])) . " ha sido subido.";
      } else {
        echo "Lo sentimos, hubo un error al cargar tu archivo.";
      }
    }
  }
  public function QuitarDocumento()
  {
    if (isset($_REQUEST['archivo'])) {
      $archivo = $_REQUEST['archivo'];
      if (file_exists($archivo)) {
        unlink($archivo);
        echo "El archivo $archivo se ha eliminado correctamente.";
      } else {
        echo "El archivo $archivo no existe.";
      }
    } else {
      echo "No se proporcionó el nombre del archivo para eliminar.";
    }
  }


  /**REGISTRO */

  public function RegistrarPqrsf()
  {
    require_once 'Views/Layout/pqrs.php';
    require_once 'Views/Pqrsf/registrarpqrsf.php';
    require_once 'Views/Layout/foot.php';
  }


  public function AddPqrs()
  {
    date_default_timezone_set('America/Bogota');

    $alm = new Pqrsf();

    $rand = range(1, 10000);
    shuffle($rand);
    $randValue = $rand[0];
    $alm->url = $_SESSION['datos_cliente']->id;
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
    $resultado = $this->model->Registrar($alm);

    if ($resultado) {
      echo "Solicitud Registrada con radicado: " . $alm->radicado;
    } else {
      echo "Ocurrió un error inesperado, inténtalo de nuevo";
    }
  }
}
