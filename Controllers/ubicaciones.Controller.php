<?php
// importar los modelos necesarios
require_once 'Models/database.php';
require_once 'Models/Ubicacion.php';
require_once 'Models/Rotativo.php';
require_once 'Models/Sede.php';

//nombre la clase

class UbicacionesController
{   private $model;
    private $rotativo;
    public function __CONSTRUCT()

    {
        $this->model = new Ubicacion();
        $this->rotativo =new Rotativo();
    }
    /*crear los metodos necesarios*/
    public function Index()
    {
        $ubicacion = new Ubicacion();
        $ubicacions = $ubicacion->Index();
        require_once 'Views/Layout/inventario.php';
        require_once 'Views/Ubicaciones/index.php';  
        require_once 'Views/Layout/foot.php';
        require_once 'Views/Layout/filtro.php';
    }
    public function Add()
    {
        $ubicacion = new Ubicacion();
        $sede = new Sede();
        $sedes =$sede->Index();
        if (isset($_REQUEST['id'])) {
            $ubicacion = $ubicacion->Ubicacion($_REQUEST['id']);
        }
        require_once 'Views/Ubicaciones/crud.php';
    }

    public function Crud()
    {
        $Ubicacions = new Ubicacion();
        $Ubicacions->id = $_REQUEST['id'];
        $Ubicacions->nombre = strtoupper($_REQUEST['nombre']);        
        $Ubicacions->sede_id = strtoupper($_REQUEST['sede_id']);    
        $Ubicacions->created = $_REQUEST['created'];        
        $Ubicacions->modified = date('Y-m-d');
        $Ubicacions->id > 0 ? $Ubicacions->Edit($Ubicacions) : $Ubicacions->Add($Ubicacions);
    }
    
    public function Descripcion()
    {
        $ubicacion = new Ubicacion();
        $ubicacions = $ubicacion->UbicacionxSede($_REQUEST['sede_id']);
      ?>
        <select name="ubicacion_id" id="ubicacion_id" class="form-control" required="required">';
            <option value="">Seleccionar</option>
            <?php foreach ($ubicacions as $value) : ?>
                <option value="<?= $value->id ?>"> <?= $value->nombre ?></option>
            <?php endforeach; ?>
        </select>

      <?php }

    public function Descripcion01()
    {
        $ubicacion = new Ubicacion();
        $ubicacions = $ubicacion->UbicacionxSede($_REQUEST['sede_id']);
        $ubicacionesignados = $this->rotativo->UbicacionAsignado();
        require_once 'Views/Ubicaciones/rotativo.php';
        require_once 'Views/Layout/filtro.php';
    }

    public function Delete()
    {
        if ($this->model->ValDelete($_REQUEST['id']) == 0) {
            $this->model->Delete($_REQUEST['id']);
         echo 0;   
     } else {
         echo  $this->model->ValDelete($_REQUEST['id']);
     }
    }
}
