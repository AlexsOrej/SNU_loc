<?php
require_once 'Models/Solicitud.php';
require_once 'Models/Proceso.php';
require_once 'Models/Usuario.php';
require_once 'Models/Documento.php';
require_once 'Models/Formato.php';
require_once 'Models/Doc_ext.php';
require_once 'Models/Permiso.php';
require_once 'Models/Onlinedoc.php';
require_once 'Controllers/notificaciones.Controller.php';
require_once 'Models/Notificacion.php';
require_once 'Models/Model.php';


class SolicitudesController
{
  private $pdo;
  public $id;
  public $NombreSolicitante;
  public $FechaSolicitud;
  public $Proceso;
  public $TipoSolicitud;
  public $Codigo;
  public $VersionCambiar;
  public $TipoDocumento;
  public $EjecucionCambio;
  public $Aprobado;
  public $Actualizacion;
  public $filename;
  public $dir;
  public $model;
  public $correo;
  public $usuario;
  public $proceso;

  public function __CONSTRUCT()
  {
    $this->model = new Solicitud();
    $this->correo = new Notificacion();
    $this->usuario = new Usuario();
    $this->proceso = new Proceso(); 
    $model = new Model();
    $model->ModelSolicitud();
    $model = new Model();
    $model->CreateTable('doc_online');
    $model->ModelDocOnline('doc_online');
    $model->TblHistorialSolicitudes();
    
  }

  public function Index()
  {
    $seguridad = new Permiso();
    $modulo = 'solicitudes';
    $tipo = $_SESSION['rol_id'];
    $val = $seguridad->Validar($modulo, $tipo);
    $solicitud = new Solicitud();
    $solicitudes = $solicitud->Solicitudes();
    $online = new Onlinedoc();
    require_once 'Views/Layout/default.php';
    require_once 'Views/Solicitudes/index.php';
    require_once 'Views/Layout/foot.php';
    require_once 'Views/Layout/filtro.php';
  }

  public function Add()
  {

    $seguridad = new Permiso();
    $modulo = 'solicitudes';
    $tipo = $_SESSION['rol_id'];
    $val = $seguridad->Validar($modulo, $tipo);
    $proceso = new Proceso();
    $procesos = $proceso->getProceso();
    $ultima_solicitud = $this->model->SolicitudesMax();
    require_once 'Views/Layout/default.php';
    $val->crear == 1  ? require_once 'Views/Solicitudes/add.php' : require_once 'Views/Seguridad/error.php';
    require_once 'Views/Layout/footer.php';
  }
  public function Add1()
  {

    $seguridad = new Permiso();
    $modulo = 'solicitudes';
    $tipo = $_SESSION['rol_id'];
    $val = $seguridad->Validar($modulo, $tipo);
    $proceso = new Proceso();
    $procesos = $proceso->getProceso();
    $ultima_solicitud = $this->model->SolicitudesMax();
    require_once 'Views/Layout/default.php';
    $val->crear == 1  ? require_once 'Views/Solicitudes/add1.php' : require_once 'Views/Seguridad/error.php';
    require_once 'Views/Layout/footer.php';
  }
  public function online()
  {
    $seguridad = new Permiso();
    $modulo = 'solicitudes';
    $tipo = $_SESSION['rol_id'];
    $val = $seguridad->Validar($modulo, $tipo);
    $proceso = new Proceso();
    $procesos = $proceso->getProceso0();
    $ultima_solicitud = $this->model->SolicitudesMax();
    require_once 'Views/Layout/default.php';
    require_once 'Views/Solicitudes/online.php';
    require_once 'Views/Layout/footer.php';
  }
  public function Modo()
  {
    require_once 'Views/Solicitudes/modo.php';
  }

  public function Editarsolicitud()
  {
    $solicitudes =  $this->model->GetSolicitud($_REQUEST['id']);
    $seguridad = new Permiso();
    $modulo = 'solicitudes';
    $tipo = $_SESSION['rol_id'];
    $val = $seguridad->Validar($modulo, $tipo);
    require_once 'Views/Layout/default.php';
    $val->crear == 1  ? require_once 'Views/Solicitudes/edit.php' : require_once 'Views/Seguridad/error.php';
    require_once 'Views/Layout/footer.php';
  }

  public function Registrar()
  {
    $solicitud = new Solicitud();
    @$solicitud->id = $_REQUEST['id'];
    $solicitud->NombreSolicitante = $_REQUEST['NombreSolicitante'];
    $solicitud->FechaSolicitud = $_REQUEST['FechaSolicitud'];
    $solicitud->Proceso = $_REQUEST['Proceso'];
    $solicitud->TipoSolicitud = $_REQUEST['TipoSolicitud'];
    $solicitud->Codigo = $_REQUEST['Codigo'];
    @$solicitud->VersionCambiar = $_REQUEST['VersionCambiar'];
    $solicitud->TipoDocumento = $_REQUEST['TipoDocumento'];
    @$solicitud->EjecucionCambio = $_REQUEST['EjecucionCambio'];
    @$solicitud->Aprobado = $_REQUEST['Aprobado'];
    @$solicitud->Observaciones = $_REQUEST['Observaciones'];
    $solicitud->Descripcion = $_REQUEST['Descripcion'];
    @$solicitud->filename = $_FILES['filename']['name'];
    $solicitud->dir = 'Assets/Solicitudes/' . $_SESSION['datos_cliente']->nombre . '/';
    $solicitud->id > 0 ?
      $this->model->Actualizar($solicitud) :
      $this->model->Registrar($solicitud);
    $documento = new Documento();
    $solicitud->id > 0 ? '' : $documentos = $documento->SubirDoc();

    $remitente = new Notificacion();
    $remitentes = $remitente->Index();
    $mail = array();
    foreach ($remitentes as  $value) {
      if ($value->modulo_id == 1) {
        $mail[] = $value->email;
      }
    };
    $destinatario = 'firmacalidadpublicitario@gmail.com';
    //$destinatario = $mail[0];
    $asunto = "Fue registrada una solicitud";
    $cuerpo = '<!doctype html>
            <html>
              <head>
                <meta name="viewport" content="width=device-width" />
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>CALIDADSNU</title>
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
                            <img src="https://calidadsnu.com/snu/Assets/img/uploads/colegio/' . $_SESSION["datos_cliente"]->filename . '" width="165" alt="Logo" style="width:80%;max-width:165px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                          </td>
                        </tr>                    
                          <!-- START MAIN CONTENT AREA -->
                          <tr>
                            <td class="wrapper" style="box-sizing: border-box; padding: 20px;">
                              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td>
                                <p style="text-align: justify; color:gray">Señor@ <br>' . ucwords($_REQUEST['NombreSolicitante']) . '</p>
                                   <p style="text-align: justify; color:gray">
                                   Hemos recibido a travez  de nuestra plataforma una solictud de ' . $solicitud->TipoSolicitud . ' con los siguientes datos:<BR>
                                    <ul>
                                        <li>TIPO DE SOLICITUD: ' . ucwords($solicitud->TipoSolicitud) . '</li>
                                        <li>SOLICITANTE: ' . ucwords($_REQUEST['NombreSolicitante']) . '</li>
                                        <li>TIPO INFORMACIÓN: ' . $solicitud->TipoDocumento . '</li>
                                    </ul>
                                      <p><center><h3>Descripción de la solicitud</h3></center> 
                                     ' . $solicitud->Descripcion = $_REQUEST['Descripcion'] . '</p>
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

  public function Registrar1()
  {
    $solicitud = new Solicitud();
    @$solicitud->id = $_REQUEST['id'];
    $solicitud->NombreSolicitante = $_REQUEST['NombreSolicitante'];
    $solicitud->FechaSolicitud = $_REQUEST['FechaSolicitud'];
    $solicitud->Proceso = $_REQUEST['Proceso'];
    $solicitud->TipoSolicitud = $_REQUEST['TipoSolicitud'];
    $solicitud->Codigo = $_REQUEST['Codigo'];
    @$solicitud->VersionCambiar = $_REQUEST['VersionCambiar'];
    $solicitud->TipoDocumento = $_REQUEST['TipoDocumento'];
    @$solicitud->EjecucionCambio = $_REQUEST['EjecucionCambio'];
    @$solicitud->Aprobado = $_REQUEST['Aprobado'];
    @$solicitud->Observaciones = $_REQUEST['Observaciones'];
    $solicitud->Descripcion = $_REQUEST['Descripcion'];

    @$solicitud->modos = $_REQUEST['modos'];
    @$solicitud->modostipo = $_REQUEST['modostipo'];

    @$solicitud->filename = $_FILES['filename']['name'];
    $solicitud->dir = 'Assets/Solicitudes/' . $_SESSION['datos_cliente']->nombre . '/';

    $solicitud->id > 0 ?
      $this->model->Actualizar($solicitud) :
      $this->model->Registrar($solicitud);
    $documento = new Documento();
    $solicitud->id > 0 ? '' : $documentos = $documento->SubirDoc();
  }



  public function Registrar0()
  {

    // print_r($_REQUEST);
    $solicitud = new Solicitud();
    @$solicitud->id = $_REQUEST['id'];
    $solicitud->NombreSolicitante = $_REQUEST['NombreSolicitante'];
    $solicitud->FechaSolicitud = $_REQUEST['FechaSolicitud'];
    $solicitud->Proceso = $_REQUEST['Proceso'];
    $solicitud->TipoSolicitud = $_REQUEST['TipoSolicitud'];

    $solicitud->TipoSolicitud == 'creacion' ?
      $solicitud->Codigo = 'Automatico' :
      $solicitud->Codigo = $_REQUEST['Codigo'];

    $solicitud->TipoSolicitud == 'eliminacion' ?
      $solicitud->Codigo = $_REQUEST['cod'] : '';

    $solicitud->TipoSolicitud == 'actualizacion' and $solicitud->TipoSolicitud == 'formato'  ?
      $solicitud->Codigo = 'Automatico' :
      $solicitud->Codigo = $_REQUEST['cod'];

    @$solicitud->VersionCambiar = $_REQUEST['VersionCambiar'];
    $solicitud->TipoDocumento = $_REQUEST['TipoDocumento'];
    @$solicitud->EjecucionCambio = $_REQUEST['EjecucionCambio'];
    @$solicitud->Aprobado = $_REQUEST['Aprobado'];
    @$solicitud->Observaciones = $_REQUEST['Observaciones'];
    $solicitud->Descripcion = $_REQUEST['Descripcion'];
    $solicitud->modos = $_REQUEST['modoSolicitud'];
    @$solicitud->modostipo = $_REQUEST['modostipo'];

    if ($_REQUEST['modoSolicitud'] == 'local' and isset($_FILES['filename']['name'])) {
      $solicitud->filename = $_FILES['filename']['name'];
      $solicitud->dir = 'Assets/Solicitudes/' . $_SESSION['datos_cliente']->nombre . '/';
      $documento = new Documento();
      $documentos = $documento->SubirDoc();
    }

    $solicitud->id > 0 ?
      $this->model->Actualizar($solicitud) :
      $this->model->Registrar($solicitud);

    if ($_REQUEST['modoSolicitud'] == 'online') {
      $doc_online = new Onlinedoc();
      $doc_online->contenido = $_REQUEST['contenido01'];
      $doc_online->editor = $_REQUEST['NombreSolicitante'];
      $doc_online->fecha_creacion = $_REQUEST['FechaSolicitud'];
      $doc_online->solicitud_id = $_REQUEST['solicitud_id'];
      $doc_online->estado = 0;
      $doc_online->Registrar($doc_online);
    }

    //NOTIFICACION
    $remitente = new Notificacion();
    $remitentes = $remitente->Index();
    $email = new NotificacionesController();
    $solicitud->Proceso;
    $persona = $remitente->NotificacionAsignado('["registro"]', $solicitud->Proceso);
    $asunto = "Ha sido registrada una solicitud para {$solicitud->TipoSolicitud} de un {$solicitud->TipoDocumento}";
    $cuerpo = '<!doctype html>
           <html>
             <head>
               <meta name="viewport" content="width=device-width" />
               <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
               <title>CALIDADSNU</title>
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
                           <img src="https://calidadsnu.com/snu/Assets/img/uploads/colegio/' . $_SESSION["datos_cliente"]->filename . '" width="165" alt="Logo" style="width:80%;max-width:165px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                         </td>
                       </tr>                    
                         <!-- START MAIN CONTENT AREA -->
                         <tr>
                           <td class="wrapper" style="box-sizing: border-box; padding: 20px;">
                             <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                               <tr>
                                 <td>                              
                                  <p style="text-align: justify; color:gray">
                                 Ha sido registrada una solicitud para ' . $solicitud->TipoSolicitud . ' de un ' . $solicitud->TipoDocumento . ' del proceso ' . $solicitud->Proceso . ' por realizado por ' . $solicitud->NombreSolicitante . '
                                  <p>                                     
                                 <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                     <tbody>
                                       <tr>
                                         <td align="left">                                        
                                         </td>
                                       </tr>
                                     </tbody>
                                   </table>                                
                                   <p  style="color:gray"><strong>Que tenga un grandioso día</strong></p>
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

    print_r($persona);
    foreach ($persona as  $value) {
      $destinatario = $value->email;
      try {
        if ($email->Notificar($asunto, $cuerpo, $destinatario)) {
          echo 'Mensaje fue enviado';
        }
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {}";
      }
    };
    echo '
   <script>
   alert("La solicitud fue registrada y notificada con exito");
     window.location = "?c=solicitudes&a=index"; 
   </script>';
  }

  public function Versolicitud()
  {
    $solicitudes =  $this->model->GetSolicitud($_REQUEST['id']);
    require_once 'Views/Layout/default.php';
    require_once 'Views/Solicitudes/view.php';
    require_once 'Views/Layout/foot.php';
  }

  public function View()
  {
    $solicitudes =  $this->model->GetSolicitud($_REQUEST['id']);
    $historial =  $this->model->GetHistorial($_REQUEST['id']);
    require_once 'Views/Solicitudes/view.php';
  }

  public function Descripcion()
  {
    $TipoDocumento = $_REQUEST['TipoDocumento'];
    $proceso = $_REQUEST['Proceso'];
    $TipoSolicitud = $_REQUEST['TipoSolicitud'];
    $this->model->Descripcion($TipoDocumento, $proceso, $TipoSolicitud);
  }

  public function DescripcionLine()
  {
    $TipoDocumento = $_REQUEST['TipoDocumento'];
    $proceso = $_REQUEST['Proceso'];
    $TipoSolicitud = $_REQUEST['TipoSolicitud'];
    $modoSolicitud = $_REQUEST['modoSolicitud'];
    $info = "";
    switch ($TipoSolicitud) {
      case 'creacion':
        require_once 'Views/Solicitudes/datos_solicitud.php';
        break;
      case 'actualizacion':
      case 'eliminacion':
        $info = $this->model->GetInfo($proceso, $TipoDocumento);
        require_once 'Views/Solicitudes/datos_solicitud.php';
        # code...
        break;
      default:
        # code...
        break;
    }
  }

  public function InfoDoc()
  {
    $documento = new Documento();
    $doc = $documento->getDocCod($_REQUEST['id']);
    $getdoc = $this->model->GetDocInfoOnline($_REQUEST['id']);
    require_once 'Views/Solicitudes/updateonline.php';
  }

  public function Responder()
  {
    $seguridad = new Permiso();
    $onlinedoc = new Onlinedoc();
    $onlinedocs = $onlinedoc->GetOnline($_REQUEST['id']);
    $solicitud =  $this->model->GetSolicitud($_REQUEST['id']);
    $asignados = $this->model->getAsignadosProceso($solicitud->Proceso, $_SESSION['user']->user_id);
    $sol = $solicitud->TipoSolicitud;
    $TipoDocumento = $solicitud->TipoDocumento;
    $tabla = $solicitud->TipoDocumento . 's';
    $tabla == "externos" ? $tabla = "sgcexternos" : '';
    $pre = $this->model->GetRespuesta($solicitud->Proceso, $tabla);
    $documento = new Documento();
    $formato = new Formato();
    $ext = new Doc_ext();
    $docProceso = $documento->getDocProceso($solicitud->Proceso);
    require_once 'Views/Layout/default.php';
    require_once 'Views/Solicitudes/responder.php';

    $colaboradorIds = array(); // Inicializa un array vacío

    foreach ($asignados as $asignado) {
      $colaboradorIds[] = $asignado->colaborador_id;
    }
    // Imprime el array para verificar los valores
    // echo '<pre>';
    // print_r($colaboradorIds);
    // print_r($_SESSION['user']->user_id);
    // echo '</pre>';

    if ($asignados && in_array($_SESSION['user']->user_id, $colaboradorIds) or ($_SESSION['user']->rol_id==1)) {
      /*creaciones*/
      if ($sol == "creacion" & $TipoDocumento == "documento") {
        $documentos = $documento->getDocumentos($solicitud->Proceso);
        $separada = explode("-", $documentos->ultimo);
        require_once 'Views/Solicitudes/creardoc.php';
      }

      if ($sol == "creacion" & $TipoDocumento == "formato") {
        $formatos = $formato->getFormato($solicitud->Proceso);
        $separada = explode("-", $formatos->ultimo);
        require_once 'Views/Solicitudes/crearformato.php';
      }

      if ($sol == "creacion" & $TipoDocumento == "externo") {
        $documentos = $ext->getDocumentos($solicitud->Proceso);
        $separada = explode("-", $documentos->ultimo);
        require_once 'Views/Solicitudes/crearext.php';
      }
      /*creaciones*/

      /*actualizaciones*/
      if ($sol == "actualizacion" & $TipoDocumento == "documento") {
        $docCodigo = $documento->getDocCod($solicitud->Codigo);
        require_once 'Views/Solicitudes/actdoc.php';
      }

      if ($sol == "actualizacion" & $TipoDocumento == "externo") {
        $docCodigo = $ext->getDocCod($solicitud->Codigo);
        require_once 'Views/Solicitudes/actdocext.php';
      }
      if ($sol == "actualizacion" & $TipoDocumento == "formato") {
        $documentos = $formato->getForCod($solicitud->Codigo);
        require_once 'Views/Solicitudes/actformato.php';
      }
      /*actualizaciones*/
      /*eliminacion*/
      if ($sol == "eliminacion" & $TipoDocumento == "documento") {
        $docCodigo = $documento->getDocCod($solicitud->Codigo);
        require_once 'Views/Solicitudes/actdoc.php';
      }

      if ($sol == "eliminacion" & $TipoDocumento == "externo") {
        $docCodigo = $ext->getDocCod($solicitud->Codigo);
        require_once 'Views/Solicitudes/actdocext.php';
      }
      if ($sol == "eliminacion" & $TipoDocumento == "formato") {
        $documentos = $formato->getForCod($solicitud->Codigo);
        require_once 'Views/Solicitudes/actformato.php';
      }
    } else {
      echo "
      <div  class='card'>
      <div class='header text-center'><h3>No tiene permiso o No se ha asignado colaboradores para responder las solicitudes de {$solicitud->Proceso} </h3></div>
      </div>";
    }
    /*eliminacion*/
    require_once 'Views/Layout/footer.php';
  }


  public function GestionDocumento()
  {
    $documento = new Documento();
    @$documento->id = $_REQUEST['id'];
    $_REQUEST['TipoSolicitud'] == 'eliminacion' ? $proceso = 'po' : $proceso = $_REQUEST['Proceso'];

    $documento->CodDocumento = $_REQUEST['CodDocumento'];
    $documento->Proceso = $proceso;
    $documento->NomDocumento = $_REQUEST['NomDocumento'];
    $documento->VersionCambiar = $_REQUEST['Version'];
    $documento->proteccion = $_REQUEST['proteccion'];
    $documento->Almacenamiento = $_REQUEST['Almacenamiento'];
    $documento->preservacion = $_REQUEST['preservacion'];
    $documento->Emision = $_REQUEST['Emision'];
    $documento->Version = $_REQUEST['Version'];

    isset($_FILES['filename']['name']) ?
      $documento->filename = $_FILES['filename']['name'] : $documento->filename = 'online';
    $documento->dir = $_REQUEST['dir'];

    /*fin datos documento*/
    $solictud = new Solicitud();
    $solictud->id = $_REQUEST['sol_id'];
    $solictud->EjecucionCambio = $_REQUEST['EjecucionCambio'];
    $solictud->Codigo = $_REQUEST['CodDocumento'];
    $TipoSolicitud = $_REQUEST['TipoSolicitud'];
    $solictud->VersionCambiar = $_REQUEST['Version'];
    $solictud->Observaciones = $_REQUEST['Observaciones'];
    $solictud->Aprobado = $_REQUEST['Aprobado']; //estado
    $solictud->usuario_id = $_SESSION['user']->user_id; 
    $disponibilidad = "";
    $this->model->ActualizaGestion($solictud);
    $estado = '';
    if ($solictud->Aprobado == 'si') {
      if ($documento->id > 0) {
        $documento->Actualizacion = $_REQUEST['Actualizacion'];
        $documentos = $documento->Actualizar($documento);
      } else {
        $documentos = $documento->Registrar($documento);
      }
      $documento->filename != 'online' ? $documento->SubirDoc() : '';
      $disponibilidad = $solictud->EjecucionCambio;
      $estado = '["respuesta"]';
      $this->model->HistorialSolicitud($solictud);
    }


    if ($solictud->Aprobado == 're') {
      $disponibilidad = 'La solicitud esta en revisión';
      $estado = '["revision"]';
      $this->model->HistorialSolicitud($solictud);
    }

    if ($solictud->Aprobado == 'no') {
      $disponibilidad = 'La solicitud fue denegada';
      $this->model->HistorialSolicitud($solictud);
    }

    //NOTIFICACION
    $remitente = new Notificacion();
    $remitentes = $remitente->Index();
    $persona = $remitente->NotificacionAsignado($estado, $documento->Proceso);
    //print_r(json_encode(['notificaciones'=>$persona]));die('');
    //print_r($estado.'hola');die('');

    $asunto = "Se dio respuesta a una solicitud";
    $cuerpo = '<!doctype html>
            <html>
              <head>
                <meta name="viewport" content="width=device-width" />
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>CALIDADSNU</title>
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
                            <img src="https://calidadsnu.com/snu/Assets/img/uploads/colegio/' . $_SESSION["datos_cliente"]->filename . '" width="165" alt="Logo" style="width:80%;max-width:165px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                          </td>
                        </tr>                    
                          <!-- START MAIN CONTENT AREA -->
                          <tr>
                            <td class="wrapper" style="box-sizing: border-box; padding: 20px;">
                              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td>                              
                                   <p style="text-align: justify; color:gray">
                                   Hemos recibido a travez de nuestra plataforma la respuesta a la solicitud de ' . $TipoSolicitud . ' Número ' . $solictud->id .
      '<br> con el siguiente resultado<br>
                                  <strong>Estado: </strong>' . ucwords($solictud->Aprobado) . ':<br>
                                  <strong>Observación: </strong>' . $solictud->Observaciones . '<br>
                                  <strong>Código:</strong> ' . $_REQUEST["CodDocumento"] . '<br>
                                  <strong>Proceso:</strong> ' . $documento->Proceso . '<br>
                                  <strong>Nombre:</strong> ' . $documento->NomDocumento . '<br>
                                  Que estara disponible desde: ' .  $disponibilidad . '<br>
                                  <a href="https://calidadsnu.com/snu/' . $documento->dir . '' . $documento->CodDocumento . '.pdf">Ver Documento</a>
                                  <p>                                     
                                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                      <tbody>
                                        <tr>
                                          <td align="left">                                        
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>                                
                                    <p  style="color:gray">Que tengan un grandioso día</p>
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
    foreach ($persona as  $value) {
      $destinatario = $value->email;
      try {
        if ($email->Notificar($asunto, $cuerpo, $destinatario)) {
          echo "Informado A:" . $value->email;
        }
      } catch (Exception $e) {
        echo "la Notificación no pudo ser enviado. Mailer Error: {$e}";
      }
    };
  }

  public function GestionFormato()
  {

    $documento = new Formato();
    $_REQUEST['TipoSolicitud'] == 'eliminacion' ? $proceso = 'po' : $proceso = $_REQUEST['Proceso'];
    $documento->id = $_REQUEST['id'];
    $documento->CodFormato = $_REQUEST['CodFormato'];
    $documento->Proceso = $proceso;
    $documento->NomFormato = $_REQUEST['NomFormato'];
    $documento->RutaFormato = $_REQUEST['RutaFormato'];
    $documento->Version = $_REQUEST['Version'];
    $documento->Emision = $_REQUEST['Emision'];

    $documento->Almacenamiento = $_REQUEST['Almacenamiento'];
    $documento->Proteccion = $_REQUEST['Proteccion'];
    $documento->TipoRecuperacion = $_REQUEST['TipoRecuperacion'];
    $documento->Recuperacion = $_REQUEST['Recuperacion'];
    $documento->TiempoRetencion = $_REQUEST['TiempoRetencion'];
    $documento->DispFinal = $_REQUEST['DispFinal'];
    $documento->Responsable = $_REQUEST['Responsable'];
    /*fin datos formato*/
    /*Actualiza la solicitud*/
    $solictud = new Solicitud();
    $solictud->id = $_REQUEST['sol_id'];
    $solictud->EjecucionCambio = $_REQUEST['EjecucionCambio'];
    $solictud->TipoSolicitud = $_REQUEST['TipoSolicitud'];
    $solictud->Codigo = $_REQUEST['CodFormato'];
    $solictud->VersionCambiar = $_REQUEST['Version'];
    $solictud->Observaciones = $_REQUEST['Observaciones'];
    $solictud->Aprobado = $_REQUEST['Aprobado']; //estado
    $this->model->ActualizaGestion($solictud);


    $estado = '';
    if ($solictud->Aprobado == 'si') {
      if ($documento->id > 0) {
        $documento->Actualizacion = $_REQUEST['Actualizacion'];
        $documentos = $documento->Actualizar($documento);
        $this->model->HistorialSolicitud($solictud);
      } else {
        $documentos = $documento->Registrar($documento);
      }

      $disponibilidad = $solictud->EjecucionCambio;
      $estado = '["respuesta"]';
    }

    if ($solictud->Aprobado == 're') {
      $disponibilidad = 'La solicitud esta en revisión';
      $estado = '["revision"]';
      $this->model->HistorialSolicitud($solictud);
    }

    if ($solictud->Aprobado == 'no') {
      $disponibilidad = 'La solicitud fue denegada';
      $this->model->HistorialSolicitud($solictud);
    }
    //NOTIFICACION
    $remitente = new Notificacion();
    $remitentes = $remitente->Index();
    $asunto = "Se dio respuesta a una solicitud";
    $cuerpo = '<!doctype html>
            <html>
              <head>
                <meta name="viewport" content="width=device-width" />
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>CALIDADSNU</title>
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
                            <img src="https://calidadsnu.com/snu/Assets/img/uploads/colegio/' . $_SESSION["datos_cliente"]->filename . '" width="165" alt="Logo" style="width:80%;max-width:165px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                          </td>
                        </tr>                    
                          <!-- START MAIN CONTENT AREA -->
                          <tr>
                            <td class="wrapper" style="box-sizing: border-box; padding: 20px;">
                              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td>                              
                                   <p style="text-align: justify; color:gray">
                                   Hemos recibido a travez de nuestra plataforma la respuesta a la solicitud de ' . $TipoSolicitud . ' Número ' . $solictud->id .
      '<br> con el siguiente resultado<br>
                                  <strong>Aprobación: </strong>' . ucwords($solictud->Aprobado) . ':<br>
                                  <strong>Observación: </strong>' . $solictud->Observaciones . '<br>
                                  <strong>Código:</strong> ' . $_REQUEST["CodFormato"] . '<br>
                                  <strong>Proceso:</strong> ' . $documento->Proceso . '<br>
                                  <strong>Nombre:</strong> ' . $_REQUEST["NomFormato"] . '<br>
                                  Que estara disponible desde: ' . $solictud->EjecucionCambio . '<br>
                                  <a href="https://calidadsnu.com/snu/' . $documento->dir . '' . $documento->CodDocumento . '.pdf">Ver Documento</a>
                                  <p>                                     
                                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                      <tbody>
                                        <tr>
                                          <td align="left">                                        
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>                                
                                    <p  style="color:gray">Que tengan un grandioso día</p>
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

    $persona = $remitente->NotificacionAsignado($estado, $documento->Proceso);

    foreach ($persona as  $value) {
      $destinatario = $value->email;
      try {
        if ($email->Notificar($asunto, $cuerpo, $destinatario)) {
          echo 'Mensaje fue enviado';
        }
      } catch (Exception $e) {
        echo "Mensaje no fue enviado Error: {}";
      }
    }
  }


  public function GestionDocext()
  {
    $documento = new Doc_ext();
    @$documento->id = $_REQUEST['id'];
    $documento->codigo = $_REQUEST['codigo'];
    $documento->proceso = $_REQUEST['proceso'];
    $documento->nombre = $_REQUEST['nombre'];
    $documento->expedicion = $_REQUEST['expedicion'];
    $documento->descripcion = $_REQUEST['descripcion'];
    $documento->filename = $_FILES['filename']['name'];
    $documento->dir = $_REQUEST['dir'];
    /*fin datos documento*/
    $solictud = new Solicitud();
    $solictud->id = $_REQUEST['sol_id'];
    $solictud->EjecucionCambio = $_REQUEST['EjecucionCambio'];
    $solictud->Codigo = $_REQUEST['codigo'];
    $solictud->Observaciones = $_REQUEST['Observaciones'];
    $solictud->VersionCambiar = 0;
    $solictud->Aprobado = $_REQUEST['Aprobado']; //estado  
    $solictud->TipoSolicitud = $_REQUEST['tiposolicitud']; //estado  
    $this->model->ActualizaGestion($solictud);
    $estado = '';
    if ($solictud->Aprobado == 'si') {
      if ($solictud->TipoSolicitud == "actualizacion") {
        $documento->Actualizacion = $solictud->TipoSolicitud;
        $documentos = $documento->Actualizar($documento);
        $documentos = $documento->SubirDoc();
        $this->model->HistorialSolicitud($solictud);
      } else {
        $documentos = $documento->Registrar($documento);
        $documentos = $documento->SubirDoc();
      }

      $disponibilidad = $solictud->EjecucionCambio;
      $estado = '["respuesta"]';
      
    }

    if ($solictud->Aprobado == 're') {
      $disponibilidad = 'La solicitud esta en revisión';
      $estado = '["revision"]';
      $this->model->HistorialSolicitud($solictud);
    }

    if ($solictud->Aprobado == 'no') {
      $disponibilidad = 'La solicitud fue denegada';
      $this->model->HistorialSolicitud($solictud);
    }

    //NOTIFICACION
    $remitente = new Notificacion();

    $remitentes = $remitente->Index();
    $asunto = "Se dio respuesta a una solicitud";
    $cuerpo = '<!doctype html>
            <html>
              <head>
                <meta name="viewport" content="width=device-width" />
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>CALIDADSNU</title>
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
                            <img src="https://calidadsnu.com/snu/Assets/img/uploads/colegio/' . $_SESSION["datos_cliente"]->filename . '" width="165" alt="Logo" style="width:80%;max-width:165px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                          </td>
                        </tr>                    
                          <!-- START MAIN CONTENT AREA -->
                          <tr>
                            <td class="wrapper" style="box-sizing: border-box; padding: 20px;">
                              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td>                              
                                   <p style="text-align: justify; color:gray">
                                   Hemos recibido a travez de nuestra plataforma la respuesta a la solicitud de ' . $solictud->TipoSolicitud . ' Número ' . $solictud->id .
      '<br> con el siguiente resultado<br>
                                  <strong>Aprobación: </strong>' . ucwords($solictud->Aprobado) . ':<br>
                                  <strong>Observación: </strong>' . $solictud->Observaciones . '<br>
                                  <strong>Código:</strong> ' . $_REQUEST['codigo'] . '<br>
                                  <strong>Proceso:</strong> ' . $_REQUEST['proceso'] . '<br>
                                  <strong>Nombre:</strong> ' . $_REQUEST['nombre'] . '<br>
                                  Que estara disponible desde: ' . $solictud->EjecucionCambio . '<br><p>                                     
                                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                      <tbody>
                                        <tr>
                                          <td align="left">                                        
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>                                
                                    <p  style="color:gray">Que tengan un grandioso día</p>
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
    // $estado, $documento->codigo;
    $persona = $remitente->NotificacionAsignado($estado, $documento->proceso);
    // print_r($persona);

    foreach ($persona as  $value) {
      $destinatario = $value->email;
      try {
        if ($email->Notificar($asunto, $cuerpo, $destinatario)) {
          echo 'Mensaje fue enviado';
        }
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {}";
      }
    }
  }

  function uploadFileToDrive($file)
  {
    //   // Set up the Google Client
    //   $client = new Google_Client();
    //   $client->setClientId(CLIENT_ID);
    //   $client->setClientSecret(CLIENT_SECRET);
    //   $client->setScopes(array('https://www.googleapis.com/auth/drive'));

    //   // Create the Drive Service
    //   $service = new Google_Service_Drive($client);

    //   // Upload the file
    //   $fileMetadata = new Google_Service_Drive_DriveFile(array(
    //     'name' => $file['name']
    //   ));
    //   $content = file_get_contents($file['tmp_name']);
    //   $file = $service->files->create($fileMetadata, array(
    //     'data' => $content,
    //     'mimeType' => $file['type'],
    //     'uploadType' => 'multipart'
    //   ));

    //   // Get the shareable link
    //   $permission = new Google_Service_Drive_Permission(array(
    //     'type' => 'anyone',
    //     'role' => 'reader'
    //   ));
    //   $file->getPermissions()->insert('me', $permission);
    //   $shareableLink = $file->getWebViewLink();

    //   // Return the shareable link
    //   return $shareableLink;
  }

  function AsignarGestion()
  {
    $usuario = $this->usuario->GetUsuarios();
    $proceso = $this->proceso->getProcesosALL();
    $asignados = $this->model->getAsignados();
    require_once 'Views/Layout/default.php';
    require_once 'Views/Solicitudes/asignar_gestion.php';
    require_once 'Views/Layout/foot.php';
    require_once 'Views/Layout/filtro.php';
  }

  function addAsignacion()
  {
    $asignado = new Solicitud();
    $asignado->usuario = $_REQUEST['usuarios'];
    $asignado->Proceso = $_REQUEST['proceso'];
    $asignado->actividad = $_REQUEST['actividad'];

    $asignado->addAsignacion($asignado);
  }

  function deleteAsignacion()
  {
    $this->model->deleteAsignacion($_REQUEST['id']);
  }

  public function comprobarDoc()
  {
    $codigo = $_REQUEST['codigo'];
    $documento = $this->model->comprobarDoc($codigo);
    //print_r($documento);
    if ($documento->filename == "online") {
      echo "
   
        <p style= padding:3%  ><b style=color:#EB2A2A>El documento se encuentra online </b>cambia el modo de ejecucion a online</p>
        <input type=hidden id=doc_online_actual value=online >
        <script>
        
        </script>
      ";
    } else {
      // echo "<p>no es online</p>";
    }
    //echo $documento->filename;
  }
}
