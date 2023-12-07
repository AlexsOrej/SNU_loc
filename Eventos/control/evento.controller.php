<?php
require_once 'model/Evento.php';
require_once 'model/Proceso.php';

class EventoController
{
  private $evento;
  private $proceso;
  public function __construct()
  {
    $this->evento = new Evento();
    $this->proceso = new Proceso();
    // print_r($this->evento);
  }

  public function Index()
  {
    $imagen= $this->evento->Imagen($_REQUEST['cliente']);
    $procesos = $this->proceso->getProcesosALL();
    $clasificacion_eventos = $this->evento->ClasificacionEventos();
    require_once 'Views/Eventos/registro.php';
  }

  public function proceso_reponsable()
  {

    $cargos = $this->evento->GetCargo($_REQUEST['proceso']);

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

  public function Evento()
  {
    
    $condicions = $this->evento->GetCondicion($_REQUEST["sigla"]);
  ?>
    <div class="form-group">
      <div class="form-line">
        <label>Eventos</label>
        <select name="TbCondiciones_id" id="TbCondiciones_id" class="form-control" required="required">
          <option value=" ">Seleccionar</option>;
          <?php foreach ($condicions as $value) { ?>
            <option value="<?php echo $value->id ?>"><?php echo $value->tipoIncidente ?> </option> ";
          <?php  } ?>
        </select>
      </div>
    </div>
<?php }

public function Registrar()
  {
    $autoreporte = new Evento();
    $autoreporte->proceso = $_REQUEST['proceso'];
    $autoreporte->cargo_id = $_REQUEST['cargo_id'];
    $autoreporte->TbCondiciones_id = $_REQUEST['TbCondiciones_id'];
    $autoreporte->descEvento = $_REQUEST['descEvento'];
    $autoreporte->lugarEvento = $_REQUEST['lugarEvento'];
    $autoreporte->usuario = $_REQUEST['usuario'];
    $autoreporte->estado = 'En Tramite';
    $autoreporte->fechaRegistro = date('Y-m-d');
    $tipoevento = $_REQUEST['evento'];


    // $autore = $autoreporte->GetEventos($autoreporte->TbCondiciones_id);
    // print_r($autore->correoresponsable);    
    
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
    $this->evento->Add($autoreporte);

  }

  


}
