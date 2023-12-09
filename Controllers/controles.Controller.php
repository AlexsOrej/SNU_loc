<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Controles.php';
require_once 'Models/TipoEjecucion.php';
require_once 'Models/FrecuenciaEjecucion.php';
require_once 'Models/TipoControl.php';
require_once 'Models/Proceso.php';



class ControlesController
{
    private $rol;
    public function __CONSTRUCT()
    {
        $this->model = new Controles();
        $this->tipoEjecucion = new TipoEjecucion();
        $this->frecuenciaEjecucion = new FrecuenciaEjecucion();
        $this->tipoControl = new TipoControl();
        $this->proceso = new Proceso();
    }

    public function index()
    {
        $controles = $this->model->consultar();
        require_once 'Views/Layout/riesgos.php';
        require_once 'Views/Controles/index.php';
        require_once 'Views/Layout/foot.php';
    }
    public function add(){
        $nivel = new Controles();
        if(isset($_REQUEST['id'])){
            $nivel = $this->model->consultarPorId($_REQUEST['id']);
        }

        $tipo_control = $this->tipoControl->consultar();
        $frecuenciaEjecucion = $this->frecuenciaEjecucion->consultar();
        $tipoEjecucion = $this->tipoEjecucion->consultar();
        $proceso = new Proceso();
        $_SESSION['user']->rol_id == 1 ? $procesos = $proceso->getProceso0() : $procesos = $proceso->getProceso();
        require_once 'Views/Controles/crud.php';
    }
  
    public function crud(){
        $data = new Controles();
        $data->id = $_REQUEST['id'];
        $data->nombre = $_REQUEST['nombre'];
        $data->diseño = $_REQUEST['diseño'];
        $data->tipo = $_REQUEST['tipo_control'];
        $data->tipoEjecucion = $_REQUEST['tipo_ejecucion']; 
        $data->frecuenciaEjecucion = $_REQUEST['frecuencia_ejecucion']; 
        $data->documentado = $_REQUEST['documentado'];
        $partes = explode("-", $_REQUEST['responsable']);
        $data->responsable = $partes[0]; 
        $data->evidencia = $_REQUEST['evidencia'];  ;
        $data->descripcion = $_REQUEST['descripcion']; 
        $data->fecha = date('Y-m-d');
        
        //print_r($data);
        if( $data->id > 0)
        {
        $this->model->Actualizar($data);
  
        }else{
        $this->model->Registrar($data);
        }
    }

    public function mostrarControles(){
        $control = $this->model->consultar();
        ?>
        <?php
        if($_REQUEST['control'] == "si"){?>
             
            <div class="col-md-6">
            <label>Elija el control</label>
                  <select class="form-control show-tick" name="nombreControl" id="nombreControl" required>
                      <option value="">-- Seleccionar --</option>
                      <?php foreach ($control as $ctrl) : ?>
                          <option value="<?php echo $ctrl->id ?>"><?php echo $ctrl->nombre?> </option>
                      <?php endforeach; ?>
                  </select>
            </div>
        <?php    
        }
       
    }

    public function evaluar(){
        //aqui recibira el id del control
        require_once 'Views/Layout/riesgos.php';
        require_once 'Views/Controles/evaluar.php';
        require_once 'Views/Layout/foot.php';
    }
  
    public function delete(){
        $id = $_REQUEST['id'];
        $this->model->delete($id);
    }
}
