<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Nivelriesgos.php';


class NivelriesgosController
{
    private $rol;
    public function __CONSTRUCT()
    {
        $this->model = new NivelRiesgos();
    }

   
    public function index()
    {
        $nivel = $this->model->consultar();
        require_once 'Views/Layout/riesgos.php';
        require_once 'Views/NivelRiesgos/index.php';
        require_once 'Views/Layout/foot.php';
    }
    
    
    public function add(){
        $nivel = new NivelRiesgos();
        if(isset($_REQUEST['id'])){
            $nivel = $this->model->consultarPorId($_REQUEST['id']);
        }
        require_once 'Views/NivelRiesgos/crud.php';
    }

    public function crud(){
        $data = new NivelRiesgos();
        $data->id = $_REQUEST['id'];
        $data->nombre = $_REQUEST['nombre'];
        $data->descripcion =  $_REQUEST['descripcion'];
        $data->rango =  $_REQUEST['rango1'];
        $data->rango2 =  $_REQUEST['rango2'];
        $data->color =  $_REQUEST['color'];



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
