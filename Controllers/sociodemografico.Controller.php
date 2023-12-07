<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Model.php';
require_once 'Models/Persona.php';
require_once 'Models/Sociodemografico.php';
require_once 'Models/Cargo.php';
require_once 'Models/Contrato.php';



class SociodemograficoController
{
    private $rol;
    public function __CONSTRUCT()
    {
        $this->model = new Sociodemografico();
        $tblSociodemografico= new Model();
        $tblSociodemografico->TblSociodemografico('sociodemografico');
    }

    public function Index()
    {
        $sociodemograficos = new Sociodemografico();
        $persona = new Persona();
        $persona = $persona->GetPersona($_REQUEST['personal_id']);
        $sociodemografico = $sociodemograficos->Index($_REQUEST['personal_id']);   
        require_once 'Views/Layout/talento.php';
        require_once 'Views/Sociodemografico/index.php';
        require_once 'Views/Layout/foot.php';
    }
    public function Add()
    { 
         
        $sd = new Sociodemografico();
        $sdupdate= $this->model->Index($_REQUEST['personal_id']); 

        if(isset($_REQUEST['personal_id']) AND !empty($sdupdate) ){
            
            $sd= $this->model->Index($_REQUEST['personal_id']);
        }
        if(isset($_REQUEST['id'])){
            
            $sd=$this->model->Index($_REQUEST['id']);            
        }

        require_once 'Views/Sociodemografico/crud.php';        
    }

    public function Crud()
    {
        #code...
        $ss = new Sociodemografico();
        $ss->id=$_REQUEST['id'];
        $ss->personal_id=$_REQUEST['persona_id'];
        $ss->dependientes = $_REQUEST['dependientes'];
        $ss->cuantas_personas_vive = $_REQUEST['num_dependientes'];
        $ss->alergias = $_REQUEST['alergia'];
        isset($_REQUEST['cual_alergia'])?$ss->cual_alergia = $_REQUEST['cual_alergia']:$ss->cual_alergia = "n/a";        ;
        $ss->medio_transporte = $_REQUEST['transporte'];
        $ss->tiempo_desplazamiento = $_REQUEST['tiempo_trans'];
        $ss->uso_tiempo_libre = $_REQUEST['tiempo_libre'];
        $ss->otros_trabajos = $_REQUEST['otro_trabajo'];
        // $ss->funciones = $_REQUEST['fun_otro_trabjo'];
        $ss->fuma = $_REQUEST['cigarrillo'];
        $ss->licor = $_REQUEST['licor'];
        $ss->realiza_ejercicio = $_REQUEST['ejercicio'];
        $ss->id > 0 ? $this->model->Update($ss) : $this->model->Add($ss);
    }

    function exportToExcelSocio() {
    // Get the data        
        $result =  $this->model->GetPerfil();
        
    }
    function exportToExcelPlanta() {
    // Get the data        
        $result =  $this->model->GetPerfil01();
        
    }
}