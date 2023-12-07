<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Impactos.php';


class ImpactosController
{
    private $rol;
    public function __CONSTRUCT()
    {
        $this->model = new Impactos();
    }

    public function index()
    {
        $impacto = $this->model->consultar();
        require_once 'Views/Layout/riesgos.php';
        require_once 'Views/Impactos/index.php';
        require_once 'Views/Layout/foot.php';
    }

    public function add(){
        $impacto = new Impactos();
        if(isset($_REQUEST['id'])){
            $impacto = $this->model->consultarPorId($_REQUEST['id']);
        }
        require_once 'Views/Impactos/crud.php';
    }

    public function crud(){
        $data = new Impactos();
        $data->id = $_REQUEST['id'];
        $data->nombre = $_REQUEST['nombre'];
        $data->valor =  $_REQUEST['valor'];
        $data->afectacion =  $_REQUEST['afectacion'];
        $data->afectacion_economica =  $_REQUEST['afectacion_eco'];
        $data->afectacion_reputacional =  $_REQUEST['afectacion_rep'];
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
