<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Probabilidad.php';


class ProbabilidadController
{
    private $rol;
    public function __CONSTRUCT()
    {
        $this->model = new Probabilidad();
    }

   
    public function index()
    {
        $probabilidad= $this->model->consultar();
        require_once 'Views/Layout/riesgos.php';
        require_once 'Views/Probabilidad/index.php';
        require_once 'Views/Layout/foot.php';
    }

    
    public function add(){
        $probabilidad = new Probabilidad();
        if(isset($_REQUEST['id'])){
            $probabilidad = $this->model->consultarPorId($_REQUEST['id']);
        }
        require_once 'Views/Probabilidad/crud.php';
    }

    public function crud(){
        $data = new Probabilidad();
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
