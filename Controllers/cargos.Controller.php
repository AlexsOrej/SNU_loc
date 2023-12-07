<?php
//importar los modelos necesarios
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Cargo.php';
require_once 'Models/Proceso.php';
//nombre la clase
class CargosController
{
    private $model;
    public function __CONSTRUCT()
    {
        $this->model = new Cargo();
    }
    /*crear los metodos necesarios*/
    public function Index_Cargos()
    {
        $cargos = $this->model->CargoIndex();
        require_once 'Views/Layout/default.php';
        require_once 'Views/Cargos/index.php';
        require_once 'Views/Layout/foot.php';
    }

    public function Add_cargos()
    {
        $proceso = new Proceso();
        $cargo = new Cargo();
        if (isset($_REQUEST['id'])) {
            $cargo = $this->model->GetCargos($_REQUEST['id']);
        }
         $procesos = $proceso->getProceso0(); 
        require_once 'Views/Cargos/crud.php';
    }
    public function Crud()
    {
        $cargo = new Cargo();
        $cargo->id = $_REQUEST['id'];
        $cargo->cargo = $_REQUEST['cargo'];
        $cargo->cliente_id = $_REQUEST['cliente_id'];
        $cargo->proceso_id = $_REQUEST['proceso_id'];
        $cargo->id > 0 ? $this->model->Edit($cargo) : $this->model->Add($cargo);
        $this->model->SubirPerfil();
    }

   public function Delete_cargos()
   {
        $delete = $this->model->ComprobarEliminacionCargo($_REQUEST['id']);
        if($delete['contratos'] >= 1){
              echo "Tiene ".$delete['contratos']." contratos para este cargo, no se puede eliminar";
            //echo $delete['contratos'];
        }else{
            // echo "eliminar";
           $this->model->Delete($_REQUEST['id']);
        }
   }



}
