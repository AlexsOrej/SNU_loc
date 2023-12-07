<?php
// importar los modelos necesarios
require_once 'Models/database.php';
require_once 'Models/Estado.php';

//nombre la clase
class EstadosController
{   
    public $model;
    public function __CONSTRUCT()
    {
        $this->model = new Estado();
    }
    /*crear los metodos necesarios*/
    public function Index()
    {
        $estado = new Estado();
        $estados = $estado->Index();
        require_once 'Views/Layout/inventario.php';
        require_once 'Views/Estados/index.php';
        require_once 'Views/Layout/footer.php';
        require_once 'Views/Layout/filtro.php';
    }
    public function Add()
    {
        $estado = new Estado();
        if (isset($_REQUEST['id'])) {
            $estado = $estado->Estado($_REQUEST['id']);
        }
        require_once 'Views/Estados/crud.php';
    }

    public function Crud()
    {
        $estados = new Estado();
        $estados->id = $_REQUEST['id'];
        $estados->nombre = strtoupper($_REQUEST['nombre']);        
        $estados->created = $_REQUEST['created'];        
        $estados->modified = date('Y-m-d');
        $estados->id > 0 ? $estados->Edit($estados) : $estados->Add($estados);
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
