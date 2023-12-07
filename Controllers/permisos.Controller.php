<?php
require_once 'Models/Permiso.php';
require_once 'Models/Model.php';
require_once 'Models/Usuario.php';
require_once 'Models/Proceso.php';

class PermisosController
{
    private $rol;
    public $model;
    public $usuario;
    public $proceso;

    public function __CONSTRUCT()
    {
        $this->model = new Permiso();
        $this->usuario = new Usuario();
        $controlusuarios = new Model();
        $controlusuarios->Tblaccionusuario('accion_usuarios');
        $controlusuarios->Tblusuariosprocesos('usuario_proceso');
        $this->proceso = new Proceso();
    }

    public function Index()
    {
        $roles = $this->model->Index();
        $_SESSION['rol_id'] == 1 ?  require_once 'Views/Layout/clientes.php' : require_once 'Views/Layout/default.php';
        require_once 'Views/Permisos/index.php';
        require_once 'Views/Layout/foot.php';
    }

    public function Index2()
    {
        $roles = $this->model->Index();
        $modulos = $this->model->Modulos();
        $datos= $this->model->ObtenerDatos($_REQUEST['id']);       
        $usuario_per = $this->model->VerUsuario($_REQUEST['id']);  
        // print_r($usuario);     
        require_once 'Views/Layout/default.php';
        require_once 'Views/Permisos/index2.php';
        require_once 'Views/Layout/foot.php';
    }

     public function AsignarProceso(){

        $usuarios= new Usuario();
        $usuario_per= $usuarios->getUsuario($_REQUEST['id']);
        $procesos =  $this->proceso->getProceso0();
        $asignados=  $this->model->IndexUsuarioProceso($_REQUEST['id']);

        require_once 'Views/Layout/default.php';
        require_once 'Views/Permisos/asignar_proceso.php';
        require_once 'Views/Layout/foot.php';  
        
     }
     public function AsignarProcesoAdd(){
       $procesos=new Permiso();         
        if ($_REQUEST['proceso_id'] > 0) {
            foreach ($_REQUEST['proceso_id'] as $key=>$value) {
                $procesos->proceso_id = $value;
                $procesos->usuario_id = $_REQUEST['usuario_id'];
                $procesos->AsignarProcesoAdd($procesos);
            }
        }      
      }

    public function Acciones()
    {
        $roles = $this->model->Index();
        $modulos = $this->model->Modulos();
        if ($_REQUEST['moduloids'] > 0) {
            foreach ($_REQUEST['moduloids'] as $key=>$value) {
                $modulo[$value] = $value;
            }
        }      
        $valores = implode(',', $modulo);
        $accions=$this->model->Accion($valores);       
        require_once 'Views/Permisos/acciones.php';
       
    }

    public function Controllers()
    {
        $roles = $this->model->Index();
        $modulos = $this->model->Modulos();
        $controlAccion = $this->model->Control($_REQUEST['modulo']);
        require_once 'Views/Permisos/controllers.php';
        //require_once 'Views/Layout/foot.php';
    }




    public function AccionGuardar()
    {
        if (isset($_REQUEST['accion->id_a'])) {
            foreach (array_merge($_REQUEST['accion->id_a']) as $key => $value) {
                $estado = in_array($value, $_REQUEST['accion->id_a']) ? 'activo' : '';
                $this->model->AddControlAccion($value, $_REQUEST['id_usuario'], $estado);
            }
        }
        // if (isset($_REQUEST['accion->id_a']) or isset($_REQUEST['accion->id_d'])) {
        //     foreach (array_merge($_REQUEST['accion->id_a'], $_REQUEST['accion->id_d']) as $key => $value) {
        //         $estado = in_array($value, $_REQUEST['accion->id_a']) ? 'activo' : 'inactivo';
        //         $this->model->AddControlAccion($value, $_REQUEST['id_usuario'], $estado);
        //     }
        // }
    }

    public function Crud()
    {
        $permiso = $this->model->Permiso($_REQUEST['id']);
        require_once 'Views/Permisos/crud.php';
    }

    public function Ver()
    {
        $update = $this->model->Obtener($_REQUEST['id']);
        require_once 'Views/Permisos/ver.php';
    }
    public function Actualizar()
    {
        $permiso = new Permiso();
        $permiso->crear = $_REQUEST['crear'];
        $permiso->leer = $_REQUEST['leer'];
        $permiso->actualizar = $_REQUEST['actualizar'];
        $permiso->borrar = $_REQUEST['borrar'];
        $permiso->id = $_REQUEST['id'];
        $permiso->tipo_usuarios = $_REQUEST['tipo_usuarios'];
        $this->model->Actualizar($permiso);
    }
    public function Accionquitar()
    {
        $this->model->Quitar($_REQUEST['id']);
    }

    public function Procesoquitar()
    {
        $this->model->Quitarproceso($_REQUEST['id']);
    }
}
