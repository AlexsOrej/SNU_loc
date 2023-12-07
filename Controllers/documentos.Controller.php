<?php
require_once 'Models/database.php';
require_once 'Models/Permiso.php';
require_once 'Models/Documento.php';
require_once 'Models/Proceso.php';
require_once 'Models/Onlinedoc.php';

class DocumentosController
{
    private $rol;
    public function __CONSTRUCT()
    {      
        $check=new Permiso();
        $check->CheckSessionExpiry();
        $this->model = new Documento();
    }
    
    public function Index()
    { 
        $proceso = new Proceso();      
        $_SESSION['user']->rol_id==1 ? 
        $procesos = $proceso->getProceso0():
        $procesos = $proceso->getProceso();     
        $online = new Onlinedoc();        
        $onlines = $online->Index();
        require_once 'Views/Layout/default.php';
        require_once 'Views/Documentos/index.php';
        require_once 'Views/Layout/foot.php';
    }

    public function AddEdit()
    {
        $rols =  new Roles();
        if (isset($_REQUEST['id'])) {
            $rols = $this->model->getRol($_REQUEST['id']);
           //print_r($rols);
        }
        require_once 'Views/Layout/clientes.php';
        require_once 'Views/Roles/crud.php';
        //require_once 'Views/Layout/foot.php';
    }


    public function Verdocumentos()
    {
        
        $documentos = $this->model->getDocs($_REQUEST['id']);
        $online = new Onlinedoc();        
        require_once 'Views/Documentos/ver.php';
        require_once 'Views/Layout/filtro.php';
    }
    
    public function Getdoc()
    {

        $documentos = $this->model->getDoc($_REQUEST['doc_id']);
        //require_once 'Views/Layout/default.php';
        require_once 'Views/Documentos/getdoc.php';
        // require_once 'Views/Layout/foot.php';
    }

    public function Edit()
    {

        $documentos = $this->model->getDoc($_REQUEST['doc_id']);
        //equire_once 'Views/Layout/default.php';
        require_once 'Views/Documentos/editdoc.php';
        // require_once 'Views/Layout/foot.php';
    }

    public function Registrar()
    {
        $data = new Documento();
        $data->id = $_REQUEST['id'];
        $data->CodDocumento = $_REQUEST['CodDocumento'];
        $data->Proceso = $_REQUEST['Proceso'];
        $data->NomDocumento = $_REQUEST['NomDocumento'];
        $data->Version = $_REQUEST['Version'];
        $data->Recuperacion = $_REQUEST['preservacion'];
        $data->proteccion = $_REQUEST['proteccion'];
        $data->Almacenamiento = $_REQUEST['Almacenamiento'];
        $data->preservacion = $_REQUEST['preservacion'];
        $data->Emision = $_REQUEST['Emision'];
        $data->Actualizacion = $_REQUEST['Actualizacion'];
        $this->model->Actualizar($data);
    }
    public function Editor()
    {
        $data = new Documento();
        echo $_REQUEST['modo']!=''?:"<script> window.location = '?c=solicitudes&a=index';</script>";
        require_once 'Views/Layout/default.php';
        require_once 'Views/Documentos/editor.php';
        require_once 'Views/Layout/editorfooter.php';
        require_once 'Views/Layout/footer.php';
    }
    public function Regdocumento()
    {

        $onlinedoc = new Onlinedoc();
        require_once 'Views/Layout/default.php';
        require_once 'Views/Documentos/onlinedoc.php';
        require_once 'Views/Layout/footer.php';
        @$onlinedoc->id = $_REQUEST['id'];
        $onlinedoc->solicitud_id = $_REQUEST['ids'];
        $onlinedoc->contenido = $_REQUEST['ckeditor'];
        $onlinedoc->fecha_creacion = date('Y-m-d');
        $onlinedoc->estado = 0;
        $onlinedoc->editor = ucwords($_SESSION['user']->FullName);
        $onlinedoc->Registrar($onlinedoc);
    }
    public function Editor_validar()
    {
        $onlinedoc = new Onlinedoc();
        $onlinedocs = $onlinedoc->GetOnline($_REQUEST['id']);
        require_once 'Views/Documentos/editor_validar.php';
    }
    public function Valdoconline()
    {
        $onlinedoc = new Onlinedoc();
        $onlinedoc->contenido = $_REQUEST['ckeditor'];
        $onlinedoc->id = $_REQUEST['id'];
        $onlinedoc->Valdoconline($onlinedoc);
        echo '<script>        
         window.location = "?c=solicitudes&a=responder&id='.$_REQUEST['id_s'].'&est=true";
        </script>';        
        $onlinedoc->Valdoconline($onlinedoc);
    }

    
}
