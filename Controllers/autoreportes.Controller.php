<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Autoreporte.php';
require_once 'Models/Proceso.php';
require_once 'Models/Cargo.php';
require_once 'Models/Condicion.php';
require_once 'Models/Usuario.php';
require_once 'Controllers/notificaciones.Controller.php';



class AutoreportesController
{
  private $model;
  public function __CONSTRUCT()
  {
    $this->model = new Autoreporte();
  }
  public function Index()
  {
    require_once 'Views/Layout/eventos.php';
    require_once 'Views/Cliente/index.php';
    require_once 'Views/Layout/foot.php';
  }
  public function Add()
  {
    $proceso = new Proceso();
    $_SESSION['user']->rol_id == 1 ? $procesos = $proceso->getProceso0() : $procesos = $proceso->getProceso();
    $cat_eventos = $this->model->Categoriaevento();
    require_once 'Views/Layout/eventos.php';
    require_once 'Views/Autoreportes/add.php';
    require_once 'Views/Layout/foot.php';
  }

  public function Proceso_reponsable()
  {

    $cargo = new Cargo();
    $cargos = $cargo->GetCargo($_REQUEST['proceso']);

?>
    <div class="form-group">
      <div class="form-line">
        <label>Responsable</label>
        <select name="cargo_id" id="cargo_id" class="form-control" required="required">
          <option value=" ">Seleccionar</option>;
          <?php foreach ($cargos as $value) { ?>
            <option value="<?php echo $value->usuario_id ?>">
              <?php echo $value->cargo . ' ' . $value->nombres . ' ' . $value->apellidos ?>
            </option>;
          <?php  } ?>
        </select>
      </div>
    </div>
  <?php
  }
  public function Asignar_responsable()
  {    

    $cargo = new Cargo();
    $cargos = $cargo->GetCargo($_REQUEST['proceso']);
    // print_r($cargos);

  ?>
    <div class="form-group">
      <div class="form-line">
        <label>Responsable</label>
        <select name="responsable" id="responsable" class="form-control" required="required">
          <option value=" ">Seleccionar</option>;
          <?php foreach ($cargos as $value) { ?>
            <option value="<?php echo $value->nombres . ' ' . $value->apellidos . '-' . $value->email ?>">
              <?php echo $value->cargo . ' ' . $value->nombres . ' ' . $value->apellidos . '-' . $value->email ?>
            </option>;
          <?php  } ?>
        </select>
        <input type="hidden" name="email" id="email" value="<?= $value->email ?>">
      </div>
    </div>
  <?php
  }
  public function Evento()
  {
    $condicion = new Condicion();
    $condicions = $condicion->GetCondicion($_REQUEST["sigla"]);
  ?>
    <div class="form-group">
      <div class="form-line">
        <label>Eventos</label>
        <select name="TbCondiciones_id" id="TbCondiciones_id" class="form-control" required="required">
          <option value=" ">Seleccionar</option>;
          <?php foreach ($condicions as $value) { ?>
            <option value="<?php echo $value->id ?>"><?php echo $value->tipoIncidente ?> </option>";
          <?php  } ?>
        </select>
      </div>

    </div>
<?php }


  public function Crud()
  {
    $clientes = new Cliente();
    if (isset($_REQUEST['id'])) {
      $clientes = $this->model->upCliente($_REQUEST['id']);
    }
    require_once 'Views/Cliente/crud.php';
  }

  /**
   * Summary of Registrar
   * @return void
   */
  public function Registrar()
  {
    $autoreporte = new Autoreporte();
    $autoreporte->proceso = $_REQUEST['proceso'];
    $autoreporte->cargo_id = $_REQUEST['cargo_id'];
    $autoreporte->TbCondiciones_id = $_REQUEST['TbCondiciones_id'];
    $autoreporte->descEvento = $_REQUEST['descEvento'];
    $autoreporte->lugarEvento = $_REQUEST['lugarEvento'];
  echo  $autoreporte->usuario = $_REQUEST['usuario'];
    $autoreporte->estado = $_REQUEST['estado'];
    $autoreporte->fechaRegistro = $_REQUEST['fechaRegistro'];
    $tipoevento = $_REQUEST['evento'];
    $autore = $autoreporte->GetEventos($autoreporte->TbCondiciones_id);
    print_r($autore->correoresponsable);

    if ($tipoevento == 'AI') {
      $evento = 'Acto Inseguro';
    }
    if ($tipoevento == 'CI') {
      $evento = 'Condición Insegura';
    }
    if ($tipoevento == 'SNC') {
      $evento = 'Servcio No Conforme';
    }
    if ($tipoevento == 'EA') {
      $evento = 'Evento Adverso';
    }
    if ($tipoevento == 'INC') {
      $evento = 'Incidente';
    }
    if ($tipoevento == 'ACC') {
      $evento = 'Accidente';
    }
    if ($tipoevento == 'ES') {
      $evento = 'Sistema de Información';
    }

    /*fin reporte*/
    $this->model->Add($autoreporte);
    /*noticar al usuario vinculado */
    $usuario = new Usuario();
    $usuario = $usuario->getUsuario($autoreporte->cargo_id);
    $correoImplicado=$usuario->email;
    $FullName =  $usuario->nombres . '' . $usuario->apellidos;
    $destinatario = $autore->correoresponsable;
    $destinatario =[
      $correoImplicado=>$FullName,
      $autore->correoresponsable=>"",
    ];
    $asunto = "Fue registrado un Evento";
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
                                   Señor@ <br>
                                </p>
                                   <p style="text-align: justify; color:gray">
                                   Hemos recibido a travez de nuestra plataforma el registro de un evento con la clasificación de <strong>' . $evento . '</strong>  <BR>
                                   <strong>Vinculado a:</strong> ' . $FullName . '.<br>
                                   <strong>Evento:</strong>' . $autore->tipoIncidente . '. <br>
                                   <strong>Lugar del Evento:</strong>' . $autoreporte->lugarEvento . '. <br>
                                   <strong>Descrición del evento:</strong>' . $autoreporte->descEvento . '.<br>   
                                   La corrección propuesta por SNU es la siguiente:  <strong>' . $autore->correcionIncidente . '</strong><br> 
                                  El tratamiento del evento debe ser registrado en la plataforma. 
                                </p>
                                </p>  
                               
                                         <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                      <tbody>
                                        <tr>
                                          <td align="left">                                        
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>                                
                                    <p  style="color:gray">Que tenga un grandioso día.</p>
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

  public function buscarIndex()
  {
    $proceso = new Proceso();
    $_SESSION['user']->rol_id == 1 ? $procesos = $proceso->getProceso0() : $procesos = $proceso->getProceso();
    require_once 'Views/Layout/eventos.php';
    require_once 'Views/Autoreportes/buscar.php';
    require_once 'Views/Layout/footer.php';
  }


  public function BuscarResp()
  {
    $autoreporte = new Autoreporte();
    if (isset($_REQUEST['estado'])) {
      $autoreportes = $autoreporte->GetAutoreporte('estado', $_REQUEST['estado']);
    }
    if (isset($_REQUEST['inci'])) {
      $autoreportes = $autoreporte->GetAutoreporte('TbCondiciones_id', $_REQUEST['inci']);
    }
    if (isset($_REQUEST['proceso'])) {

      $autoreportes = $autoreporte->GetAutoreporte('proceso', $_REQUEST['proceso']);
    }

    require_once 'Views/Autoreportes/resultado.php';
    require_once 'Views/Layout/filtro.php';
  }


  public function Responder()
  {
    $autorepo =  $this->model->GetAutorep($_REQUEST['id']);
    $pro = $autorepo->proceso;
    $cond = $autorepo->TbCondiciones_id;
    $recur = $this->model->Recurrente($pro, $cond);
    $recurrente = $recur->cantidad;
    require_once 'Views/Autoreportes/responder.php';
  }

  public function Gestion()
  {
    $data = new Autoreporte();
    $data->id = $_REQUEST['id'];
    $data->estado = $_REQUEST['estado'];
    $data->observacion1 = $_REQUEST['usuario'];
    if ($_REQUEST['estado'] == 'Revisión') {
      $data->conciliacion = $_REQUEST['conciliacion'];
      $data->taccion = $_REQUEST['taccion'];
      $data->respuesta = $_REQUEST['respuesta'];
      $data->num_accion_corr = $_REQUEST['num_accion_corr'];
      $data->fechaRespuesta = $_REQUEST['fechaRespuesta'];
      $data->fechaValidacion = '0000-00-00';
    }

    if ($_REQUEST['estado'] == 'Aprobacion') {
      $data->fechaValidacion = $_REQUEST['fechaValidacion'];
      $data->observacion = $_REQUEST['observacion'];
      $data->observacion1 = $_REQUEST['observacion_1'];
    }

    if ($_REQUEST['estado'] == 'Rechazado') {

      $data->observacion1 = $_REQUEST['observacion1'];
    }
    $this->model->RespuestaEdit($data);
  }


  public function Dashboard()
  {
    // # eventos registrados
    $eventos = $this->model->EventosRegistrados();
    // # eventos por estado
    $entramite = $this->model->EventosEnTramite();
    $enrevision = $this->model->EventosEnRevision();
    $enaprobacion = $this->model->EventosAprobacion();
    // graf eventos por proceso
    $procesos = $this->model->EventosProceso();
    // eventos por tipo
    $categoriaEventos = $this->model->EventosCondiciones();
    // eventos por incidente
    $eventoIncidente = $this->model->EventosIncidente();


    require_once 'Views/Layout/eventos.php';
    require_once 'Views/Autoreportes/dashboard.php';
    require_once 'Views/Layout/footer.php';
  }
}
