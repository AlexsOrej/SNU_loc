<?php
// importar los modelos necesarios
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Model.php';
require_once 'Models/Proceso.php';

//nombre la clase
class ProcesosController
{ 
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new Proceso();
        $permisos = new Model();
        $permisos->Tblusuariosprocesos('usuario_proceso');

    }
    /*crear los metodos necesarios*/
    public function Index_procesos()
    {        
        $proceso = new Proceso(); 
        $_SESSION['user']->rol_id!=1 ? 
        $procesos = $proceso->getProcesosALL():
        $procesos = $proceso->getProceso0();
        require_once 'Views/Layout/default.php';
        require_once 'Views/Procesos/index.php';
        require_once 'Views/Layout/footer.php';
    }
    public function Index_procesos_riesgos()
    {        
        $proceso = new Proceso(); 
        $_SESSION['user']->rol_id!=1 ? 
        $procesos = $proceso->getProcesosALL():
        $procesos = $proceso->getProceso0();
        require_once 'Views/Layout/riesgos.php';
        require_once 'Views/Procesos/index.php';
        require_once 'Views/Layout/footer.php';
    }

    public function Add_procesos()
    {
        $proceso = new Proceso();       
        if (isset($_REQUEST['id'])) {
            $proceso = $this->model->getProcesos($_REQUEST['id']);
        }
        require_once 'Views/Procesos/crud.php';
    }
    public function Crud()
    {
        $proceso = new Proceso();
        
        $proceso->id = $_REQUEST['id'];
        $proceso->NombreProceso = $_REQUEST['NombreProceso'];
        $proceso->Iniciales=$_REQUEST['Iniciales'];
        $proceso->tipo = 1;
        $proceso->cod_int = 1;
        $proceso->id > 0 ? $this->model->Edit($proceso) : $this->model->Add($proceso);
    }

   public function Delete()
   {
        $this->model->Delete($_REQUEST['id']);
   }



}
