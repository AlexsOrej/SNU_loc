<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/Respuesta.php';

class RespuestasController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Respuesta();
    }

    public function Index()
    {
        //require_once '../vista/header.php';
          require_once 'Views/Pqrs/index.php';
        // require_once '../vista/footer.php';
    }

    public function Crud()
    {
        $respuesta= new Respuesta();
        if(isset($_REQUEST['id'])){ 
            $respuesta = $this->model->GetRespuestas();
            require_once 'Views/cargos/crud.php';
        }


    }

    public function Add()
    {
        
    }
    public function Eliminar()
    {
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }
}