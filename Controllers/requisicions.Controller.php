<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Model.php';
require_once 'Models/Requisicion.php';
require_once 'Models/Cargo.php';
class RequisicionsController
{
    private $rol;
    public function __CONSTRUCT()
    {
        $this->model = new Requisicion();
        $requicision= new Model();
        $requicision->Tblrequisicions('requisicions');

    }

    public function Index()
    {
        $cargo = new Cargo();
        $cargos = $cargo->CargoIndex();
        $requisions = $this->model->Listar();
        require_once 'Views/Layout/talento.php';
        require_once 'Views/Requisicion/index.php';
        require_once 'Views/Layout/foot.php';
        require_once 'Views/Layout/filtro.php';
    }
    
    public function Crud()
    {
        $alm = new Requisicion();

        if (isset($_REQUEST['id'])) {
            $alm = $this->model->Obtener($_REQUEST['id']);
            require_once 'Views/Requisicion/requisicion-editar.php';
        } else {
            require_once 'Views/Layout/talento.php';
            require_once 'Views/Requisicion/requisicion-editar.php';
            require_once 'Views/Layout/foot.php';
        }
    }

    public function Guardar()
    {
        $alm = new Requisicion();
        $solicitante = $_SESSION['user']->FullName;
        $alm->id = $_REQUEST['id'];
        $alm->nom_solicitud = $solicitante;
        $alm->sede = $_REQUEST['sede'];
        $alm->motivo = $_REQUEST['motivo'];
        $alm->f_solicitud = $_REQUEST['fecha_ingreso'];      
        $alm->cargo_requerido = $_REQUEST['cargo_requerido'];
        $alm->num_vacantes = $_REQUEST['num_vacantes'];
        $alm->prioridad = $_REQUEST['prioridad'];
        $alm->fecha_ingreso = $_REQUEST['fecha_ingreso'];       
        $alm->condiciones = $_REQUEST['condiciones'];       
        $alm->estado = 1;        

        $alm->id > 0
            ? $alm->Actualizar($alm)
            : $alm->Registrar($alm);
       
    }

    public function Autorizacion()
    {
        $alm = $this->model->Obtener($_REQUEST['id']);
        require_once 'Views/Requisicion/autorizacion.php';
    }

    public function Autor_guardar()
    {
        $alm = new Requisicion();
        $alm->id = $_REQUEST['id'];
        $alm->estado = $_REQUEST['estado'];
        $alm->cargo_id = $_REQUEST['cargo_id'];
        $alm->Autor_guardar($alm);
       
    }

    public function Eliminar()
    {
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }
    public function Ver()
    {
        if (isset($_REQUEST['id'])) {
            $alm = $this->model->Ver($_REQUEST['id']);
            require_once '../vista/requisicion/ver.php';
        }
    }
}
