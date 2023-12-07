<?php
require_once 'Models/database.php';
require_once 'Models/Persona.php';
class PersonasController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Persona();
    }

    public function Index()
    {
        $this->model->GetPersona($_REQUEST['id']);
        require_once '../vista/header_acceso.php';
        require_once '../vista/persona/buscar.php';
        require_once '../vista/footer.php';
    }




    public function Ver()
    {

        require_once '../vista/header_acceso.php';
        require_once '../vista/persona/ver.php';
        require_once '../vista/footer.php';
    }
    public function Procesar()
    {
        $persona = $this->model->GetPersona($_REQUEST['id']);
        require_once 'Views/seleccion/index.php';
    }

    public function Registrar()
    {

        $alm = new Persona();
        $alm->persona_id = $_REQUEST['persona_id'];
        $alm->fecha = $_REQUEST['fecha'];
        $alm->hora = $_REQUEST['hora'];
        $alm->asunto = $_REQUEST['asunto'];
        $alm->puesto_id = $_REQUEST['puesto_id'];
        $alm->portero_id = $_REQUEST['portero_id'];
        // exit();
        $this->model->Registrar($alm);
    }

    public function Editar_asunto()
    {

        $alm = new Persona();

        $alm->asunto_id = $_REQUEST['asunto_id'];
        $alm->novedad = $_REQUEST['novedad'];

        $this->model->Edit_asunto($alm);
    }

    public function insertar()
    {

        require_once '../vista/header_acceso.php';
        require_once '../vista/visita/index.html';
        require_once '../vista/footer.php';
    }
    public function Accesso()
    {

        require_once '../vista/header_acceso.php';
        require_once '../vista/Persona/accesso.php';
        require_once '../vista/footer.php';
    }
    public function Puesto()
    {

        require_once '../vista/header_acceso.php';
        require_once '../vista/Persona/puesto.php';
        require_once '../vista/footer.php';
    }

    public function Crud()
    {
        $alm = new Persona();
        if (isset($_REQUEST['personal_id'])) {
            $alm = $this->model->GetPersona($_REQUEST['personal_id']);
            // print_r($alm);

        }
        require_once 'Views/Personal/editar.php';
    }
    

    public function Editar()
    {
        $alm = new Persona();        

        $alm->cedula = $_REQUEST['cedula'];
        $alm->expedicion = $_REQUEST['expedicion'];
        $alm->nombre = $_REQUEST['Nombre'];
        $alm->apellidos = $_REQUEST['Apellido'];
        $alm->grupo = $_REQUEST['grupo'];
        $alm->rh = $_REQUEST['rh'];
        $alm->sexo = $_REQUEST['sexo'];
        $alm->FechaNacimiento = $_REQUEST['FechaNacimiento'];
        $alm->LugarNacimiento = $_REQUEST['LugarNacimiento'];
        $alm->estado_civil = $_REQUEST['estado_civil'];
        $alm->estrato = $_REQUEST['estrato'];
        $alm->direccion = $_REQUEST['direccion'];
        $alm->barrio = $_REQUEST['barrio'];
        $alm->ciudad_recidencia = $_REQUEST['ciudad_residencia'];
        $alm->correo = $_REQUEST['Correo'];
        $alm->telefono_fijo = $_REQUEST['telefono_fijo'];
        $alm->celular = $_REQUEST['celular'];
        $alm->nom_contacto_emergencia = $_REQUEST['nom_cont_emer'];
        $alm->num_contacto_emergencia = $_REQUEST['num_cont_emer'];
        $alm->nivel_educativo =  $_REQUEST['nivel_educativo'];
        $alm->profesion = $_REQUEST['profesion'];        
        $alm->id =    $_REQUEST['id'];
        $alm->id > 0 ? $alm->Actualizar($alm):'';

    }
    function Estado(){      
      $estado=$this->model->Estado();
      $persona=$this->model->GetPersona($_REQUEST['id']);      
      require_once 'Views/Personal/estado.php';
        
    }

    function Cambioestado(){
     
     if($this->model->ActualizarEstado($_REQUEST['usuario_id'],$_REQUEST['estadoId'])){
        return true;
     }else{
        return false;
     }
        
    }
}
