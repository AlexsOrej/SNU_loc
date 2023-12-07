<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Clasificacionriesgos.php';


class clasificacionriesgoController
{
    private $rol;
    public function __CONSTRUCT()
    {
        $this->model = new ClasificacionRiesgos();
    }

   
    public function index()
    {
        $clasificacion  = $this->model->consultar();
        require_once 'Views/Layout/riesgos.php';
        require_once 'Views/ClasificacionRiesgos/index.php';
        require_once 'Views/Layout/foot.php';
    }
    
    
    public function add(){
        $nivel = new ClasificacionRiesgos();
        if(isset($_REQUEST['id'])){
            $nivel = $this->model->consultarPorId($_REQUEST['id']);
        }
        require_once 'Views/ClasificacionRiesgos/crud.php';
    }

    public function crud(){
        $data = new ClasificacionRiesgos();
        $data->id = $_REQUEST['id'];
        $data->nombre = $_REQUEST['nombre'];
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
