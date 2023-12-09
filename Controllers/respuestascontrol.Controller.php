<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Respuestascontrol.php';
require_once 'Models/Criterioscontrol.php';


class RespuestascontrolController
{
    private $rol;
    public function __CONSTRUCT()
    {
        $this->model = new Respuestascontrol();
        $this->criterio = new Criterioscontrol();
    }

   
    public function index()
    {
        $nivel = $this->model->consultar();
        require_once 'Views/Layout/riesgos.php';
        require_once 'Views/RespuestasCriterio/index.php';
        require_once 'Views/Layout/foot.php';
    }

    public function respuestas(){
        $id = $_REQUEST['id'];
        $criterio = $this->criterio->consultarPorId($id);
        require_once 'Views/Layout/riesgos.php';
        require_once 'Views/RespuestasCriterio/index.php';
        require_once 'Views/Layout/foot.php';
    }
    
    
    public function add(){
        $nivel = new Respuestascontrol();
        if(isset($_REQUEST['id'])){
            $nivel = $this->model->consultarPorId($_REQUEST['id']);
        }
        require_once 'Views/RespuestasCriterio/crud.php';
    }

    public function crud(){
        $data = new Respuestascontrol();
        $data->id = $_REQUEST['id'];
        $data->respuesta = $_REQUEST['respuesta'];
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
