<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Model.php';
require_once 'Models/Formato.php';
require_once 'Models/Proceso.php';
require_once 'Models/Usuario.php';


class FormatosController
{
    private $rol;
    private $usuario;
    private $model;
    private $autorizar;
    public function __CONSTRUCT()
    {
        $this->model = new Formato();
        $this->usuario = new Usuario();
        $this->autorizar= new Model();
        $this->autorizar->TblFormatosRestricion('formatos_restricion');  

    }

    public function Index()
    {
        $proceso = new Proceso();
        $_SESSION['user']->rol_id == 1 ? $procesos = $proceso->getProceso0() : $procesos = $proceso->getProceso();
        require_once 'Views/Layout/default.php';
        require_once 'Views/Formatos/index.php';
        require_once 'Views/Layout/foot.php';
    }

    public function AddEdit()
    {
        $rols =  new Roles();
        if (isset($_REQUEST['id'])) {
            $rols = $this->model->getRol($_REQUEST['id']);
            // print_r($rols);
        }
        require_once 'Views/Layout/clientes.php';
        require_once 'Views/Roles/crud.php';
        require_once 'Views/Layout/foot.php';
    }


    public function Verformato()
    {

        $documentos = $this->model->getDocs($_REQUEST['id']);
        require_once 'Views/Formatos/ver.php';
        require_once 'Views/Layout/filtro.php';
    }

    public function Getdoc()
    {

        $documentos = $this->model->getDoc($_REQUEST['doc_id']);
        //equire_once 'Views/Layout/default.php';
        require_once 'Views/Formatos/getdoc.php';
        // require_once 'Views/Layout/foot.php';
    }

    public function Edit()
    {

        $documentos = $this->model->getDoc($_REQUEST['doc_id']);
        //equire_once 'Views/Layout/default.php';
        require_once 'Views/Formatos/editdoc.php';
        // require_once 'Views/Layout/foot.php';
    }

    public function Registrar()
    {
        $data = new Formato();
        $data->id = $_REQUEST['id'];
        $data->CodFormato = $_REQUEST['CodFormato'];
        $data->Proceso = $_REQUEST['Proceso'];
        $data->NomFormato = $_REQUEST['NomFormato'];
        $data->RutaFormato = $_REQUEST['RutaFormato'];
        $data->Version = $_REQUEST['Version'];
        $data->Emision = $_REQUEST['Emision'];

        empty($_REQUEST['Actualizacion']) ? $data->Actualizacion = '0000-00-00' :
            $data->Actualizacion = $_REQUEST['Actualizacion'];

        $data->Almacenamiento = $_REQUEST['Almacenamiento'];
        $data->Proteccion = $_REQUEST['Proteccion'];
        $data->TipoRecuperacion = $_REQUEST['TipoRecuperacion'];
        $data->Recuperacion = $_REQUEST['Recuperacion'];
        $data->TiempoRetencion = $_REQUEST['TiempoRetencion'];
        $data->DispFinal = $_REQUEST['DispFinal'];
        $data->Responsable = $_REQUEST['Responsable'];
        $this->model->Actualizar($data);
    }

    function Almacenamiento()
    {
        print_r($_REQUEST['ruta']);
    }

    function Restringir()
    {   
        // echo'<pre>';
        // print_r($_SESSION['datos_cliente']);
        $cliente=$_SESSION['datos_cliente']->id;
        // echo'</pre>';
        $autorizados =$this->usuario->VerColaboradoresAutorizado($_REQUEST['doc_id']);       
        $usuarios = $this->usuario->GetUsuarios($cliente);        
        require_once 'Views/Formatos/restringir.php';

    }

    

    

    
}
