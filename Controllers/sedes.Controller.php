<?php
// importar los modelos necesarios
require_once 'Models/database.php';
require_once 'Models/Sede.php';

//nombre la clase
class SedesController
{ public $model;
    public function __CONSTRUCT()
    {
        $this->model = new Sede();
    }
    /*crear los metodos necesarios*/
    public function Index()
    {
        $sede = new Sede();
        $sedes = $sede->Index();
        require_once 'Views/Layout/inventario.php';
        require_once 'Views/Sedes/index.php';
        require_once 'Views/Layout/footer.php';
        require_once 'Views/Layout/filtro.php';
    }
    public function Add()
    {
        $sede = new Sede();
        if (isset($_REQUEST['id'])) {
            $sede = $sede->Sede($_REQUEST['id']);
        }
        require_once 'Views/Sedes/crud.php';
    }

    public function Crud()
    {
        $sedes = new Sede();
        $sedes->id = $_REQUEST['id'];
        $sedes->nombre = strtoupper($_REQUEST['nombre']);        
        $sedes->created = $_REQUEST['created'];        
        $sedes->modified = date('Y-m-d');
        $sedes->id > 0 ? $sedes->Edit($sedes) : $sedes->Add($sedes);
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
