<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Criterioscontrol.php';


class CriteriosControlController
{
    private $rol;
    public function __CONSTRUCT()
    {
        $this->model = new CriteriosControl();
    }

   
    public function index()
    {
        $criterio = $this->model->consultar();
        require_once 'Views/Layout/riesgos.php';
        require_once 'Views/CriteriosControl/index.php';
        require_once 'Views/Layout/foot.php';
    }

    
    public function add(){
        $criterio = $this->model->consultar();
        $nivel = new CriteriosControl();
        if(isset($_REQUEST['id'])){
            $nivel = $this->model->consultarPorId($_REQUEST['id']);
        }
        require_once 'Views/CriteriosControl/crud.php';
    }

    public function crud(){
        $data = new CriteriosControl();
        $data->id = $_REQUEST['id'];
        $data->nombre = $_REQUEST['nombre'];
        $data->valor =  $_REQUEST['valor'];
       


        if( $data->id > 0)
        {
        $this->model->Actualizar($data);

        }else{
        $this->model->Registrar($data);
        }
    }

    public function delete(){
        $id = $_REQUEST['id'];
        $this->model->delete($id);
    }
}
