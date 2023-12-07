<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Doc_ext.php';
require_once 'Models/Proceso.php';
require_once 'Models/Model.php';

class Doc_extsController
{
    private $rol;
    public $model;

    public function __CONSTRUCT()
    {
        $this->model = new Doc_ext();
    }


    public function Index()
    {
        $proceso = new Proceso();
        $_SESSION['user']->rol_id==1 ? $procesos = $proceso->getProceso0():$procesos = $proceso->getProceso(); 
        require_once 'Views/Layout/default.php';
        require_once 'Views/Doc_Ext/index.php';
        require_once 'Views/Layout/foot.php';
    }

    public function AddEdit()
    {
        $rols =  new Roles();
        if (isset($_REQUEST['id'])) {
            $rols = $this->model->getRol($_REQUEST['id']);
            print_r($rols);
        }
        require_once 'Views/Layout/clientes.php';
        require_once 'Views/Roles/crud.php';
        require_once 'Views/Layout/foot.php';
    }


    public function Ver()
    {

        $documentos = $this->model->getDocs($_REQUEST['id']);       
        require_once 'Views/Doc_Ext/ver.php';
        require_once 'Views/Layout/filtro.php';
    }

    public function Getdoc()
    {

        $documentos = $this->model->getDoc($_REQUEST['doc_id']);
        //equire_once 'Views/Layout/default.php';
        require_once 'Views/Doc_Ext/getdoc.php';
        // require_once 'Views/Layout/foot.php';
    }

    public function Edit()
    {

        $documentos = $this->model->getDoc($_REQUEST['doc_id']);
        //equire_once 'Views/Layout/default.php';
        require_once 'Views/Doc_Ext/editdoc.php';
        // require_once 'Views/Layout/foot.php';
    }

    public function Registrar()
    {
        $data = new Doc_ext();
        $data->id = $_REQUEST['id'];
        $data->codigo = $_REQUEST['codigo'];
        $data->proceso = $_REQUEST['proceso'];
        $data->nombre = $_REQUEST['nombre'];
        $data->expedicion = $_REQUEST['expedicion'];
        $data->descripcion = $_REQUEST['descripcion'];
        $data->dir = $_REQUEST['dir'];       
        $this->model->Actualizar($data);
    }
    
}
