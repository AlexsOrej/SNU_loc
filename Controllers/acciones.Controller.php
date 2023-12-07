<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Accion.php';
require_once 'Models/Cargo.php';


class AccionesController
{
    private $rol;
    public function __CONSTRUCT()
    {
        $this->model = new Accion();
    }

    public function Add()
    {
        $cargo = new Cargo();
        $cargos = $cargo->CargoIndex();
        $accions=new Accion();       
        if(isset($_REQUEST['accion_id'])){
            $accions=$this->model->GetPlanAccion($_REQUEST['accion_id']);
            
        }
        require_once 'Views/Layout/estadistico.php';
        require_once 'Views/Acciones/add.php';
        require_once 'Views/Layout/foot.php';
    }

    public function Crud()
    {
        # code...
        $accion = new Accion();
        $accion->id=$_REQUEST['accion_id'];
        $accion->dato_id = $_REQUEST['dato_id'];
        $accion->analisis = $_REQUEST['analisis'];
        $accion->accion = $_REQUEST['accion'];
        $accion->f_ejecucion = $_REQUEST['f_ejecucion'];
        $accion->cargo_id = $_REQUEST['cargo_id'];
        $accion->id > 0 ? $this->model->Update($accion) : $this->model->Add($accion);
    }
}
