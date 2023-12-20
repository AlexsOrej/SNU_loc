<?php
require_once 'Models/Autoload.php';

class AuditoriasController
{

    public $model;
    public $proceso;
    public $usuario;
    
    public function __CONSTRUCT()
    {
        $this->model = new Auditoria();
        $this->proceso = new Proceso();
        $this->usuario = new Usuario();
    }

    public function ProgramaAuditoria()
    {
        $programa = $this->model->Index();
        require_once 'Views/Layout/auditorias.php';
        require_once 'Views/Auditorias/index.php';
        require_once 'Views/Layout/foot.php';
    }

    public function VerPlanesAuditoria()
    {
        $planes = $this->model->IndexPrograma($_REQUEST['programa_id']);
        require_once 'Views/Layout/auditorias.php';
        require_once 'Views/Auditorias/Planes/index.php';
        require_once 'Views/Layout/foot.php';
    }

    public function PlanAuditoria()
    {
        $procesos = $this->proceso->getProcesosALL();
        $usuarios = $this->usuario->GetUsuarios($_SESSION['datos_cliente']->id);
        require_once 'Views/Auditorias/Planes/crud.php';
    }


    public function Crud()
    {
        $auditoria = new Auditoria();
        if (isset($_REQUEST['prog_auditoria_id'])) {
            $auditoria = $this->model->Obtener($_REQUEST['prog_auditoria_id']);
        }
        require_once 'Views/Auditorias/crud.php';
    }

    public function Registrar()
    {

        $auditoria = new Auditoria();
        $auditoria->id = $_REQUEST['id'];
        $auditoria->alcances = $_REQUEST['alcance'];
        $auditoria->observaciones = $_REQUEST['observaciones'];
        $auditoria->criterios = $_REQUEST['criterios'];
        $auditoria->objetivos = $_REQUEST['objetivos'];
        $auditoria->riesgos = $_REQUEST['riesgos'];
        $auditoria->metodo = $_REQUEST['metodo'];
        $auditoria->cant_auditores = $_REQUEST['cant_auditores'];
        $auditoria->fecha_inicio = $_REQUEST['fecha_inicio'];
        $auditoria->fecha_fin = $_REQUEST['fecha_fin'];
        $auditoria->id > 0 ?
            $respuesta = $this->model->Actualizar($auditoria) :
            $respuesta = $this->model->Registrar($auditoria);

        echo $respuesta;
    }

    public function RegistrarPlan()
    {

        $auditoria = new Auditoria();
        $auditoria->id = $_REQUEST['id'];
        $auditoria->proceso_id = $_REQUEST['proceso_id'];
        $auditoria->horainicio = $_REQUEST['horainicio'];
        $auditoria->horafin = $_REQUEST['horafin'];
        $auditoria->fecha = $_REQUEST['fecha'];
        $auditoria->auditorLider = $_REQUEST['auditorLider'];
        $auditoria->expertotecnico = $_REQUEST['expertotecnico'];
        $auditoria->auditorapoyo = $_REQUEST['auditorapoyo'];
        $auditoria->liderproceso = $_REQUEST['liderproceso'];
        $auditoria->programa_id = $_REQUEST['programa_id'];
        $auditoria->id > 0 ?
            $respuesta = $this->model->ActualizarPlan($auditoria) :
            $respuesta = $this->model->RegistrarPlan($auditoria);

        echo $respuesta;
    }
}
