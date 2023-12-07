<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/Dato.php';
require_once 'Models/database.php';
require_once 'Models/Proceso.php';
require_once 'Models/Indicador.php';
require_once 'Models/Cargo.php';
require_once 'Models/Modelo.php';
require_once 'Models/Meta.php';
require_once 'Models/Accion.php';


class IndicadorsController
{
  private $rol;
  public $model;
  public $meta;
  public $dato_id;
  public $cargo;
  public function __CONSTRUCT()
  {
    $this->model = new Indicador();
    $this->meta = new Meta();
    $this->cargo = new Cargo();
  }


  public function Index()
  {
    $proceso = new Proceso();
    $procesos = $proceso->getProceso();
    $_SESSION['user']->rol_id == 1 ? $procesos = $proceso->getProceso0() : $procesos = $proceso->getProceso();
    $indicadors = $this->model->Index();


    $cargo = new Cargo();
    $cargos = $cargo->CargoIndex();
    require_once 'Views/Layout/estadistico.php';
    require_once 'Views/Indicadors/index.php';
    require_once 'Views/Layout/foot.php';
    require_once 'Views/Layout/filtro.php';
  }

  public function Indice()
  {
    $indicadors = $this->model->Index();
    $proceso = new Proceso();
    $_SESSION['user']->rol_id == 1 ? $procesos = $proceso->getProceso0() : $procesos = $proceso->getProceso();
    $indicadors = $this->model->GetByProceso();
    $cargo = new Cargo();
    $cargos = $cargo->CargoIndex();
    require_once 'Views/Indicadors/indice.php';
    require_once 'Views/Layout/filtro.php';
  }

  public function Add()
  {

    $proceso = new Proceso();
    $_SESSION['user']->rol_id == 1 ? $procesos = $proceso->getProceso0() : $procesos = $proceso->getProceso();
    $formula = new Modelo();
    $formulas = $formula->GetFormula();
    $indicador = new Indicador();
    $cargos = $this->cargo->SetCargosPersonas();
    if (isset($_REQUEST['id'])) {
      $indicador = $this->model->GetIndicador($_REQUEST['id']);
      // print_r($indicador);
    }
    require_once 'Views/Layout/estadistico.php';
    require_once 'Views/Indicadors/add.php';
    require_once 'Views/Layout/foot.php';
  }

  public function Crud()
  {
    $obj = new Indicador();

    $obj->id = $_REQUEST['id'];
    $obj->proceso_id = $_REQUEST['proceso_id'];
    $obj->formula_id = $_REQUEST['formula_id'];
    $obj->nombre = $_REQUEST['nombre'];
    $obj->cargo_id = @$_REQUEST['cargo_id'];
    $obj->definicion = $_REQUEST['definicion'];
    $obj->interpretacion = $_REQUEST['interpretacion'];
    $obj->periodicidad = $_REQUEST['periodicidad'];
    $obj->fecha_control = $_REQUEST['fecha_control'];
    $obj->tipo = 'general';
    $obj->num_meta = $_REQUEST['num_meta'];
    $obj->meta = $_REQUEST['meta'];

    $obj->id > 0 ?
      $result =  $this->model->Update($obj) :
      $result = $this->model->Add($obj);
    echo $result;
  }


  // metas//
  public function Meta()
  {
    $metas = new Meta();
    if (isset($_REQUEST['id'])) {
      $metas = $metas->GetMeta($_REQUEST['id']);
    }
    require_once 'Views/Layout/estadistico.php';
    require_once 'Views/Indicadors/meta.php';
    require_once 'Views/Layout/foot.php';
  }


  public function CrudMeta()
  {

    $meta = new Meta();

    $meta->id = $_REQUEST['id'];
    $meta->comparativo = $_REQUEST['comparativo'];
    $meta->valor = $_REQUEST['valor'];
    $meta->indicador_id = $_REQUEST['indicador_id'];
    $meta->fecha_uso = $_REQUEST['fecha_uso'];

    echo  $_REQUEST['id'] > 0 ?
      $meta->Update($meta) :
      $meta->Add($meta);
  }

  public function Cargos($cargo_id)
  {
    $cargo = new Cargo();
    $cargos = $cargo->SetCargosPersonas();
    echo '<label>Responsable</label>
    <select class="form-control"  id="cargo_id" name="cargo_id" required>
    <option value="">Seleccionar</option>';
    foreach ($cargos as $value) :
      echo '<option value="' . $value->id . '" ' . $value->id == $cargo_id ? 'selected' : '' . '   >' . $value->cargo . " " . $value->nombres . " " . $value->apellidos . '</option>';
    endforeach;
    echo '</select>';
  }

  public function Indexmeta()
  {
    $meta = new Meta();
    $metas = $meta->GetMetas($_REQUEST['ind']);
    if ($metas) {
      require_once 'Views/Indicadors/indexmeta.php';
    } else {
      echo '<h3>No hay metas registradas</h3>';
    }
  }

  public function Quitar()
  {
    $meta = new Meta();
    $meta->Quitar($_REQUEST['id']);
  }
  //fin metas//

  //inicio datos//

  public function Datos()
  {
    $indicadors = $this->model->GetIndicador($_REQUEST['id']);
    $metas = new Meta();
    $metas = $metas->GetMetas($_REQUEST['id']);
    $dato = new Dato();

    if (isset($_REQUEST['dato_id'])) {
      $dato = $dato->GetDato($_REQUEST['dato_id']);
    }
    require_once 'Views/Layout/estadistico.php';
    require_once 'Views/Indicadors/datos.php';
    require_once 'Views/Layout/foot.php';
  }
  public function AddDatos()
  {
    $dato = new Dato();
    $dato->id = $_REQUEST['id'];
    $dato->indicador_id = $_REQUEST['indicador_id'];
    $dato->meta_id = $_REQUEST['meta_id'];
    $dato->fecha_aplicacion = $_REQUEST['fecha_aplicacion'];
    $dato->expresion = $_REQUEST['expr1'] . ' ' . @$_REQUEST['expr2'] . ' ' . @$_REQUEST['expr3'];
    $dato->resultado = $_REQUEST['resultado'];
    $dato->dato_id = $_REQUEST['dato_id'];

    echo  $_REQUEST['dato_id'] > 0 ?
      $dato->Update($dato) :
      $dato->Add($dato);
  }

  public function VerDatos()
  {
    $dato = new Dato();
    $datos = $dato->GetDatos($_REQUEST['indicador_id']);
    $accion = new Accion();
    $acciones = $accion->GetAccionInd($_REQUEST['indicador_id']);
    $indicador = $this->model->GetIndicador($_REQUEST['indicador_id']);
    $metas = $this->meta->GetMetas($_REQUEST['indicador_id']);
    require_once 'Views/Layout/estadistico.php';
    require_once 'Views/Indicadors/ver.php';
    require_once 'Views/Layout/foot.php';
    require_once 'Views/Layout/filtro.php';
  }
  public function Consolidado()
  {
    $indicadornombre = $this->model->IndicadorNombre();
    $indicadordato = $this->model->IndicadorDato();
    $proceso = new Proceso();
    $_SESSION['user']->rol_id == 1 ? $procesos = $proceso->getProceso0() : $procesos = $proceso->getProceso();
    require_once 'Views/Layout/estadistico.php';
    require_once 'Views/Indicadors/consolidado.php';
    require_once 'Views/Layout/foot.php';
    require_once 'Views/Layout/filtro.php';
  }
  public function Consolidado2()
  {
    $indicadornombre = $this->model->IndicadorNombre();
    $indicadordato = $this->model->IndicadorDato();
    $indicadores = $this->model->ObtenerIndicadores($_REQUEST['procesos'], $_REQUEST['desde'], $_REQUEST['hasta']);

    $proceso = new Proceso();
    $_SESSION['user']->rol_id == 1 ? $procesos = $proceso->getProceso0() : $procesos = $proceso->getProceso();
    require_once 'Views/Indicadors/consolidado2.php';
  }

  public function DeleteDato()
  {
    $dato = new Dato();
    $dato->Delete($_REQUEST['id']);
  }
}
